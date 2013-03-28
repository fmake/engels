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
		//$fmakeNews = new fmakeNews();
		//$num_w = date('w',time());
		//$time = strtotime("-1 days",time());
		//echo(date('H:i d.m.Y',$fmakeRassilka->isLastDate()));
		//if($num_w==1 && $fmakeRassilka->isLastDate()<$time){
		//$date_new = mktime(0,0,0,date('m',$time),date('d',$time),date('Y',$time));
		//$date_new = date('H:i d.m.Y',$time);
		$date = strtotime(date("d.m.Y", time()));
		$date = strtotime("-1 days",time());
		$news_obj->order = "b.date DESC, a.id";
		$items_news_lent = $news_obj->getByPageAdmin(2, false, false,
			"a.`file` = 'item_news' and `date` > '$date'",true);
		//PrintAr($items_news_lent);
		foreach ($items_news_lent as $key => $value) {
			PrintAr($items_news_lent[$key]['anons']);
		}
		//}
	}
	