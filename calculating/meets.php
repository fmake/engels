<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $meets_obj = new fmakeSiteModule();
		$fmakeTag = new fmakeSiteModule_tags();
        $globalTemplateParam->set('meets_obj', $meets_obj);
        
        $page = ($request->page)? $request->page : 1; 

        $limit = $configs->news_count ? $configs->news_count : 10;
        //printAr($limit);

        $cat = $meets_obj->getChilds($modul->id,true);
        
        $globalTemplateParam->set('categories', $cat);
        
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
        /*switch($request->getFilter('action')){
            case 'search':
                    $search_string = $request->getFilter('search_string') ? strip_tags($request->getFilter('search_string')) : null;
                    $category = $request->getFilter('event_category') ? strip_tags($request->getFilter('event_category')) : null;
                    $date = $request->getFilter('event_date') ? strip_tags($request->getFilter('event_date')) : null;

                    $meets_obj->setRedir($request->modul);
					$item = $meets_obj->getInfo();
                    $globalTemplateParam->set('item', $item);
                    
                    $meets_obj_search = new fmakeMeets();
                    $meets_obj_search->order = "b.date_from ASC, a.id";
                    $meets = $meets_obj_search->setSearch($search_string,$date,$category,$modul->id,$limit,$page);
					$count = $meets_obj_search->setSearchCount($search_string, $date, $category, $modul->id);
					
					if($date){
						$date_html = $meets_obj_search->dateFilter($date);
						$globalTemplateParam->set('search_date_to', $date_html['to']);
						$globalTemplateParam->set('search_date_from', $date_html['from']);
					}
					
					//echo $page;
                    $pages = ceil($count/$limit);
                    if ($page < 1) {
                            $page = 1;
                    }
                    elseif ($page > $pages) {
                            $page = $pages;
                    }
                    
                    $globalTemplateParam->set('search_string', $search_string);
                    $globalTemplateParam->set('event_category', $category);
                    if(preg_match("/(\d{2})\.(\d{2})\.(\d{4})/", $date)){
                        $globalTemplateParam->set('date', $date);
                    }
                    $globalTemplateParam->set('event_date', $date);
                    
                    if(!$meets){
                        $not_found = true;
                        $globalTemplateParam->set('not_found', $not_found);
                    }
                    else
                        $globalTemplateParam->set('meets', $meets);
                        
                    $query_str = "";
                   // printAr($_REQUEST);
                    if ($_GET['filter'])foreach ($_GET['filter'] as $key=>$item){
                    	$query_str .= "&filter[{$key}]={$item}";
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
                    $modul->template = "meets/category.tpl";
                break;
            default: 
                if($request -> getEscape('url')){
		            $url_arr = explode('/', $request -> getEscape('url'));
		            
		            list($main_cat, $cat, $item) = $url_arr;

		            if(is_string($item)){
		                //$item = $meets_obj->getItemByRedir($request->modul);
		                $meets_obj->setRedir($request->modul);
						$item = $meets_obj->getInfo();
						
						$fmakeTypeTable = new fmakeTypeTable();
						$meets_obj_dop = new fmakeSiteModule();
						$meets_obj_dop->table = $fmakeTypeTable->getTable($modul->id);
						$meets_obj_dop->setId($item[$meets_obj->idField]);
						$item['dop_params'] = $meets_obj_dop->getInfo();
		            	*/
		            	/*
						$places_obj = new fmakeSiteModule();
						$places_obj->setid($item['dop_params']['id_place']);
						$info_place = $places_obj->getInfo();
						$item['dop_params']['info_place'] = $info_place;
						$include_param_id_comment = $item[$meets_obj->idField];
						include 'helpModules/comments.php';
						
						$tags = $fmakeTag->getTags($item[$meets_obj->idField]);
						$item['tags'] = $tags;

						$modul->title = $item['title'];
						$modul->description = $item['description'];
						$modul->keywords = $item['keywords'];
						
		            	$breadcrubs = $modul->getBreadCrumbs($item[$meets_obj->idField]);
						
		                $globalTemplateParam->set('item', $item);
		                $globalTemplateParam->set('breadcrubs', $breadcrubs);
		                $modul->template = "meets/item.tpl"; //exit;
		            }elseif(is_string($cat)){
		                //echo $request->modul;
		                //$item = $meets_obj->getItemByRedir($request->modul, true);
						$meets_obj->order_as = "ASC";		
		                $meets_obj->order = "b.date_from ASC, b.date";
		                $meets_obj->setRedir($request->modul);
						$item = $meets_obj->getInfo();
		            	
		                $modul->title = $item['title'];
						$modul->description = $item['description'];
						$modul->keywords = $item['keywords'];
		                
						$today_time = strtotime("today");
		                $meets = $meets_obj->getByPage($item[$meets_obj->idField], $limit, $page," (b.date >= '{$today_time}' OR b.date_from >= '{$today_time}') ",$modul->id,true);
		                $count = $meets_obj->getByPageCount($item[$meets_obj->idField]," (b.date >= '{$today_time}' OR b.date_from >= '{$today_time}') ",$modul->id,true);
						$pages = ceil($count/$limit);
		                
		                
		                
		
		                if ($page < 1) {
		                        $page = 1;
		                }
		                elseif ($page > $pages) {
		                        $page = $pages;
		                }
						
						if($meets)foreach($meets as $key=>$item_new){
							$tags = $fmakeTag->getTags($item_new[$meets_obj->idField]);
							$meets[$key]['tags'] = $tags;
						}
						
		                $breadcrubs = $modul->getBreadCrumbs($item[$meets_obj->idField]);
		                
						$globalTemplateParam->set('meets', $meets);
		                $globalTemplateParam->set('item', $item);
		                $globalTemplateParam->set('breadcrubs', $breadcrubs);
		                $globalTemplateParam->set('pages', $pages);
                    	$globalTemplateParam->set('page', $page);
		                $modul->template = "meets/category.tpl"; //exit;
		            }
		        }else{      
		        			        
					$meets_obj->order_as = "ASC";				
			        $meets_obj->order = "b.date_from ASC, b.date";
			        
			        $meets_obj->setRedir($request->modul);
					$item = $meets_obj->getInfo();
			        
			        $today_time = strtotime("today");
	                $meets = $meets_obj->getByPageAdmin($modul->id, $limit, $page,"a.`file` = 'item_meets' AND ( b.date >= '{$today_time}' OR b.date_from >= '{$today_time}')",true);
	                                
	                $count = $meets_obj->getByPageCountAdmin($modul->id,$modul->id,"a.`file` = 'item_meets' AND ( b.date >= '{$today_time}' OR b.date_from >= '{$today_time}')",true);
	                $pages = ceil($count/$limit);
			
		        	if ($page < 1) {
						$page = 1;
					}
					elseif ($page > $pages) {
						$page = $pages;
					}
					
					if($meets)foreach($meets as $key=>$item_new){
						$tags = $fmakeTag->getTags($item_new[$meets_obj->idField]);
						$meets[$key]['tags'] = $tags;
					}
					
					$breadcrubs = $modul->getBreadCrumbs($modul->id);
					
			        $globalTemplateParam->set('meets', $meets);
					$globalTemplateParam->set('breadcrubs', $breadcrubs);
					$globalTemplateParam->set('pages', $pages);
                    $globalTemplateParam->set('page', $page);
					$globalTemplateParam->set('item', $item);
                    
					$modul->template = "meets/category.tpl";
		        }
			break;
        }

        */
		/*Дни*/
		$today_time = strtotime("today");
		$day_limit = 30; //на какре количество дней расчитываем
		$mouth_time = $day_limit*24*60*60; // дни*часы*минуты*секунды
		$dead_line = $today_time + $mouth_time; // нынешный день + $day_limit дней
		/*Конец Дни*/

		if($request -> getEscape('url')){
		            $url_arr = explode('/', $request -> getEscape('url'));
		            list($main_cat, $cat, $item) = $url_arr;
		            if(is_string($item)){
		                $meets_obj->setRedir($request->modul);
						$item = $meets_obj->getInfo();
						$fmakeTypeTable = new fmakeTypeTable();
						$meets_obj_dop = new fmakeSiteModule();
						$meets_obj_dop->table = $fmakeTypeTable->getTable($modul->id);
						$meets_obj_dop->setId($item[$meets_obj->idField]);
						$item['dop_params'] = $meets_obj_dop->getInfo();

						$places_obj = new fmakeSiteModule();
						$places_obj->setid($item['dop_params']['id_place']);
						$info_place = $places_obj->getInfo();
						$item['dop_params']['info_place'] = $info_place;

						$include_param_id_comment = $item[$meets_obj->idField];
						include 'helpModules/comments.php';
						$tags = $fmakeTag->getTags($item[$meets_obj->idField]);
						$item['tags'] = $tags;
						$modul->title = $item['title'];
						$modul->description = $item['description'];
						$modul->keywords = $item['keywords'];
		            	$breadcrubs = $modul->getBreadCrumbs($item[$meets_obj->idField]);
		                $globalTemplateParam->set('item', $item);
		                $globalTemplateParam->set('breadcrubs', $breadcrubs);
		                $modul->template = "meets/item.tpl"; 

		            }elseif(is_string($cat)){
						$meets_obj->order_as = "ASC";		
		                $meets_obj->order = "b.date_from ASC, b.date";
		                $meets_obj->setRedir($request->modul);
						$item = $meets_obj->getInfo();
		            	
		                $modul->title = $item['title'];
						$modul->description = $item['description'];
						$modul->keywords = $item['keywords'];

						$meets = $meets_obj->getByPage($item[$meets_obj->idField], 1000, 1, "a.`file` = 'item_meets' and (b.date >= '{$today_time}' or b.date_from >= '{$today_time}') and (b.date <= {$dead_line})", $modul->id, true);
						if($meets)foreach($meets as $key=>$item_new){
							$tags = $fmakeTag->getTags($item_new[$meets_obj->idField]);
							$meets[$key]['tags'] = $tags;
						}
						/*создаем массив состоящий из $day_limit количества подмассивов, в каждом помассиве у нас список элементов с параметрами, которые есть в этот день*/
						$today_time = strtotime("today");
						$day_owner = $today_time+24*60*60;
						if($meets){
							for ($i = 1; $i < $day_limit; $i++) { 
								foreach ($meets as $key => $value) {
									if ($today_time <= $meets[$key]['date_from'] and $meets[$key]['date'] < $day_owner){				
										$total[$today_time][$meets[$key]['name_category']][] = $value;		
									}	
								}
								$today_time+= 24*60*60;
								$day_owner+= 24*60*60;
							}
						}
						/*конец*/
						$one = 1;
		                $breadcrubs = $modul->getBreadCrumbs($item[$meets_obj->idField]);
						$globalTemplateParam->set('meets', $total);
		                $globalTemplateParam->set('item', $item);
		                $globalTemplateParam->set('showed_caption', $one);
		                $globalTemplateParam->set('breadcrubs', $breadcrubs);
		                $modul->template = "meets/category.tpl"; //exit;
		            }
		        }else{      
		        			        
					$meets_obj->order_as = "ASC";				
			        $meets_obj->order = "b.date_from ASC, b.date";		      
			        $meets_obj->setRedir($request->modul);
					$item = $meets_obj->getInfo();

					$meets = $meets_obj->getByPageAdmin($modul->id, false, false,"a.`file` = 'item_meets' and (b.date >= '{$today_time}' or b.date_from >= '{$today_time}') and (b.date <= {$dead_line})" ,true);
					if($meets){
						foreach($meets as $key=>$item_new){
							$tags = $fmakeTag->getTags($item_new[$meets_obj->idField]);
							$meets[$key]['tags'] = $tags;
						}
					}
					/*создаем массив состоящий из $day_limit количества подмассивов, в каждом помассиве у нас список элементов с параметрами, которые есть в этот день*/
					$today_time = strtotime("today");
					$day_owner = $today_time+24*60*60;
					if($meets){
						for ($i = 1; $i < $day_limit; $i++) { 
							foreach ($meets as $key => $value) {
								if ($today_time <= $meets[$key]['date_from'] and $meets[$key]['date'] < $day_owner){				
									$total[$today_time][$meets[$key]['name_category']][] = $value;
								}	
							}
							$today_time+= 24*60*60;
							$day_owner+= 24*60*60;
						}
					}
					
					$total1 = $total;
					$today_time = strtotime("today");
					for ($i = 1; $i < $day_limit; $i++ ){
						foreach ($total1[$today_time] as $key => $value) {
							if (count($value) > 2) {
								for ($how_elements_you_need = 1; $how_elements_you_need < 3; $how_elements_you_need++){
									$elemet_array = array_rand($value);
									if ($spectr){
										while (in_array($elemet_array, $spectr)){
											$elemet_array = array_rand($value);
										}
									}
									else{
										$spectr[] = $elemet_array;
									}
									$total1[$today_time][$key][] = $elemet_array;
								}
							}
							unset($spectr);
							//printar(count($value));
							//printar($key);
						}
						$today_time+= 24*60*60;
					}
					
					if ($_GET['t'] == 1){
						printAr($total1);
					}
					/*конец*/

					$breadcrubs = $modul->getBreadCrumbs($modul->id);
			        $globalTemplateParam->set('meets', $total);
					$globalTemplateParam->set('breadcrubs', $breadcrubs);
					$globalTemplateParam->set('item', $item);    
					$modul->template = "meets/main_category.tpl";
		        }
		        //printAr($total);

?>
