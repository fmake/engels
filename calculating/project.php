<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $project_obj = new fmakeProject();
		$fmakeTag = new fmakeSiteModule_tags();
        $globalTemplateParam->set('project_obj', $project_obj);
        $globalTemplateParam->set('breadcrubs', $breadcrubs);

        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->news_count ? $configs->news_count : 10;

		
		
		if($request -> getEscape('url')) {
			//$url_arr = explode('/', $request -> getEscape('url'));
			
			//list($main_cat, $cat, $item) = $url_arr;

			$project_obj->setRedir($request->modul);
			$item = $project_obj->getInfo();
			
			if($item['file']=='item_project') {
				//$project_obj->setRedir($request->modul);
				//$item = $project_obj->getInfo();
				
				$fmakeTypeTable = new fmakeTypeTable();
				$absitem_dop = new fmakeSiteModule();
				$absitem_dop->table = $fmakeTypeTable->getTable(2);
				$absitem_dop->setId($item[$project_obj->idField]);
				$item['dop_params'] = $absitem_dop->getInfo();
				
				$include_param_id_comment = $item[$project_obj->idField];
				//$include_param_modul = $project_obj->mod;
				include 'helpModules/comments.php';
				PrintAr("sdfasdfasdfadsfadsfasdfasdf");

				$tags = $fmakeTag->getTags($item[$project_obj->idField]);
				$item['tags'] = $tags;


				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];
				/*теги*/
				$tags = $fmakeTag->getTags($item[$project_obj->idField]);
				$items['tags'] = $tags;
				/*теги*/
				$breadcrubs = $modul->getBreadCrumbs($item[$project_obj->idField]);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				$globalTemplateParam->set('item', $item);
				$modul->template = "project/item.tpl"; //exit;
			} else {
				
				$cat = $project_obj->getCatForMenu($item[$project_obj->idField],true);
				$parents = $project_obj->getCats($item[$project_obj->idField]);
				
				$project_obj->order = "b.date DESC, a.id";
				$items = $project_obj->getByPageAdmin($modul->id, $limit, $page,"a.parent in ({$parents}) AND a.`file` = 'item_project'",true);
				$count = $project_obj->getByPageCountAdmin($modul->id,$modul->id,"a.parent in ({$parents}) AND a.`file` = 'item_project'",true);
				
				$pages = ceil($count/$limit);
				
				if ($page < 1) {
					$page = 1;
				}
				elseif ($page > $pages) {
					$page = $pages;
				}
				if ($items) foreach($items as $key=>$item_new) {
					$tags = $fmakeTag->getTags($item_new[$project_obj->idField]);
					$items[$key]['tags'] = $tags;
				}
				
				
				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];

				
				
				$breadcrubs = $modul->getBreadCrumbs($item[$project_obj->idField]);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				
				$globalTemplateParam->set('items', $items);
				$globalTemplateParam->set('page', $page);
				$globalTemplateParam->set('pages', $pages);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('categories', $cat);
				$modul->template = "project/category.tpl"; //exit;
			}
		} else {
			
			//echo $request->modul;
			$project_obj->setRedir($request->modul);
			$item = $project_obj->getInfo();
			//printAr($item);
			
			$cat = $project_obj->getCatForMenu($item[$project_obj->idField],true);
			$parents = $project_obj->getCats($item[$project_obj->idField]);
			
			$project_obj->order = "b.date DESC, a.id";
			$items = $project_obj->getByPageAdmin($modul->id, $limit, $page,"a.`file` = 'item_project'",true);
			$count = $project_obj->getByPageCountAdmin($modul->id,$modul->id,"a.`file` = 'item_project'",true);
			
			$pages = ceil($count/$limit);
			
			if ($page < 1) {
				$page = 1;
			}
			elseif ($page > $pages) {
				$page = $pages;
			}

			if($items)foreach($items as $key=>$item_new){
				$tags = $fmakeTag->getTags($item_new[$project_obj->idField]);
				$items[$key]['tags'] = $tags;
			}
			
			$modul->title = $item['title'];
            $modul->description = $item['description'];
			$modul->keywords = $item['keywords'];

			//echo $item[$project_obj->idField];
			$breadcrubs = $modul->getBreadCrumbs($item[$project_obj->idField]);
			$globalTemplateParam->set('breadcrubs', $breadcrubs);
			
			//printAr($breadcrubs);
			
			$globalTemplateParam->set('items', $items);
			$globalTemplateParam->set('page', $page);
			$globalTemplateParam->set('pages', $pages);
			$globalTemplateParam->set('item', $item);
			$globalTemplateParam->set('categories', $cat);
			$modul->template = "project/category.tpl";
			
		}
?>
