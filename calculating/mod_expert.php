<?php
	$breadcrubs = $modul->getBreadCrumbs($modul->id);
	$expert_obj = new fmakeExpert();
	$fmakeTag = new fmakeSiteModule_tags();
	$globalTemplateParam->set('expert_obj', $expert_obj);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);

	$page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
	$limit = $configs->news_count ? $configs->news_count : 10;


		/*---------опрос-----------*/
		$fmakeInterview = new fmakeInterview();
		$limit_int = 1;
		$interview = $fmakeInterview->getInterview($limit_int,true); 
		
		$iscookie = array();
		$vopros = array();
		if ($interview) foreach ($interview as $key=>$interview_item) {
			
			$fmakeInterview->table = $fmakeInterview->table_vopros;
			$vopros[$key] = $fmakeInterview->getVoproses($interview_item['id'],true);
			if($request->interview_id != $interview_item['id']) {
				$iscookie[$key] = $fmakeInterview->isCookies($interview_item['id']);
			} else {
				if($iscookie_no_error) $iscookie[$key] = true;
				else $iscookie[$key] = false;
			}
		}
		$globalTemplateParam->set('vopros',$vopros);
		$globalTemplateParam->set('interview',$interview);
		$globalTemplateParam->set('iscookie',$iscookie);
		/*---------опрос-----------*/
	
	$expert_obj->setRedir($request->modul);
	$item = $expert_obj->getInfo();
	
	if($item['file']=='item_expert') {
		$fmakeTypeTable = new fmakeTypeTable();
		$absitem_dop = new fmakeSiteModule();
		$absitem_dop->table = $fmakeTypeTable->getTable($modul->id);
		$absitem_dop->setId($item[$expert_obj->idField]);
		$item['dop_params'] = $absitem_dop->getInfo();
		
		$fmakeSiteUser = new fmakeSiteUser($item['dop_params']['id_user']);
		$item['expert'] = $fmakeSiteUser->getInfo();
		
		$include_param_id_comment = $item[$expert_obj->idField];
		include 'helpModules/vopros_expert.php';

		$tags = $fmakeTag->getTags($item[$expert_obj->idField]);
		$item['tags'] = $tags;

		$modul->title = $item['title'];
		$modul->description = $item['description'];
		$modul->keywords = $item['keywords'];
		/*теги*/
		$tags = $fmakeTag->getTags($item[$expert_obj->idField]);
		$item['tags'] = $tags;
		/*теги*/
		$breadcrubs = $modul->getBreadCrumbs($item[$expert_obj->idField]);
		$globalTemplateParam->set('breadcrubs', $breadcrubs);
		$globalTemplateParam->set('item', $item);


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

		$modul->template = "expert/item.tpl"; //exit;
	} else {
		//$expert_obj->order = "b.date DESC, a.id";
		//$expert_obj->setRedir($request->modul);
		//$item = $expert_obj->getInfo();
		
		$expert_obj->order = "b.date DESC, a.id";
		$items = $expert_obj->getByPageAdmin($modul->id, $limit, $page,"a.`file` = 'item_expert'",true);
		$count = $expert_obj->getByPageCountAdmin($modul->id,$modul->id,"a.`file` = 'item_expert'",true);
		
		$pages = ceil($count/$limit);
		
		if ($page < 1) {
			$page = 1;
		}
		elseif ($page > $pages) {
			$page = $pages;
		}
		
		$fmakeComments = new fmakeComments_expert();
		if($items)foreach($items as $key=>$item_new){
			$fmakeSiteUser = new fmakeSiteUser($item_new['id_user']);
			$items[$key]['expert'] = $fmakeSiteUser->getInfo();
			$items[$key]['comment'] = $fmakeComments->getByPageCount($item_new[$expert_obj->idField],true);
		}
		
		
		$modul->title = $item['title'];
		$modul->description = $item['description'];
		$modul->keywords = $item['keywords'];

		
		
		$breadcrubs = $modul->getBreadCrumbs($item[$expert_obj->idField]);
		$globalTemplateParam->set('item', $item);
		$globalTemplateParam->set('breadcrubs', $breadcrubs);
		
		$globalTemplateParam->set('items', $items);
		$globalTemplateParam->set('page', $page);
		$globalTemplateParam->set('pages', $pages);
		$globalTemplateParam->set('item', $item);
		$modul->template = "expert/category.tpl"; //exit;
	}
?>
