<?php
	//http://informer.gismeteo.ru/xml/34175_1.xml
	$fmakeComments = new fmakeComments();
	/*новости*/
	$news_obj = new fmakeSiteModule();
	$limit_news = 3;
	$news_obj->order = "b.date DESC, a.id";
	$items_news_main = $news_obj->getByPageAdmin(2, $limit_news,1,"a.`file` = 'item_news' and `main` = '1'",true);
	if ($items_news_main) foreach ($items_news_main as $key=>$item) {
		$items_news_main[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
	}
	//printar($items_news_main);
	$fmakeNews = new fmakeNews();
	$limit_news_lent = 13;
	$items_news_lent = $news_obj->getByPageAdmin(2, $limit_news_lent,1,"a.`file` = 'item_news'",true);
	if ($items_news_lent) foreach ($items_news_lent as $key=>$item) {
		$items_news_lent[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
		$fmakeNews->setId($items_news_lent[$key]['id']);
		$items_news_lent[$key]['mnenie'] = sizeof($fmakeNews->is_mnenie());
	}
	
	$limit_news2 = 5;
	$items_news = $news_obj->getByPageAdmin(2, $limit_news2,1,"a.`file` = 'item_news' and `main` != '1'",true);
	if ($items_news) foreach ($items_news as $key=>$item) {
		$items_news[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
	}
	//printAr($items_news);
	//$news_obj = new fmakeSiteModule();
	$limit_project = 4; 
	$news_obj->order = "b.date DESC, a.id";
	$items_project = $news_obj->getByPageAdmin(2361, $limit_project,1,"a.`file` = 'item_project'",true);
	if ($items_project) foreach ($items_project as $key=>$item) {
		$items_project[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
	}
	$globalTemplateParam->set('items_project', $items_project);
	
	$parent_news_obzor = $configs->id_news_obzor;
	if($parent_news_obzor){
		$limit_news_obzor = 5;
		$items_news_obzor = $news_obj->getByPage($parent_news_obzor, $limit_news_obzor,1,"a.`file` = 'item_news'",2,true);
		if ($items_news_obzor) foreach ($items_news_obzor as $key=>$item) {
			$items_news_obzor[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
		}
		$globalTemplateParam->set('items_news_obzor', $items_news_obzor);
	}

	$parent_news_inwave = 7029;
	if($parent_news_inwave){
		$limit_news_inwave = 8;
		$items_news_inwave = $news_obj->getByPage($parent_news_inwave, $limit_news_inwave, 1 ,"a.`file` = 'item_news'",2,true);
		if ($items_news_inwave) foreach ($items_news_inwave as $key=>$item) {
			$items_news_inwave[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
		}
		$globalTemplateParam->set('items_news_inwave', $items_news_inwave);
	}
	//PrintAr($items_news_inwave);
	
	if ($_COOKIE['date_update_view_main']) {
		$date = $_COOKIE['date_update_view_main']; 
	} else {	
		$date = strtotime("today");
	}
	$count_news_new = $news_obj->getByPageCountAdmin(2,false,"a.`file` = 'item_news' and b.`date` > {$date}",true);
	$count_news_obzor_new = $news_obj->getByPageCount($parent_news_obzor,"a.`file` = 'item_news' and b.`date` > {$date}",2,true);
	$count_project_new = $news_obj->getByPageCountAdmin(2361,false,"a.`file` = 'item_project' and b.`date` > {$date}",true);
	
	SetCookie("date_update_view_main",time(),time()+(3600*24*10),'/','engels.bz');
	
	$globalTemplateParam->set('news_obj', $news_obj);
	$globalTemplateParam->set('items_news_main', $items_news_main);
	$globalTemplateParam->set('items_news', $items_news);
	$globalTemplateParam->set('items_news_lent', $items_news_lent);
	$globalTemplateParam->set('count_news_new', $count_news_new);
	$globalTemplateParam->set('count_news_obzor_new', $count_news_obzor_new);
	$globalTemplateParam->set('count_project_new', $count_project_new);
	/*новости*/
	
	/*последние комментарии*/
	$limit_comment = 3;
	$fmakeComments = new fmakeComments();
	//$fmakeComments->modul = $include_param_modul;
	$main_comments = $fmakeComments->getByPage(false,$limit_comment,1,true,true);
	
	$count_comment_new = $fmakeComments->getByPageCountWhere(false,"`date` > {$date}",true);
	
	if ($main_comments) foreach($main_comments as $key=>$item) {
		$fmakeSiteUser = new fmakeSiteUser();
		$fmakeSiteUser->setId($item['id_user']);
		$user_params = $fmakeSiteUser->getInfo();
		$main_comments[$key]['user_params'] = $user_params;
		$main_comments[$key]['text'] = stripslashes($item['text']);
	}
	
	$globalTemplateParam->set('main_comments', $main_comments);
	$globalTemplateParam->set('count_comment_new', $count_comment_new);
	/*последние комментарии*/
	
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
	
	/*интервью*/
	$limit_interv = 2;
	$interv_obj = new fmakeSiteModule();
	$interv_obj->order = "b.date DESC, a.id";
	$items_interv = $interv_obj->getByPage(12, $limit_interv,1,"`main` = '1' and a.picture!=''",12,true);
	
	$globalTemplateParam->set('interv_obj', $interv_obj);
	$globalTemplateParam->set('items_interv', $items_interv);
	/*интервью*/
	
	/*Эксперты*/
	$limit_ekspert = 2;
	$ekspert_obj = new fmakeSiteModule();
	$ekspert_obj->order = "b.date DESC, a.id";
	$ekspert_obj->group_by = "b.id_user";
	$items_ekspert = $ekspert_obj->getByPageAdmin(3823, $limit_ekspert,1,"a.`file` = 'item_expert'",true);
	
	if($items_ekspert)foreach($items_ekspert as $key=>$item_new){
		$fmakeSiteUser = new fmakeSiteUser($item_new['id_user']);
		$items_ekspert[$key]['expert'] = $fmakeSiteUser->getInfo();
	}
	
	//if($user->id == 105) printAr($items_ekspert); 
	
	$globalTemplateParam->set('ekspert_obj', $ekspert_obj);
	$globalTemplateParam->set('items_ekspert', $items_ekspert);
	/*Эксперты*/
	
	/*афиша*/
	$meets_obj = new fmakeMeets();
	$items_meets_cats = $meets_obj->getChilds(4,true);
	
	$limit_meets = 6;
	$date = strtotime("today"/*,$tmp_date*/);
	$globalTemplateParam->set("to_day", $date);

	$date_array = $meets_obj->dateFilter(date('d.m.Y',$date));
	$date_to = $date_array["to"];
	/*отминмаем одну милисекунду чтобы использовать <= к правой границе даты*/
	$date_from = $date_array["from"]-1;
		
	$filter_date = "( ( ( '{$date_to}'<= b.date AND b.date <= '{$date_from}') OR ( '{$date_to}'<= b.date_from AND b.date_from <= '{$date_from}' ) ) OR 
				              ( b.date <= '{$date_to}' AND '{$date_from}' <= b.date_from ) )";
	//$meets_obj->order = "b.date DESC, a.id";
	$meets_obj->order = "RAND()";
	//$meets_obj->group_by = "parent";
	$items_meets_main = $meets_obj->getByPageAdmin(4, false,false,"a.`file` = 'item_meets' and {$filter_date} ",true);
	$items_meets_main = $meets_obj->uniqParent($items_meets_main,$limit_meets);
	//printAr($items_meets_main);
	for($i=0;$i<40;$i++){
		$time = strtotime("+{$i} day");
		$calendar_meets[$i]['day'] = date('d',$time);
		$calendar_meets[$i]['week'] = $meets_obj->getWeek2(date('w',$time));
		$calendar_meets[$i]['date_full'] = $time;
		//echo date('w',$time);
	}
	//printAr($calendar_meets);
	
	$globalTemplateParam->set('meets_obj', $meets_obj);
	$globalTemplateParam->set('items_meets_main', $items_meets_main);
	$globalTemplateParam->set('items_meets_cats', $items_meets_cats);
	$globalTemplateParam->set('calendar_meets', $calendar_meets); 
	/*афиша*/
	
	/*места*/
	$place_obj = new fmakeSiteModule();
	
	$items_place_cats = $place_obj->getChilds(5,true);
	
	$limit_place = 6; 
	//$place_obj->order = "b.date DESC, a.id";
	$place_obj->order = "RAND()";
	$items_place_main = $place_obj->getByPageAdmin(5, $limit_place,1,"a.`file` = 'item_place' and `main` = '1'",true);

	$globalTemplateParam->set('place_obj', $place_obj);
	$globalTemplateParam->set('items_place_main', $items_place_main);
	$globalTemplateParam->set('items_place_cats', $items_place_cats);
	/*места*/
		
	/*недвижимость*/
	
	$immovables_obj = new fmakeSiteModule();
	
	$time_now = time();
	$limit_immovables = 6; 
	$immovables_obj->order = "RAND()";
	$items_immovable_main = $immovables_obj->getByPageAdmin(1291, $limit_immovables,1,"a.`file` = 'item_immovables' and b.date_end_publick >= {$time_now}",true);

	$globalTemplateParam->set('immovables_obj', $immovables_obj);
	$globalTemplateParam->set('items_immovable_main', $items_immovable_main);
	
	/*недвижимость*/
	
	/*объявления*/
	
	$advert_obj = new fmakeSiteModule();
	
	$limit_advert = 6; 
	//$advert_obj->order = "RAND()";
	$manual_obj->order = "b.date DESC, a.id";
	$items_advert_main = $advert_obj->getByPageAdmin(796, $limit_advert,1,"a.`file` = 'item_advert'",true);

	$globalTemplateParam->set('advert_obj', $advert_obj);
	$globalTemplateParam->set('items_advert_main', $items_advert_main);
	
	/*объявления*/

	#мнения
	$news_obj_exp = new fmakeMneniya;
	$limit_news_exp = 2;
	//$news_obj_exp->order = "b.date DESC, a.id";
	$news_obj_exp->order="id"; 
	$items_news_exp = $news_obj_exp->getByPageAdmin($limit_news_exp, 1 ,"`text_expert` != '' " , true);
	//printAr("23");
	//PrintAr($items_news_exp);
    foreach ($items_news_exp as $key => $value) {
    	$items_news_exp[$key]['caption'] = $news_obj->getByPageAdmin(2, false, false,"a.`file` = 'item_news' and a.`id` = {$items_news_exp[$key][id_news]}",true);
  	}
  	//printAr("23");
  	PrintAr($items_news_exp);
	$globalTemplateParam->set('items_news_exp', $items_news_exp);
	/*
	$user_exp = new fmakeSiteUser();
	$news_obj_exp = new fmakeSiteModule();
	$limit_news_exp = 2;
	$news_obj_exp->order = "b.date DESC, a.id";
	$items_news_exp = $news_obj_exp->getByPageAdmin(2, $limit_news_exp,1,"a.`file` = 'item_news' and b.`id_expert` and b.`text_expert`",true);
	if($items_news_exp)foreach ($items_news_exp as $key => $value) {
		$info_expert = $user_exp->getByUserId($value['id_expert']);
		$items_news_exp[$key]['name_expert']=$info_expert['name'];
		$items_news_exp[$key]['picture_expert']=$info_expert['picture'];
		//echo $value['name_expert']."<br>";
	}
	//printar($info_expert);
	//printar($items_news_exp);
	$globalTemplateParam->set('items_news_exp', $items_news_exp);
	*/
	#мнения

	/*Справочник*/
	
	$manual_obj = new fmakeSiteModule();
	
	$limit_manual = 6; 
	$manual_obj->order = "b.date DESC, a.id";
	$items_manual_main = $manual_obj->getByPageAdmin(1238, $limit_manual,1,"a.`file` = 'item_manual'",true);

	$globalTemplateParam->set('manual_obj', $manual_obj);
	$globalTemplateParam->set('items_manual_main', $items_manual_main);
	
	/*Справочник*/
	
	/*---------опрос-----------*/
	$fmakeInterview = new fmakeInterview();
	$limit = 4; //roman 
	$interview = $fmakeInterview->getInterview($limit); 
	
	/*if($request->action == 'interview_right' && $request->interview_id){
		include 'helpModules/interview.php';
	}
	*/
	$iscookie = array();
	$vopros = array();
	$vopros_statistic_all = array();
	if ($interview) foreach ($interview as $key=>$interview_item) {
		
		$fmakeInterview->table = $fmakeInterview->table_vopros;
		$vopros[$key] = $fmakeInterview->getVoproses($interview_item['id'],true);
		if($vopros[$key])foreach($vopros[$key] as $k=>$v){
			$vopros_statistic_all[$key] += $v['stat'];
		}
		if($request->interview_id != $interview_item['id']) {
			$iscookie[$key] = $fmakeInterview->isCookies($interview_item['id']);
		} else {
			if($iscookie_no_error) $iscookie[$key] = true;
			else $iscookie[$key] = false;
		}
	}
	//printAr($vopros);
	$globalTemplateParam->set('vopros',$vopros);
	$globalTemplateParam->set('vopros_statistic_all',$vopros_statistic_all);
	$globalTemplateParam->set('interview',$interview);
	$globalTemplateParam->set('iscookie',$iscookie);
	/*---------опрос-----------*/
	$modul->template = "base/main.tpl";
	
?>