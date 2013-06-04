<?php
	$breadcrubs = $modul->getBreadCrumbs($modul->id);
	$immovables_obj = new fmakeImmovables();
	$fmakeTag = new fmakeSiteModule_tags();
	$globalTemplateParam->set('immovables_obj', $immovables_obj);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);

	$page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
	$limit = 15;

	$fmakeImmovablesType = new fmakeImmovables();
	$fmakeImmovablesType->table = $fmakeImmovablesType->table_type;
	$immovablesTypes = $fmakeImmovablesType->getAll(true);
	$globalTemplateParam->set('immovablesTypes', $immovablesTypes);
	
	$time_now = time();
	
	switch($request->action){
		case 'search':
			//printAr($_REQUEST);
			$type = $request->getFilter('type') ? strip_tags($request->getFilter('type')) : null;

			$immovables_obj->setRedir($request->modul);
			$item = $immovables_obj->getInfo();
			$globalTemplateParam->set('item', $item);
			$filters = $_REQUEST['filter'];
			
			$immovables_obj->order = "b.date ASC, a.id";
			$immovables = $immovables_obj->getByPageAdminFilter($filters,$modul->id, $limit, $page,"a.`file` = 'item_immovables' and b.date_end_publick >= {$time_now}",true);
			$count = $immovables_obj->getByPageCountAdminFilter($filters,$modul->id,$modul->id,"a.`file` = 'item_immovables' and b.date_end_publick >= {$time_now}",true);
					
			if ($filters['count_room']) {
				foreach ($filters['count_room'] as $tmp_filt) {
					$filters['count_room_tmp'][$tmp_filt] = true; 
				}
			}
			
			$globalTemplateParam->set('filters', $filters);
			//echo $page;
			$pages = ceil($count/$limit);
			if ($page < 1) {
					$page = 1;
			}
			elseif ($page > $pages) {
					$page = $pages;
			}
						
			if(!$immovables){
				$not_found = true;
				$globalTemplateParam->set('not_found', $not_found);
			}
			else
				$globalTemplateParam->set('immovables', $immovables);
				
			$query_str = "action=search";
		   // printAr($_REQUEST);
			if ($_GET['filter']) foreach ($_GET['filter'] as $key=>$item){
				if ($key == 'price') {
					$query_str .= "&filter[{$key}][to]={$item['to']}";
					$query_str .= "&filter[{$key}][from]={$item['from']}";
				} else {
					$query_str .= "&filter[{$key}]={$item}";
				}
			}
			
			$modul->title = $item['title'];
			$modul->description = $item['description'];
			$modul->keywords = $item['keywords'];
			
			//echo $modul->id;
			$globalTemplateParam->set('breadcrubs', $breadcrubs);
			$globalTemplateParam->set('pages', $pages);
			$globalTemplateParam->set('page', $page);
			$globalTemplateParam->set('query_str', $query_str);
			//printAr($meets);
			$modul->template = "immovables/category.tpl";
			break;
		case 'add_immovables':
			
			//обработка формы и добавление
			$error = false;
			
			/*if (!(($request->getEscape('email') && ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request->getEscape('email'))) || $request->getEscape('phone'))) {
				if (!$request->getEscape('phone')) $error['phone'] = "Ошибка ввода";
				if(!$request->getEscape('email') || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request->getEscape('email'))) $error['email'] = "Некорректный email";
			}*/
			
			//if(!$request->getEscape('email') || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request->getEscape('email'))) $error['email'] = "Некорректный email";
			if (!$request->getEscape('caption')) $error['caption'] = "Ошибка ввода";
			if (!$request->getEscape('parent')) $error['parent'] = "Ошибка ввода";
			if (!$request->getEscape('type')) $error['type'] = "Ошибка ввода";
			if (!$request->getEscape('_date_end_publick')) $error['_date_end_publick'] = "Ошибка ввода";
			//if (!$request->getEscape('count_room')) $error['count_room'] = "Ошибка ввода";
			//if (!$request->getEscape('floor')) $error['floor'] = "Ошибка ввода";
			//if (!$request->getEscape('general_area')) $error['general_area'] = "Ошибка ввода";
			if (!$request->getEscape('price')) $error['price'] = "Ошибка ввода";
			//if (!$request->getEscape('addres')) $error['addres'] = "Ошибка ввода";
			if (!$request->getEscape('info')) $error['info'] = "Ошибка ввода";
			
			
			if (!$error) {
				$fmakeSiteModulRelation = new fmakeSiteModule_relation();
				$fmakeImmovables = new fmakeImmovables();
				
				$fmakeImmovables_dop = new fmakeTypeTable();
				$fmakeImmovables_dop->table = $fmakeImmovables_dop->getTable($modul->id);
				
				$fmakeImmovables->addParam("parent",$request->getEscape('parent'));
				$fmakeImmovables->addParam("caption",$request->getEscape('caption'));
				$fmakeImmovables->addParam("title",$request->getEscape('caption'));
				$fmakeImmovables->addParam("redir",$fmakeImmovables->transliter($request->getEscape('caption')));
				$fmakeImmovables->addParam("text",$request->text);
				$fmakeImmovables->addParam("file","item_immovables");
				$fmakeImmovables->addParam("active",1);
				$fmakeImmovables->newItem();
				
				$item_info = $fmakeImmovables->getInfo();
				$fmakeImmovables->addParam("redir", $item_info['redir'].$fmakeImmovables->id);
				$fmakeImmovables->update();
				
				$fmakeSiteModulRelation->setPageRelation($request->getEscape('parent'), $fmakeImmovables->id);
				
				$fmakeImmovables_dop->addParam("id", $fmakeImmovables->id);
				$fmakeImmovables_dop->addParam("date", time());
				
				switch($request->_date_end_publick){
					case '1week':
						$fmakeImmovables_dop->addParam("date_end_publick", strtotime("+1 week",time()));
						break;
					case '2month':
						$fmakeImmovables_dop->addParam("date_end_publick", strtotime("+2 months",time()));
						break;
					case '1month':
					default:
						$fmakeImmovables_dop->addParam("date_end_publick", strtotime("+1 months",time()));
						break;
				}
				
				/*if($_REQUEST) foreach ($_REQUEST as $key=>$fild) {
					switch($fild){
						default:
							$fmakeImmovables_dop->addParam($fild,$request->getEscape($fild));
							break;
					}
				}*/
				$fmakeImmovables_dop->addParam("type",$request->getEscape("type"));
				$fmakeImmovables_dop->addParam("count_room",$request->getEscape("count_room"));
				$fmakeImmovables_dop->addParam("floor",$request->getEscape("floor"));
				$fmakeImmovables_dop->addParam("floors_home",$request->getEscape("floors_home"));
				$fmakeImmovables_dop->addParam("general_area",$request->getEscape("general_area"));
				$fmakeImmovables_dop->addParam("living_area",$request->getEscape("living_area"));
				$fmakeImmovables_dop->addParam("wc",$request->getEscape("wc"));
				$fmakeImmovables_dop->addParam("state",$request->getEscape("state"));
				$fmakeImmovables_dop->addParam("region",$request->getEscape("region"));
				$fmakeImmovables_dop->addParam("price_m2",$request->getEscape("price_m2"));
				$fmakeImmovables_dop->addParam("price",$request->getEscape("price"));
				$fmakeImmovables_dop->addParam("addres",$request->getEscape("addres"));
				$fmakeImmovables_dop->addParam("phone",$request->getEscape("phone"));
				$fmakeImmovables_dop->addParam("email",$request->getEscape("email"));
				$fmakeImmovables_dop->addParam("name_user",$request->getEscape("name_user"));
				$fmakeImmovables_dop->addParam("info",$request->getEscape("info"));
				//printAr($_REQUEST);
				//exit();
				$fmakeImmovables_dop->newItem();
				
				if($_FILES['image']['tmp_name'])
					$fmakeImmovables->addFile($_FILES['image']['tmp_name'], $_FILES['image']['name']);
				
				$add_ok_advert = true;
				$add_ok_id = $fmakeImmovables->id;
				
				header("HTTP/1.1 301 Moved Permanently");
				header('Location: '.$_SERVER['REQUEST_URI'].'&immovableid='.$add_ok_id);
				
			}else{
				//echo 'error';
				$globalTemplateParam->set('error', $error);
			}
			
			//break;
		default:
		if($request -> getEscape('url')) {
			//$url_arr = explode('/', $request -> getEscape('url'));
			
			//list($main_cat, $cat, $item) = $url_arr;

			$immovables_obj->setRedir($request->modul);
			$item = $immovables_obj->getInfo();
			
			if ($item['file']=='item_immovables') {
				$fmakeTypeTable = new fmakeTypeTable();
				$absitem_dop = new fmakeSiteModule();
				$absitem_dop->table = $fmakeTypeTable->getTable($modul->id);
				$absitem_dop->setId($item[$immovables_obj->idField]);
				$item['dop_params'] = $absitem_dop->getInfo();
				
				if ($item['dop_params']['date_end_publick']<=$time_now) {
					$modul->error404();
				}
				
				//printAr($item);
				
				$limit_photo = 6;
				$fmakeGallery = new fmakeGallery_Image();
				$photos = $fmakeGallery->getNumPhoto($item[$immovables_obj->idField],$limit_photo);
				$globalTemplateParam->set('photos', $photos);
				
				$include_param_id_comment = $item[$immovables_obj->idField];
				//$include_param_modul = $immovables_obj->mod;
				include 'helpModules/comments.php';


				$tags = $fmakeTag->getTags($item[$immovables_obj->idField]);
				$item['tags'] = $tags;


				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];
				/*теги*/
				$tags = $fmakeTag->getTags($item[$immovables_obj->idField]);
				$items['tags'] = $tags;
				/*теги*/
				$breadcrubs = $modul->getBreadCrumbs($item[$immovables_obj->idField]);
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


				$modul->template = "immovables/item.tpl"; //exit;
			} else {
				
				$cat = $immovables_obj->getCatForMenu($item[$immovables_obj->idField],true);
				$parents = $immovables_obj->getCats($item[$immovables_obj->idField]);
				
				//$news = $immovables_obj->getByPage($item[$immovables_obj->idField], $limit, $page,"a.`file` = 'item_news'",$modul->id,true);				
				//$count = $immovables_obj->getByPageCount($item[$immovables_obj->idField],"a.`file` = 'item_news'",$modul->id,true);
				$immovables_obj->order = "b.date DESC, a.id";
				$immovables = $immovables_obj->getByPageAdmin($modul->id, $limit, $page,"a.parent in ({$parents}) AND a.`file` = 'item_immovables' and b.date_end_publick >= {$time_now}",true);
				$count = $immovables_obj->getByPageCountAdmin($modul->id,$modul->id,"a.parent in ({$parents}) AND a.`file` = 'item_immovables' and b.date_end_publick >= {$time_now}",true);
				
				$pages = ceil($count/$limit);
				
				if ($page < 1) {
					$page = 1;
				}
				elseif ($page > $pages) {
					$page = $pages;
				}
				if($immovables)foreach($immovables as $key=>$item_new){
					$tags = $fmakeTag->getTags($item_new[$immovables_obj->idField]);
					$immovables[$key]['tags'] = $tags;
				}
				
				
				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];

				
				
				$breadcrubs = $modul->getBreadCrumbs($item[$immovables_obj->idField]);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				
				$globalTemplateParam->set('immovables', $immovables);
				$globalTemplateParam->set('page', $page);
				$globalTemplateParam->set('pages', $pages);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('categories', $cat);
				$modul->template = "immovables/category.tpl"; //exit;
			}
		} else {
			if ($request->getEscape('form') == 'add_immovable' ) {
				$cat = $immovables_obj->getChilds($modul->id,true);
				
				$breadcrubs = $modul->getBreadCrumbs($modul->id);
				$breadcrubs[] = array("caption" => "Добавление недвижимости","link" => "","redir" => "","id" => "");
				//printAr($breadcrubs);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				$globalTemplateParam->set('categories', $cat);
				$modul->template = "immovables/form.tpl"; //exit;
			} else {
				//echo $request->modul;
				$immovables_obj->setRedir($request->modul);
				$item = $immovables_obj->getInfo();
				//printAr($item);
				
				$cat = $immovables_obj->getCatForMenu($item[$immovables_obj->idField],true);
				$parents = $immovables_obj->getCats($item[$immovables_obj->idField]);
				
				$immovables_obj->order = "b.date DESC, a.id";
				$immovables = $immovables_obj->getByPageAdmin($modul->id, $limit, $page,"a.`file` = 'item_immovables' and b.date_end_publick >= {$time_now}",true);
				$count = $immovables_obj->getByPageCountAdmin($modul->id,$modul->id,"a.`file` = 'item_immovables' and b.date_end_publick >= {$time_now}",true);
				//$news = $immovables_obj->getByPageAdmin($modul->id, $limit, $page,"a.parent in ({$parents}) AND a.`file` = 'item_news'",true);
				//$count = $immovables_obj->getByPageCountAdmin($modul->id,$modul->id,"a.parent in ({$parents}) AND a.`file` = 'item_news'",true);
				
				$pages = ceil($count/$limit);
				
				if ($page < 1) {
					$page = 1;
				}
				elseif ($page > $pages) {
					$page = $pages;
				}

				if($immovables)foreach($immovables as $key=>$item_new){
					$tags = $fmakeTag->getTags($item_new[$immovables_obj->idField]);
					$immovables[$key]['tags'] = $tags;
				}
				
				$modul->title = $item['title'];
				$modul->description = $item['description'];
				$modul->keywords = $item['keywords'];

				//echo $item[$immovables_obj->idField];
				$breadcrubs = $modul->getBreadCrumbs($item[$immovables_obj->idField]);
				$globalTemplateParam->set('breadcrubs', $breadcrubs);
				
				//printAr($breadcrubs);
				
				$globalTemplateParam->set('immovables', $immovables);
				$globalTemplateParam->set('page', $page);
				$globalTemplateParam->set('pages', $pages);
				$globalTemplateParam->set('item', $item);
				$globalTemplateParam->set('categories', $cat);
				$modul->template = "immovables/category.tpl";
			}
			
		}
		break;
	}
