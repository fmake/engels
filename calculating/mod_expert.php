<?php
	$breadcrubs = $modul->getBreadCrumbs($modul->id);
	$expert_obj = new fmakeExpert();
	$fmakeTag = new fmakeSiteModule_tags();
	$globalTemplateParam->set('expert_obj', $expert_obj);
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
