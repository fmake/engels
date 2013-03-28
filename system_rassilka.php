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
		$time = strtotime("-1 days",time());
		//echo(date('H:i d.m.Y',$fmakeRassilka->isLastDate()));
		//if($num_w==1 && $fmakeRassilka->isLastDate()<$time){
		$date_new = mktime(0,0,0,date('m',$time),date('d',$time),date('Y',$time));
		//$date_new = date('H:i d.m.Y',$time);
		$news_obj->order = "b.date DESC, a.id";
		$limit_news_lent = 13;
		$items_news_lent = $news_obj->getByPageAdmin(2, $limit_news_lent,1,"a.`file` = 'item_news' and `date` > '{$date_new}'",true);
		PrintAr($items_news_lent['anons']);
		//}
	}
	