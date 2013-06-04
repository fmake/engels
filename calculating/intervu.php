<?php

		$no_right_menu = true;
        $globalTemplateParam->set('no_right_menu', $no_right_menu);

        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $interv_obj = new fmakeSiteModule();
		$fmakeTag = new fmakeSiteModule_tags();
        $globalTemplateParam->set('interv_obj', $interv_obj);
        //$reports_url = $reports_obj->getUrlReports();
		//$globalTemplateParam->set('reports_url',$reports_url);
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->reports_count ? $configs->reports_count : 10;
        
        //$offset = ($page - 1) * $limit;
         
        if($request -> getEscape('url')){
            
            //$item = $reports_obj->getItemByRedir($request->modul);
            $interv_obj->setRedir($request->modul);
			$item = $interv_obj->getInfo();
        	//$item1=$item;
			$fmakeTypeTable = new fmakeTypeTable();
			$absitem_dop = new fmakeSiteModule();
			$absitem_dop->table = $fmakeTypeTable->getTable(12);
			$absitem_dop->setId($item[$interv_obj->idField]);
			$item['dop_params'] = $absitem_dop->getInfo();
            //printAr($item);   
            //$id_gallery = $reports_obj->getGalleryId($item['id']);
            
            $fmakeGallery = new fmakeGallery_Image();
           	$photos = $fmakeGallery->getFullPhoto($item[$interv_obj->idField]);
            $globalTemplateParam->set('photos', $photos);

			$include_param_id_comment = $item[$interv_obj->idField];
			//$include_param_modul = $reports_obj->mod;
			include 'helpModules/comments.php';
			
			$tags = $fmakeTag->getTags($item[$interv_obj->idField]);
			$item['tags'] = $tags;
			
            $modul->title = $item['title'];
            $modul->description = $item['description'];
			$modul->keywords = $item['keywords'];
            
            $breadcrubs = $modul->getBreadCrumbs($item[$interv_obj->idField]);
			
			$globalTemplateParam->set('breadcrubs', $breadcrubs);

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

            $globalTemplateParam->set('item', $item);
            $modul->template = "interv/item.tpl";

        }else{
        	$interv_obj->order = "b.date DESC, a.id";
            $interv_obj->setRedir($request->modul);
            $item = $interv_obj->getInfo();
                
            $intervs = $interv_obj->getByPage($item[$interv_obj->idField], $limit, $page,false,$modul->id,true);
                                
            $count = $interv_obj->getByPageCount($item[$interv_obj->idField],false,$modul->id,true);
			$pages = ceil($count/$limit);
        	
			if ($page < 1) {
				$page = 1;
			}
			elseif ($page > $pages) {
				$page = $pages;
			}
			
			if($intervs)foreach($intervs as $key=>$item_new){
				$tags = $fmakeTag->getTags($item_new[$interv_obj->idField]);
				$intervs[$key]['tags'] = $tags;
			}
			
			$modul->title = $item['title'];
            $modul->description = $item['description'];
			$modul->keywords = $item['keywords'];
			
			$breadcrubs = $modul->getBreadCrumbs($modul->id);
			
			$globalTemplateParam->set('breadcrubs', $breadcrubs);
			$globalTemplateParam->set('pages', $pages);
			$globalTemplateParam->set('page', $page);
			$globalTemplateParam->set('intervs', $intervs);
			
			$modul->template = "interv/all_interv.tpl";
        }
	
		/*$breadcrubs = $modul->getBreadCrumbs($modul->id);	
		$globalTemplateParam->set('breadcrubs', $breadcrubs);
		
		$modul->template = "text/text.tpl";*/
?>
