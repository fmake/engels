<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $news_obj = new fmakeNews();
		$fmakeTag = new fmakeSiteModule_tags();
        $globalTemplateParam->set('news_obj', $news_obj);
        $globalTemplateParam->set('breadcrubs', $breadcrubs);

        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->news_count ? $configs->news_count : 10;

		/*фоторепортаж*/
		$limit_photo = 1;
		$photo_obj = new fmakeSiteModule();
		$photo_obj->order = "b.date DESC, a.id";
		$items_photo = $photo_obj->getByPageAdmin(9, $limit_photo,1,"a.`file` = 'item_photo_reports' and a.picture!=''",true);
		$fmakeGallery = new fmakeGallery_Image();
		$globalTemplateParam->set('photo_obj', $photo_obj);
		$globalTemplateParam->set('items_photo', $items_photo);
		$globalTemplateParam->set('gallery_obj', $fmakeGallery);
		/*фоторепортаж*/
		
		/*объявления*/
		$advert_obj = new fmakeSiteModule();
		$limit_advert = 3; 
		//$advert_obj->order = "RAND()";
		$manual_obj->order = "b.date DESC, a.id";
		$items_advert_main = $advert_obj->getByPageAdmin(796, $limit_advert,1,"a.`file` = 'item_advert'",true);
		$globalTemplateParam->set('advert_obj', $advert_obj);
		$globalTemplateParam->set('items_advert_main', $items_advert_main);
		/*объявления*/
		
		/*места*/
		$place_obj = new fmakeSiteModule();
		$limit_place = 1; 
		//$place_obj->order = "b.date DESC, a.id";
		$place_obj->order = "RAND()";
		$items_place_main = $place_obj->getByPageAdmin(5, $limit_place,1,"a.`file` = 'item_place' and `main` = '1'",true);
		$globalTemplateParam->set('place_obj', $place_obj);
		$globalTemplateParam->set('items_place_main', $items_place_main);
		/*места*/
		
		
		if($request -> getEscape('url')) {
			//$url_arr = explode('/', $request -> getEscape('url'));
			
			//list($main_cat, $cat, $item) = $url_arr;

			$news_obj->setRedir($request->modul);
			$item = $news_obj->getInfo();
			
			if($item['file'] == 'item_news') {
				//$news_obj->setRedir($request->modul);
				//$item = $news_obj->getInfo();
				
				$fmakeTypeTable = new fmakeTypeTable();
				$absitem_dop = new fmakeSiteModule();
				$absitem_dop->table = $fmakeTypeTable->getTable(2);
				$absitem_dop->setId($item[$news_obj->idField]);
				$user_expert = new fmakeSiteUser();
				$item['dop_params'] = $absitem_dop->getInfo();
				//printAr($item['dop_params']);
				//$user_expert = $user_expert->getByUserId($item['dop_params']['id_expert']);
				//printAr($user_expert);
				$include_param_id_comment = $item[$news_obj->idField];
				//$include_param_modul = $news_obj->mod;
				include 'helpModules/comments.php';


				$tags = $fmakeTag->getTags($item[$news_obj->idField]);
				$item['tags'] = $tags;


				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];
				/*теги*/
				$tags = $fmakeTag->getTags($item[$news_obj->idField]);
				$items['tags'] = $tags;
				/*теги*/
				$breadcrubs = $modul->getBreadCrumbs($item[$news_obj->idField]);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				//$globalTemplateParam->set('user_expert', $user_expert);
				$globalTemplateParam->set('item', $item);
				$exp = new fmakeMneniya();
				$exp = $exp -> getAll();
				foreach ($exp as $key => $value) {
					if ($exp[$key]['id_news'] == $items['id'])
						$total_exp[] = $value;
				}
				$exp = $total_exp;
				$globalTemplateParam->set('exp', $exp);
				PrintAr($exp);
				//PrintAr($item['dop_params']);
				if ($item['dop_params']['templ'] == 1)				
					$modul->template = "news/item_old.tpl"; //exit;
				else 
					$modul->template = "news/item.tpl"; //exit;					
			} else {
				//$news_obj->order = "b.date DESC, a.id";
				//$news_obj->setRedir($request->modul);
				//$item = $news_obj->getInfo();
				
				$cat = $news_obj->getCatForMenu($item[$news_obj->idField],true);
				$parents = $news_obj->getCats($item[$news_obj->idField]);
				
				//$news = $news_obj->getByPage($item[$news_obj->idField], $limit, $page,"a.`file` = 'item_news'",$modul->id,true);				
				//$count = $news_obj->getByPageCount($item[$news_obj->idField],"a.`file` = 'item_news'",$modul->id,true);
				$news_obj->order = "b.date DESC, a.id";
				$news = $news_obj->getByPageAdmin($modul->id, $limit, $page,"a.parent in ({$parents}) AND a.`file` = 'item_news'",true);
				$count = $news_obj->getByPageCountAdmin($modul->id,$modul->id,"a.parent in ({$parents}) AND a.`file` = 'item_news'",true);
				
				$pages = ceil($count/$limit);
				
				if ($page < 1) {
					$page = 1;
				}
				elseif ($page > $pages) {
					$page = $pages;
				}
				if($news)foreach($news as $key=>$item_new){
					$tags = $fmakeTag->getTags($item_new[$news_obj->idField]);
					$news[$key]['tags'] = $tags;
				}
				
				
				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];

				
				
				$breadcrubs = $modul->getBreadCrumbs($item[$news_obj->idField]);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				
				$globalTemplateParam->set('news', $news);
				$globalTemplateParam->set('page', $page);
				$globalTemplateParam->set('pages', $pages);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('categories', $cat);
				$modul->template = "news/category.tpl"; //exit;
			}
		} else {
			
			//echo $request->modul;
			$news_obj->setRedir($request->modul);
			$item = $news_obj->getInfo();
			//printAr($item);
			
			$cat = $news_obj->getCatForMenu($item[$news_obj->idField],true);
			$parents = $news_obj->getCats($item[$news_obj->idField]);
			
			$news_obj->order = "b.date DESC, a.id";
			$news = $news_obj->getByPageAdmin(2, $limit, $page,"a.`file` = 'item_news'",true);
			$count = $news_obj->getByPageCountAdmin(2,2,"a.`file` = 'item_news'",true);
			//$news = $news_obj->getByPageAdmin($modul->id, $limit, $page,"a.parent in ({$parents}) AND a.`file` = 'item_news'",true);
			//$count = $news_obj->getByPageCountAdmin($modul->id,$modul->id,"a.parent in ({$parents}) AND a.`file` = 'item_news'",true);
			
			$pages = ceil($count/$limit);
			
			if ($page < 1) {
				$page = 1;
			}
			elseif ($page > $pages) {
				$page = $pages;
			}

			if($news)foreach($news as $key=>$item_new){
				$tags = $fmakeTag->getTags($item_new[$news_obj->idField]);
				$news[$key]['tags'] = $tags;
			}
			
			$modul->title = $item['title'];
            $modul->description = $item['description'];
			$modul->keywords = $item['keywords'];

			//echo $item[$news_obj->idField];
			$breadcrubs = $modul->getBreadCrumbs($item[$news_obj->idField]);
			$globalTemplateParam->set('breadcrubs', $breadcrubs);
			
			//printAr($breadcrubs);
			
			$globalTemplateParam->set('news', $news);
			$globalTemplateParam->set('page', $page);
			$globalTemplateParam->set('pages', $pages);
			$globalTemplateParam->set('item', $item);
			$globalTemplateParam->set('categories', $cat);
			$modul->template = "news/category.tpl";
			
		}
?>
