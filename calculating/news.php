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
				$news_obj->order = "RAND()";
				$news_for_recomend = $news_obj->getByPageAdmin($modul->id, $limit, $page,"b.`recommend` = 1 AND a.`file` = 'item_news'",true);
				
				PrintAr($news_for_recomend);
				PrintAr("adsfasdf");

				$tags = $fmakeTag->getTags($item[$news_obj->idField]);
				$item['tags'] = $tags;


				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];
				/*теги*/
				$tags = $fmakeTag->getTags($item[$news_obj->idField]);
				$item['tags'] = $tags; // WTFF?????????? почему было items????
				/*теги*/
				$breadcrubs = $modul->getBreadCrumbs($item[$news_obj->idField]);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				//$globalTemplateParam->set('user_expert', $user_expert);
				$globalTemplateParam->set('item', $item);
				#---------------------------------------------------------------мнения
				$exp = new fmakeMneniya();
				$exp = $exp -> getAll();
				foreach ($exp as $key => $value) {
					if ($exp[$key]['id_news'] == $item['id'])
						$total_exp[] = $value;
				}
				$exp = $total_exp;
				$globalTemplateParam->set('exp', $exp);
				#Другие мнения

				$news_obj_exp = new fmakeMneniya;
				$limit_news_exp = 6;
				$news_obj_exp->order="id_news DESC"; 
				$items_news_exp = $news_obj_exp->getByPageAdmin($limit_news_exp, 1 ,"`text_expert` != '' " , true);
			    foreach ($items_news_exp as $key => $value) {
			    	$templ = $news_obj->getByPageAdmin(2, false, false,"a.`file` = 'item_news' and a.`id` = {$items_news_exp[$key][id_news]}",true);
			    	$items_news_exp[$key]['caption'] = $templ[0]['caption'];
			  	}
				$globalTemplateParam->set('items_news_exp', $items_news_exp);

				#---------------------------------------------------------------мнения

				/*объявления*/				
				$advert_obj = new fmakeSiteModule();
				$limit_advert = 6; 
				$manual_obj->order = "b.date DESC, a.id";
				$items_advert_main = $advert_obj->getByPageAdmin(796, $limit_advert,1,"a.`file` = 'item_advert'",true);
				$globalTemplateParam->set('advert_obj2', $advert_obj);
				$globalTemplateParam->set('items_advert_main2', $items_advert_main);
				/*объявления*/

				/*Справочник*/
				$manual_obj = new fmakeSiteModule();
				$limit_manual = 6; 
				$manual_obj->order = "b.date DESC, a.id";
				$items_manual_main = $manual_obj->getByPageAdmin(1238, $limit_manual,1,"a.`file` = 'item_manual'",true);
				$globalTemplateParam->set('manual_obj2', $manual_obj);
				$globalTemplateParam->set('items_manual_main2', $items_manual_main);
				/*Справочник*/

				/*места*/
				$place_obj = new fmakeSiteModule();
				$limit_place = 7; 
				$place_obj->order = "RAND()";
				$items_place_main = $place_obj->getByPageAdmin(5, $limit_place,1,"a.`file` = 'item_place' and `main` = '1'",true);
				$globalTemplateParam->set('place_obj2', $place_obj);
				$globalTemplateParam->set('items_place_main2', $items_place_main);
				/*места*/

				/*интервью*/
				$limit_interv = 6;
				$interv_obj = new fmakeSiteModule();
				$interv_obj->order = "b.date DESC, a.id";
				$items_interv = $interv_obj->getByPage(12, $limit_interv,1,"`main` = '1' and a.picture!=''",12,true);
				$globalTemplateParam->set('interv_obj', $interv_obj);
				$globalTemplateParam->set('items_interv', $items_interv);
				/*интервью*/

				/*афиша*/
				$meets_obj = new fmakeMeets();
				$limit_meets = 7;
				$date = strtotime("today"/*,$tmp_date*/);
				$globalTemplateParam->set("to_day", $date);
				$date_array = $meets_obj->dateFilter(date('d.m.Y',$date));
				$date_to = $date_array["to"];
				/*отминмаем одну милисекунду чтобы использовать <= к правой границе даты*/
				$date_from = $date_array["from"]-1;
				$filter_date = "( ( ( '{$date_to}'<= b.date AND b.date <= '{$date_from}') OR ( '{$date_to}'<= b.date_from AND b.date_from <= '{$date_from}' ) ) OR 
							              ( b.date <= '{$date_to}' AND '{$date_from}' <= b.date_from ) )";
				$meets_obj->order = "RAND()";
				$items_meets_main = $meets_obj->getByPageAdmin(4, false,false,"a.`file` = 'item_meets' and {$filter_date} ",true);
				$items_meets_main = $meets_obj->uniqParent($items_meets_main,$limit_meets);
				$globalTemplateParam->set('meets_obj', $meets_obj);
				$globalTemplateParam->set('items_meets_main', $items_meets_main);
				/*афиша*/

				/*фоторепортаж*/
				$limit_photo = 12;
				$photo_obj = new fmakeSiteModule();
				$photo_obj->order = "b.date DESC, a.id";
				$items_photo = $photo_obj->getByPageAdmin(9, $limit_photo,1,"a.`file` = 'item_photo_reports' and `main` = '1' and a.picture!=''",true);
				$fmakeGallery = new fmakeGallery_Image();
				$globalTemplateParam->set('photo_obj', $photo_obj);
				$globalTemplateParam->set('items_photo', $items_photo);
				$globalTemplateParam->set('gallery_obj', $fmakeGallery);
				/*фоторепортаж*/

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
