<?php

		$no_right_menu = true;
        $globalTemplateParam->set('no_right_menu', $no_right_menu);

        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $reports_obj = new fmakeSiteModule();
		$fmakeTag = new fmakeSiteModule_tags();
        $globalTemplateParam->set('reports_obj', $reports_obj);
        //$reports_url = $reports_obj->getUrlReports();
		//$globalTemplateParam->set('reports_url',$reports_url);
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->reports_count ? $configs->reports_count : 10;
        
        //$offset = ($page - 1) * $limit;
        
		/*афиша*/
		$meets_obj = new fmakeMeets();		
		$limit_meets = 6;
		$date = strtotime("today"/*,$tmp_date*/);
		
		$date_array = $meets_obj->dateFilter(date('d.m.Y',$date));
		$date_to = $date_array["to"];
		/*отминмаем одну милисекунду чтобы использовать <= к правой границе даты*/
		$date_from = $date_array["from"]-1;
			
		$filter_date = "( ( ( '{$date_to}'<= b.date AND b.date <= '{$date_from}') OR ( '{$date_to}'<= b.date_from AND b.date_from <= '{$date_from}' ) ) OR 
								  ( b.date <= '{$date_to}' AND '{$date_from}' <= b.date_from ) )";
		
		$meets_obj->order = "RAND()";
		$meets_right_block = $meets_obj->getByPageAdmin(4, false,false,"a.`file` = 'item_meets' and {$filter_date} ",true);
		$meets_right_block = $meets_obj->uniqParent($meets_right_block,$limit_meets);
		
		//if($_GET['debug']==1) printAr($meets_right_block);
		
		$globalTemplateParam->set('meets_right_block', $meets_right_block);
		/*афиша*/
		
        if($request -> getEscape('url')){
            
			$url_arr = explode('/', $request -> getEscape('url'));
			
			list($main_cat, $cat, $item) = $url_arr;
			
			if(is_string($item)){
				$reports_obj->setRedir($request->modul);
				$item = $reports_obj->getInfo();
				
				$fmakeTypeTable = new fmakeTypeTable();
				$absitem_dop = new fmakeSiteModule();
				$absitem_dop->table = $fmakeTypeTable->getTable(2);
				$absitem_dop->setId($item[$reports_obj->idField]);
				$item['dop_params'] = $absitem_dop->getInfo();
				//printAr($item);   
				//$id_gallery = $reports_obj->getGalleryId($item['id']);

				$limit_photo = 16;
				$fmakeGallery = new fmakeGallery_Image();
				$photos = $fmakeGallery->getFullPhoto($item[$reports_obj->idField]);
				$count = $fmakeGallery->getByPageCount($item[$reports_obj->idField]);
				$pages = ceil($count/$limit_photo);
				$id_foto = intval($_GET['id_foto']);
				foreach ($photos as $key => $value) {
					if($photos[$key]['id'] == $id_foto)
						$globalTemplateParam->set("dojs_foto", $id_foto);
				}
				//PrintAr($photos);
				//PrintAr($photos);
				
				$gap['to'] = ($page-1)*$limit_photo;
				$gap['from'] = ($page-1)*$limit_photo+$limit_photo-1;
				$globalTemplateParam->set('gap',$gap);
				$globalTemplateParam->set('photos', $photos);
				$globalTemplateParam->set('pages', $pages);
				$globalTemplateParam->set('page', $page);

				
				$include_param_id_comment = $item[$reports_obj->idField];
				//$include_param_modul = $reports_obj->mod;
				include 'helpModules/comments.php';
				
				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];
				
				//echo $item['keywords'].'1';
				
				$tags = $fmakeTag->getTags($item[$reports_obj->idField]);
				$item['tags'] = $tags;
				
				$breadcrubs = $modul->getBreadCrumbs($item[$reports_obj->idField]);
				
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				$globalTemplateParam->set('item', $item);
				//PrintAr($item);

				#---------------------------------------------------------------новый функционал.
				$news_obj = new fmakeNews();
				$news_obj_exp = new fmakeMneniya();
				$limit_news_exp = 6;
				$news_obj_exp->order="id_news DESC"; 
				$items_news_exp = $news_obj_exp->getByPageAdmin($limit_news_exp, 1 ,"`text_expert` != '' " , true);
			    foreach ($items_news_exp as $key => $value) {
			    	$templ = $news_obj->getByPageAdmin(2, false, false,"a.`file` = 'item_news' and a.`id` = {$items_news_exp[$key][id_news]}",true);
			    	$items_news_exp[$key]['caption'] = $templ[0]['caption'];
			  	}
				$globalTemplateParam->set('items_news_exp', $items_news_exp);



				/*объ€влени€*/				
				$advert_obj = new fmakeSiteModule();
				$limit_advert = 6; 
				$manual_obj->order = "b.date DESC, a.id";
				$items_advert_main = $advert_obj->getByPageAdmin(796, $limit_advert,1,"a.`file` = 'item_advert'",true);
				$globalTemplateParam->set('advert_obj2', $advert_obj);
				$globalTemplateParam->set('items_advert_main2', $items_advert_main);
				/*объ€влени€*/

				/*—правочник*/
				$manual_obj = new fmakeSiteModule();
				$limit_manual = 6; 
				$manual_obj->order = "b.date DESC, a.id";
				$items_manual_main = $manual_obj->getByPageAdmin(1238, $limit_manual,1,"a.`file` = 'item_manual'",true);
				$globalTemplateParam->set('manual_obj2', $manual_obj);
				$globalTemplateParam->set('items_manual_main2', $items_manual_main);
				/*—правочник*/

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

				$modul->template = "photoreports/item.tpl";

			}elseif(is_string($cat)){
				$cat = $reports_obj->getChilds($modul->id,true);
			
				$fmakeGallery = new fmakeGallery_Image();
				$reports_obj->order = "b.date DESC, a.id";
				$reports_obj->setRedir($request->modul);
				$item = $reports_obj->getInfo();
					
				$reports = $reports_obj->getByPage($item[$reports_obj->idField], $limit, $page,false,$modul->id,true);
									
				$count = $reports_obj->getByPageCount($item[$reports_obj->idField],false,$modul->id,true);
				$pages = ceil($count/$limit);
				
				if ($page < 1) {
					$page = 1;
				}
				elseif ($page > $pages) {
					$page = $pages;
				}
				
				/*if($reports)foreach($reports as $key=>$item_new){
					$tags = $fmakeTag->getTags($item_new[$reports_obj->idField]);
					$reports[$key]['tags'] = $tags;
				}*/
				
				$breadcrubs = $modul->getBreadCrumbs($item[$reports_obj->idField]);
				//PrintAr($fmakeGallery);
				$globalTemplateParam->set('gallery_obj', $fmakeGallery);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('pages', $pages);
				$globalTemplateParam->set('page', $page);
				$globalTemplateParam->set('categories', $cat);
				$globalTemplateParam->set('reports', $reports);
				
				$modul->template = "photoreports/all_report.tpl";
			}
			
        }else{
        	$cat = $reports_obj->getChilds($modul->id,true);
			
			$fmakeGallery = new fmakeGallery_Image();
			$reports_obj->order = "b.date DESC, a.id";
			$reports_obj->setRedir($request->modul);
			$item = $reports_obj->getInfo();
			
			$modul->title = $item['title'];
			$modul->description = $item['description'];
			
			$reports = $reports_obj->getByPageAdmin($modul->id, $limit, $page,"a.`file` = 'item_photo_reports'",true);
			
			$count = $reports_obj->getByPageCountAdmin($modul->id,$modul->id,"a.`file` = 'item_photo_reports'",true);
			$pages = ceil($count/$limit);
			//printAr($reports);
			if ($page < 1) {
					$page = 1;
			}
			elseif ($page > $pages) {
					$page = $pages;
			}

			/*if($places)foreach($places as $key=>$item_new){
				$tags = $fmakeTag->getTags($item_new[$places_obj->idField]);
				$places[$key]['tags'] = $tags;
			}*/
			
			$breadcrubs = $modul->getBreadCrumbs($item[$reports_obj->idField]);
			//printAr($item);
			$globalTemplateParam->set('gallery_obj', $fmakeGallery);
			$globalTemplateParam->set('reports', $reports);
			$globalTemplateParam->set('item', $item);
			$globalTemplateParam->set('pages', $pages);
			$globalTemplateParam->set('page', $page);
			$globalTemplateParam->set('categories', $cat);
			$globalTemplateParam->set('breadcrubs', $breadcrubs);
			$modul->template = "photoreports/all_report.tpl";
        }
?>
