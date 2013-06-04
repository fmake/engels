<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
				
        $advert_obj = new fmakeAdvert();
		$globalTemplateParam->set('advert_obj', $advert_obj);
               
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;

        $limit = $configs->news_count ? $configs->news_count : 10;
                
        //printAr($_REQUEST);
        
        switch($request->action){
			case 'add_advert':
				//обработка формы и добавление
				//echo('qq');
				$error = false;
				if(!$request->getEscape('parent')) $error['parent'] = "Выберите категорию";
				//if(!$request->getEscape('type_advert')) $error['type_advert'] = "Выберите тип объявления";
				if(!$request->getEscape('caption')) $error['caption'] = "Введите название объявления";
				if(!$request->getEscape('name_user')) $error['name_user'] = "Введите свое имя";
				if(!$request->getEscape('email') || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request->getEscape('email'))) $error['email'] = "Некорректный контактный email";
				//if(!$request->getEscape('phone')) $error['phone'] = "Введите контактный телефон";
				if(!$request->getEscape('text')) $error['text'] = "Введите текст объявления";
				
				
				if(!$error){
					$fmakeSiteModulRelation = new fmakeSiteModule_relation();
					$fmakeAdvert = new fmakeAdvert();
					
					$fmakeAdvert = new fmakeAdvert();
					$fmakeAdvert_dop = new fmakeTypeTable();
					$fmakeAdvert_dop->table = $fmakeAdvert_dop->getTable($modul->id);
					
					$fmakeAdvert->addParam("parent",$request->getEscape('parent'));
					$fmakeAdvert->addParam("caption",$request->getEscape('caption'));
					$fmakeAdvert->addParam("title",$request->getEscape('caption'));
					$fmakeAdvert->addParam("redir",$fmakeAdvert->transliter($request->getEscape('caption')));
					$fmakeAdvert->addParam("text",$request->text);
					$fmakeAdvert->addParam("file","item_advert");
					$fmakeAdvert->addParam("active",1);
					$fmakeAdvert->newItem();
					
					$item_info = $fmakeAdvert->getInfo();
					$fmakeAdvert->addParam("redir", $item_info['redir'].$fmakeAdvert->id);
					$fmakeAdvert->update();
					
					$fmakeSiteModulRelation->setPageRelation($request->getEscape('parent'), $fmakeAdvert->id);
					
					$fmakeAdvert_dop->addParam("id", $fmakeAdvert->id);
					if ($user->id) $fmakeAdvert_dop->addParam("id_user", $user->id);
					$fmakeAdvert_dop->addParam("date", time());
					$fmakeAdvert_dop->addParam("type_advert",$request->getEscape('type_advert'));
					$fmakeAdvert_dop->addParam("name_user",$request->getEscape('name_user'));
					$fmakeAdvert_dop->addParam("email",$request->getEscape('email'));
					$fmakeAdvert_dop->addParam("phone",$request->getEscape('phone'));
					$fmakeAdvert_dop->addParam("price",$request->getEscape('price'));
					$fmakeAdvert_dop->newItem();
					
					if($_FILES['image']['tmp_name'])
						$fmakeAdvert->addFile($_FILES['image']['tmp_name'], $_FILES['image']['name']);
					
					$add_ok_advert = true;
					$add_ok_advert_id = $fmakeAdvert->id;
					
					header("HTTP/1.1 301 Moved Permanently");
					header('Location: '.$_SERVER['REQUEST_URI'].'&advertid='.$add_ok_advert_id);
					
					//$globalTemplateParam->set('add_ok_advert', $add_ok_advert);
					//$globalTemplateParam->set('add_ok_advert_id', $add_ok_advert_id);
				}else{
					$globalTemplateParam->set('error', $error);
				}
				//break;
			default:
				if($request -> getEscape('url')){
					$url_arr = explode('/', $request -> getEscape('url'));
					
					//printAr($url_arr);
					//list($main_cat, $cat, $item) = $url_arr;
			
					if(sizeof($url_arr) == 4){
						//echo 'qq';
						$advert_obj->setRedir($request->modul);
						$item = $advert_obj->getInfo();
					
						$fmakeTypeTable = new fmakeTypeTable();
						$absitem_dop = new fmakeSiteModule();
						$absitem_dop->table = $fmakeTypeTable->getTable($modul->id);
						$absitem_dop->setId($item[$advert_obj->idField]);
						$item['dop_params'] = $absitem_dop->getInfo();
					
						$globalTemplateParam->set('item', $item);
						$modul->title = $item['title'];
						$modul->description = $item['description'];
						$modul->keywords = $item['keywords'];
						
						$breadcrubs = $advert_obj->getBreadCrumbs($item[$advert_obj->idField]);
						
						$globalTemplateParam->set('breadcrubs', $breadcrubs);

						#---------------------------------------------------------------новый функционал
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
						#---------------------------------------------------------------новый функционал

						$modul->template = "advert/item.tpl"; //exit;
					}else{
												
						$advert_obj->setRedir($request->modul);
						$item = $advert_obj->getInfo();
						
						$cat = $advert_obj->getCatForMenu($item[$item[$advert_obj->idField]],true);
						
						$modul->title = $item['title'];
						$modul->description = $item['description'];
						$modul->keywords = $item['keywords'];
						
						$parents = $advert_obj->getCats($item[$advert_obj->idField]);
						
						//printAr($parents);
						//exit();
						$advert_obj->order = "b.date DESC, a.id";
						$adverts = $advert_obj->getByPageAdmin($modul->id, $limit, $page,"a.parent in ({$parents}) AND a.`file` = 'item_advert'",true);
						$count = $advert_obj->getByPageCountAdmin($modul->id,$modul->id,"a.parent in ({$parents}) AND a.`file` = 'item_advert'",true);
						
						$pages = ceil($count/$limit);
						//printAr($places);
						if ($page < 1) {
								$page = 1;
						}
						elseif ($page > $pages) {
								$page = $pages;
						}
						
						$breadcrubs = $modul->getBreadCrumbs($item[$advert_obj->idField]);
						//printAr($item);
						$globalTemplateParam->set('adverts', $adverts);
						$globalTemplateParam->set('item', $item);
						$globalTemplateParam->set('pages', $pages);
						$globalTemplateParam->set('page', $page);
						$globalTemplateParam->set('categories', $cat);
						$globalTemplateParam->set('breadcrubs', $breadcrubs);
						$modul->template = "advert/category.tpl"; //exit;
					}
				}else{
					if($request->getEscape('form') == 'add_advert' ){
						$cat = $advert_obj->getCatForMenu($modul->id,true);
						
						$breadcrubs = $modul->getBreadCrumbs($modul->id);
						$breadcrubs[] = array("caption" => "Добавление объявления","link" => "","redir" => "","id" => "");
						//printAr($breadcrubs);
						$globalTemplateParam->set('breadcrubs', $breadcrubs);
						$globalTemplateParam->set('categories', $cat);
						$modul->template = "advert/form.tpl"; //exit;
					}
					else{
						$cat = $advert_obj->getCatForMenu($modul->id,true,false,true);

						if($cat)foreach($cat as $key=>$item){
							if($item['child'])foreach($item['child'] as $_key=>$_item){
								$cat[$key]['count'] += $_item['count'];
							}
						}
						
						$advert_obj->order = "b.date DESC, a.id";
						$advert_obj->setRedir($request->modul);
						$item = $advert_obj->getInfo();
						
						$modul->title = $item['title'];
						$modul->description = $item['description'];
						$modul->keywords = $item['keywords'];
												
						$breadcrubs = $modul->getBreadCrumbs($item[$advert_obj->idField]);
						//printAr($item);
						$globalTemplateParam->set('places', $places);
						$globalTemplateParam->set('item', $item);
						$globalTemplateParam->set('pages', $pages);
						$globalTemplateParam->set('page', $page);
						$globalTemplateParam->set('categories', $cat);
						$globalTemplateParam->set('breadcrubs', $breadcrubs);
						$modul->template = "advert/main.tpl"; //exit;
					}
				}
				break;
		}
		
?>
