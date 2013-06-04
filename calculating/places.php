<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
		
        $places_obj = new fmakePlace();
		$fmakeTag = new fmakeSiteModule_tags();
		$globalTemplateParam->set('places_obj', $places_obj);
               
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        
        $limit = $configs->news_count ? $configs->news_count : 10;
                
		$cat = $places_obj->getChilds($modul->id,true);
		$globalTemplateParam->set('categories', $cat);
		
        switch ($request->getFilter('action')) {
            case 'search':
                    $search_string = $request->getFilter('search_string') ? strip_tags($request->getFilter('search_string')) : null;
                    $category = $request->getFilter('event_category') ? strip_tags($request->getFilter('event_category')) : null;

                    $places_obj->setRedir($request->modul);
					$item = $places_obj->getInfo();
                    $globalTemplateParam->set('item', $item);
                    
                    $places_obj_search = new fmakePlace();
                    $places_obj_search->order = "b.date ASC, a.id";
                    $places = $places_obj_search->setSearch($search_string,$category,$modul->id,$limit,$page);
					$count = $places_obj_search->setSearchCount($search_string,$category, $modul->id);
					
                    $pages = ceil($count/$limit);
                    if ($page < 1) {
                            $page = 1;
                    } elseif ($page > $pages) {
                            $page = $pages;
                    }
                    
                    $globalTemplateParam->set('search_string', $search_string);
                    $globalTemplateParam->set('event_category', $category);
                                        
                    if (!$places) {
                        $not_found = true;
                        $globalTemplateParam->set('not_found', $not_found);
                    } else {
                        $globalTemplateParam->set('places', $places);
                    }    
                    $query_str = "";
                    if ($_GET['filter']) foreach ($_GET['filter'] as $key=>$item) {
                    	$query_str .= "&filter[{$key}]={$item}";
                    }
					
                    $globalTemplateParam->set('breadcrubs', $breadcrubs);
                    $globalTemplateParam->set('pages', $pages);
                    $globalTemplateParam->set('page', $page);
                    $globalTemplateParam->set('query_str', $query_str);
                    $modul->template = "places/category.tpl";
                break;
			default:
				switch ($request->action) {
					case 'add_place':
						//обработка формы и добавление
						$error = false;
						$filds = $request->getEscape('filds');
						$filds = explode(',',$filds);
						if($filds)foreach($filds as $key=>$fild){
							switch($fild){
								case 'wifi':
								case 'bron_cherez_engels':
								case 'business_lunch':
								case 'banket':
									break;
								case 'email':
									if(!$request->getEscape('email') || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request->getEscape('email'))) $error['email'] = "Некорректный email";
									break;
								default:
									if(!$request->getEscape($fild)) $error[$fild] = "Ошибка ввода";
									break;
							}
						}				
						
						if (!$error) {
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
							$fmakeAdvert->addParam("file","item_place");
							$fmakeAdvert->addParam("active",0);
							$fmakeAdvert->newItem();
							
							$item_info = $fmakeAdvert->getInfo();
							$fmakeAdvert->addParam("redir", $item_info['redir'].$fmakeAdvert->id);
							$fmakeAdvert->update();
							
							$fmakeSiteModulRelation->setPageRelation($request->getEscape('parent'), $fmakeAdvert->id);
							
							$fmakeAdvert_dop->addParam("id", $fmakeAdvert->id);
							$fmakeAdvert_dop->addParam("date", time());
							if ($filds) foreach ($filds as $key=>$fild) {
								switch ($fild) {
									default:
										$fmakeAdvert_dop->addParam($fild,$request->getEscape($fild));
										break;
								}
							}
							$fmakeAdvert_dop->newItem();
							
							if ($_FILES['image']['tmp_name'])
								$fmakeAdvert->addFile($_FILES['image']['tmp_name'], $_FILES['image']['name']);
							
							$add_ok_advert = true;
							$add_ok_place_id = $fmakeAdvert->id;
							
							header("HTTP/1.1 301 Moved Permanently");
							header('Location: '.$_SERVER['REQUEST_URI'].'&placeid='.$add_ok_place_id);
							
						} else {
							$globalTemplateParam->set('error', $error);
						}
						//break;
					default:
						if ($request -> getEscape('url')) {
							$url_arr = explode('/', $request -> getEscape('url'));
							
							list($main_cat, $categ, $item) = $url_arr;
					
							if (is_string($item)) {;
								//$item = $places_obj->getItemByRedir($request->modul);
								$places_obj->setRedir($request->modul);
								$item = $places_obj->getInfo();
							
								$fmakeTypeTable = new fmakeTypeTable();
								$absitem_dop = new fmakeSiteModule();
								$absitem_dop->table = $fmakeTypeTable->getTable($modul->id);
								$absitem_dop->setId($item[$places_obj->idField]);
								$item['dop_params'] = $absitem_dop->getInfo();
							
								/*rating*/
								$id_content = $item[$places_obj->idField];
								$fmakeRating = new fmakeRating();
								$rating_show = $fmakeRating->showRating($id_content);
								$globalTemplateParam->set('rating_show', $rating_show);
								/*rating*/
							
								/*афиши*/
								$meets_obj = new fmakeMeets();
								
								$date = strtotime("today");
								
								$meets_obj->order = "b.date DESC, a.id";
								$items_meets = $meets_obj->getByPageAdmin(4, false,false,"a.`file` = 'item_meets' and b.date >= '{$date}' and b.`id_place` = '{$item[$places_obj->idField]}'",true);
								$globalTemplateParam->set('items_meets', $items_meets);
								/*афиши*/
							
								/*фоторепортажи*/
								$photo_obj = new fmakeSiteModule();
								$photo_obj->order = "b.date DESC, a.id";
								$items_photo_report = $photo_obj->getByPageAdmin(9, false,false,"a.`file` = 'item_photo_reports' and b.`id_place` = '{$item[$places_obj->idField]}'",true);
								$globalTemplateParam->set('items_photo_report', $items_photo_report);
								/*фоторепортажи*/
							
													
								$globalTemplateParam->set('item', $item);
								$modul->title = $item['title'];
								$modul->description = $item['description'];
								$modul->keywords = $item['keywords'];
								
								$limit_photo = 16;
								$fmakeGallery = new fmakeGallery_Image();
								$photos = $fmakeGallery->getFullPhoto($item[$places_obj->idField]);
								$count = $fmakeGallery->getByPageCount($item[$places_obj->idField]);
								$pages = ceil($count/$limit_photo);
								
								$gap['to'] = ($page-1)*$limit_photo;
								$gap['from'] = ($page-1)*$limit_photo+$limit_photo-1;
								$globalTemplateParam->set('gap',$gap);
								$globalTemplateParam->set('photos', $photos);
								$globalTemplateParam->set('pages', $pages);
								$globalTemplateParam->set('page', $page);
								
								$include_param_id_comment = $item[$places_obj->idField];
								include 'helpModules/comments.php';
								
								$tags = $fmakeTag->getTags($item[$places_obj->idField]);
								$item['tags'] = $tags;
								
								$breadcrubs = $places_obj->getBreadCrumbs($item[$places_obj->idField]);
								
								$place_script = $places_obj->getScriptItemAdmin($item['id']);
								
								$globalTemplateParam->set('gallery_obj', $fmakeGallery);
								$globalTemplateParam->set('breadcrubs', $breadcrubs);
								$globalTemplateParam->set('place_script', $place_script);

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

								$modul->template = "places/item.tpl"; //exit;
							} elseif(is_string($categ)) {
																
								$places_obj->order = "b.date DESC, a.id";
								$places_obj->setRedir($request->modul);
								$item = $places_obj->getInfo();
								
								$modul->title = $item['title'];
								$modul->description = $item['description'];
								$modul->keywords = $item['keywords'];
								
								
								$places = $places_obj->getByPage($item[$places_obj->idField], $limit, $page,false,$modul->id,true);
								
								$count = $places_obj->getByPageCount($item[$places_obj->idField],false,$modul->id,true);
								$pages = ceil($count/$limit);
								if ($page < 1) {
										$page = 1;
								}
								elseif ($page > $pages) {
										$page = $pages;
								}

								if($places)foreach($places as $key=>$item_new){
									$tags = $fmakeTag->getTags($item_new[$places_obj->idField]);
									$places[$key]['tags'] = $tags;
								}
								
								$breadcrubs = $modul->getBreadCrumbs($item[$places_obj->idField]);
								$globalTemplateParam->set('places', $places);
								$globalTemplateParam->set('item', $item);
								$globalTemplateParam->set('pages', $pages);
								$globalTemplateParam->set('page', $page);
								$globalTemplateParam->set('breadcrubs', $breadcrubs);
								$modul->template = "places/category.tpl"; //exit;
							}
						} else {
							if ($request->maps) {
								$places_obj = new fmakePlace();
								$place_script = $places_obj->getScriptAll();		
								$breadcrubs = $places_obj->getBreadCrumbs($modul->id);
								$breadcrubs[] = array("caption" => "Карта мест","link" => "","redir" => "","id" => "");
								
								$globalTemplateParam->set('place_script', $place_script);
								$globalTemplateParam->set('breadcrubs', $breadcrubs);
								$modul->template = "places/all_place.tpl";
							} elseif ($request->getEscape('form') == 'add_place' ) {
								$breadcrubs = $modul->getBreadCrumbs($modul->id);
								$breadcrubs[] = array("caption" => "Добавление места","link" => "","redir" => "","id" => "");
								$globalTemplateParam->set('breadcrubs', $breadcrubs);
								$modul->template = "places/form.tpl";
							} else {
								$places_obj->order = "b.date DESC, a.id";
								$places_obj->setRedir($request->modul);
								$item = $places_obj->getInfo();
								
								$modul->title = $item['title'];
								$modul->description = $item['description'];
								
								
								$places = $places_obj->getByPageAdmin($modul->id, $limit, $page,"a.`file` = 'item_place' ",true);
								
								$count = $places_obj->getByPageCountAdmin($modul->id,$modul->id,"a.`file` = 'item_place'",true);
								$pages = ceil($count/$limit);
								if ($page < 1) {
										$page = 1;
								}
								elseif ($page > $pages) {
										$page = $pages;
								}

								if($places)foreach($places as $key=>$item_new){
									$tags = $fmakeTag->getTags($item_new[$places_obj->idField]);
									$places[$key]['tags'] = $tags;
								}
								
								$breadcrubs = $modul->getBreadCrumbs($item[$places_obj->idField]);
								$globalTemplateParam->set('places', $places);
								$globalTemplateParam->set('item', $item);
								$globalTemplateParam->set('pages', $pages);
								$globalTemplateParam->set('page', $page);
								$globalTemplateParam->set('breadcrubs', $breadcrubs);
								$modul->template = "places/category.tpl"; //exit;
							}
						}
					break;
				}
				break;
		}
?>
