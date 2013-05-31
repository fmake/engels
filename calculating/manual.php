<?php
	$breadcrubs = $modul->getBreadCrumbs($modul->id);
	$manual_obj = new fmakeManual();
	$fmakeTag = new fmakeSiteModule_tags();
	$globalTemplateParam->set('manual_obj', $manual_obj);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);

	$page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
	$limit = $configs->news_count ? $configs->news_count : 10;

	switch($request->action){
		case 'add_manual':
			//обработка формы и добавление
			//echo('qq');
			$error = false;
			if(!$request->getEscape('parent')) $error['parent'] = "Выберите категорию";
			//if(!$request->getEscape('type_advert')) $error['type_advert'] = "Выберите тип объявления";
			if(!$request->getEscape('caption')) $error['caption'] = "Введите название объявления";
			//if(!$request->getEscape('name_user')) $error['name_user'] = "Введите свое имя";
			//if(!$request->getEscape('email') || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request->getEscape('email'))) $error['email'] = "Некорректный контактный email";
			//if(!$request->getEscape('phone')) $error['phone'] = "Введите контактный телефон";
			if(!$request->getEscape('text')) $error['text'] = "Введите текст объявления";
			
			
			if(!$error){
				$fmakeSiteModulRelation = new fmakeSiteModule_relation();
				$fmakeSiteModuleMultipleCat = new fmakeSiteModule_multiple();
				
				$fmakeManual = new fmakeManual();
				$fmakeManual_dop = new fmakeTypeTable();
				$fmakeManual_dop->table = $fmakeManual_dop->getTable($modul->id);
				
				$fmakeManual->addParam("parent",$request->getEscape('parent'));
				$fmakeManual->addParam("caption",$request->getEscape('caption'));
				$fmakeManual->addParam("title",$request->getEscape('caption'));
				$fmakeManual->addParam("redir",$fmakeManual->transliter($request->getEscape('caption')));
				$fmakeManual->addParam("text",$request->info);
				$fmakeManual->addParam("file","item_manual");
				$fmakeManual->addParam("active",1);
				$fmakeManual->newItem();
				
				/*множественные категории*/
				$fmakeSiteModuleMultipleCat->addParents($_POST['parents'],$fmakeManual -> id);
				/*множественные категории*/
				
				$item_info = $fmakeManual->getInfo();
				$fmakeManual->addParam("redir", $item_info['redir'].$fmakeManual->id);
				$fmakeManual->update();
				
				$fmakeSiteModulRelation->setPageRelation($request->getEscape('parent'), $fmakeManual->id);
				
				$fmakeManual_dop->addParam("id", $fmakeManual->id);
				$fmakeManual_dop->addParam("date", time());
				$fmakeManual_dop->addParam("phone_contakt",$request->getEscape('phone_contakt'));
				$fmakeManual_dop->addParam("fio_contakt",$request->getEscape('fio_contakt'));
				$fmakeManual_dop->addParam("email",$request->getEscape('email'));
				$fmakeManual_dop->addParam("phone",$request->getEscape('phone'));
				
				$fmakeManual_dop->addParam("time_work",$request->getEscape('time_work'));
				$fmakeManual_dop->addParam("web",$request->getEscape('web'));
				$fmakeManual_dop->addParam("addres",$request->getEscape('addres'));
				$fmakeManual_dop->addParam("city",$request->getEscape('city'));
				$fmakeManual_dop->addParam("info",$request->info);
				$fmakeManual_dop->newItem();
				
				if($_FILES['image']['tmp_name'])
					$fmakeManual->addFile($_FILES['image']['tmp_name'], $_FILES['image']['name']);
				
				$add_ok_manual = true;
				$add_ok_manual_id = $fmakeManual->id;
				
				header("HTTP/1.1 301 Moved Permanently");
				header('Location: '.$_SERVER['REQUEST_URI'].'&manualid='.$add_ok_manual_id);
				
				//$globalTemplateParam->set('add_ok_advert', $add_ok_advert);
				//$globalTemplateParam->set('add_ok_advert_id', $add_ok_advert_id);
			}else{
				$globalTemplateParam->set('error', $error);
			}
			//break;
		default:
			if($request -> getEscape('url')) {
				$manual_obj->setRedir($request->modul);
				$item = $manual_obj->getInfo();
				PrintAr($items);
				if($item['file']=='item_manual') {
					$fmakeTypeTable = new fmakeTypeTable();
					$absitem_dop = new fmakeSiteModule();
					$absitem_dop->table = $fmakeTypeTable->getTable($modul->id);
					$absitem_dop->setId($item[$manual_obj->idField]);
					$item['dop_params'] = $absitem_dop->getInfo();
					
					$include_param_id_comment = $item[$manual_obj->idField];
					//$include_param_modul = $news_obj->mod;
					include 'helpModules/comments.php';


					$tags = $fmakeTag->getTags($item[$manual_obj->idField]);
					$item['tags'] = $tags;

					$fmakeGallery = new fmakeGallery_Image();
					$photos = $fmakeGallery->getFullPhoto($item[$manual_obj->idField]);
					$globalTemplateParam->set('photos', $photos);

					$modul->title = $item['title'];
					$modul->description = $item['description'];
					$modul->keywords = $item['keywords'];
					/*теги*/
					$tags = $fmakeTag->getTags($item[$manual_obj->idField]);
					$items['tags'] = $tags;
					/*теги*/
					
					$place_script = $manual_obj->getScriptItemAdmin($item['id']);
					
					$breadcrubs = $modul->getBreadCrumbs($item[$manual_obj->idField]);
					$globalTemplateParam->set('breadcrubs', $breadcrubs);
					$globalTemplateParam->set('item', $item);
					$globalTemplateParam->set('place_script', $place_script);
					$modul->template = "manual/item.tpl"; //exit;
				} else {
				
					$cat = $manual_obj->getCatForMenu($item[$manual_obj->idField],true);
					$parents = $manual_obj->getCats($item[$manual_obj->idField]);
								
					/*multi parent*/		
					$fmakeSiteModuleMultiple = new fmakeSiteModule_multiple();
					$items_site_modul = $fmakeSiteModuleMultiple->ItemsParent($item[$manual_obj->idField]);
					if ($items_site_modul) {
						$multi_parent .=" OR a.id in (";
						foreach($items_site_modul as $key=>$item_site_modul){
							if($key==0) $multi_parent .="{$item_site_modul['id_site_modul']}";
							else $multi_parent .=",{$item_site_modul['id_site_modul']}";
						}
						$multi_parent .=")";
						//if($_GET['debug']) echo $multi_parent;
					} else {
						$multi_parent = '';
					}		
					/*multi parent*/			
					
					$manual_obj->order = "b.date DESC, a.id";
					$manuals = $manual_obj->getByPageAdmin($modul->id, $limit, $page," ( a.parent in ({$parents}) {$multi_parent} ) AND a.`file` = 'item_manual'",true);
					$count = $manual_obj->getByPageCountAdmin($modul->id,$modul->id," ( a.parent in ({$parents}) {$multi_parent} ) AND a.`file` = 'item_manual'",true);
					
					$pages = ceil($count/$limit);
					
					if ($page < 1) {
						$page = 1;
					}
					elseif ($page > $pages) {
						$page = $pages;
					}
					if($manuals)foreach($manuals as $key=>$item_manual) {
						$tags = $fmakeTag->getTags($item_manual[$manual_obj->idField]);
						$manuals[$key]['tags'] = $tags;
					}
					
					$modul->title = $item['title'];
					$modul->description = $item['description'];
					$modul->keywords = $item['keywords'];
					
					$breadcrubs = $modul->getBreadCrumbs($item[$manual_obj->idField]);
					$globalTemplateParam->set('item', $item);
					$globalTemplateParam->set('breadcrubs', $breadcrubs);
					
					$globalTemplateParam->set('manuals', $manuals);
					$globalTemplateParam->set('page', $page);
					$globalTemplateParam->set('pages', $pages);
					$globalTemplateParam->set('item', $item);
					$globalTemplateParam->set('categories', $cat);
					$modul->template = "manual/category.tpl"; //exit;
				}
			} else {
				if($request->getEscape('form') == 'add_manual' ){
					$cat = $manual_obj->getCatForMenu($modul->id,true);
					
					$breadcrubs = $modul->getBreadCrumbs($modul->id);
					$breadcrubs[] = array("caption" => "Добавление компании в справочник","link" => "","redir" => "","id" => "");
					//printAr($breadcrubs);
					$globalTemplateParam->set('breadcrubs', $breadcrubs);
					$globalTemplateParam->set('categories', $cat);
					$modul->template = "manual/form.tpl"; //exit;
				} else {
					$cat = $manual_obj->getCatForMenu($modul->id,true,false,true);

					if($cat)foreach($cat as $key=>$item){
						if($item['child'])foreach($item['child'] as $_key=>$_item){
							$cat[$key]['count'] += $_item['count'];
						}
					}
					
					//echo $request->modul;
					$manual_obj->setRedir($request->modul);
					$item = $manual_obj->getInfo();
					//printAr($item);
					
					//$cat = $manual_obj->getCatForMenu($item[$manual_obj->idField],true);
					
					
					
					$parents = $manual_obj->getCats($item[$manual_obj->idField]);
					
					$manual_obj->order = "b.date DESC, a.id";
					$manuals = $manual_obj->getByPageAdmin(1238, $limit, $page,"a.`file` = 'item_manual'",true);
					$count = $manual_obj->getByPageCountAdmin(1238,1238,"a.`file` = 'item_manual'",true);
					
					$pages = ceil($count/$limit);
					
					if ($page < 1) {
						$page = 1;
					}
					elseif ($page > $pages) {
						$page = $pages;
					}

					if($manuals)foreach($manuals as $key=>$item_manual) {
						$tags = $fmakeTag->getTags($item_manual[$manual_obj->idField]);
						$manuals[$key]['tags'] = $tags;
					}
					
					$modul->title = $item['title'];
					$modul->description = $item['description'];
					$modul->keywords = $item['keywords'];

					//echo $item[$news_obj->idField];
					$breadcrubs = $modul->getBreadCrumbs($item[$manual_obj->idField]);
					$globalTemplateParam->set('breadcrubs', $breadcrubs);
					
					//printAr($breadcrubs);
					
					$globalTemplateParam->set('manuals', $manuals);
					$globalTemplateParam->set('page', $page);
					$globalTemplateParam->set('pages', $pages);
					$globalTemplateParam->set('item', $item);
					$globalTemplateParam->set('categories', $cat);
					$modul->template = "manual/main.tpl";
				}
			}
		break;
	}