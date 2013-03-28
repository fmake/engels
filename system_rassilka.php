<?php
header('Content-type: text/html; charset=utf-8'); 

setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');

//ini_set('display_errors',1);
//error_reporting(7);
session_start();

	require('./fmake/FController.php');
	$key = "1o0r2i9f3l8a4m7e56";
	if($key!=$_GET['key']){
		$fmakeSiteUser = new fmakeMail(); 
		$fmakeRassilka = new fmakeRassilka();
		$news_obj = new fmakeSiteModule();
		$date = strtotime("today");
		$date = strtotime("-1 days", $date);
		$news_obj->order = "b.date DESC, a.id";
		$items_news_lent = $news_obj->getByPageAdmin(2, false, false,
			"a.`file` = 'item_news' and b.`date` > {$date}",true);
		foreach ($items_news_lent as $key => $value) {
			PrintAr(date("d.m.Y", $items_news_lent[$key]['date']));
		}
	}
	
	/*
<?php
header('Content-type: text/html; charset=utf-8'); 

setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');

//ini_set('display_errors',1);
//error_reporting(7);
session_start();

	require('./fmake/FController.php');
	$key = "1o0r2i9f3l8a4m7e56";
	if($key!=$_GET['key']){
		$fmakeSiteUser = new fmakeMail(); 
		$fmakeRassilka = new fmakeRassilka();
		$news_obj = new fmakeSiteModule();
		$date = strtotime(date("d.m.Y", time()));
		$date = strtotime("-1 days",date());
		$news_obj->order = "b.date DESC, a.id";
		$items_news_lent = $news_obj->getByPageAdmin(2, false, false,
			"a.`file` = 'item_news' and b.`date` > '$date'",true);
		foreach ($items_news_lent as $key => $value) {
			PrintAr($items_news_lent[$key]['anons']);
		}
	}
	
	*/