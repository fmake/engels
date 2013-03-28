<?php
header('Content-type: text/html; charset=utf-8'); 

setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');

ini_set('display_errors',1);
error_reporting(7);
session_start();
	
	require('./fmake/FController.php');
	$key = "1o0r2i9f3l8a4m7e56";
	echo "1";
	if($key != $_GET['key']){
		$fmakeSiteUser = new fmakeMail(); 
		$fmakeRassilka = new fmakeRassilka();
		$news_obj = new fmakeSiteModule();
		$date = strtotime("today");
		$date = strtotime("-1 days", $date);
		$news_obj->order = "b.date DESC, a.id";
		$items = $news_obj->getByPageAdmin(2, false, false,
			"a.`file` = 'item_news' and b.`date` > {$date}",true);
		foreach ($items as $key => $value) {
			$items[] = date("d.m.Y", $items[$key]['date']));
		}
		if($items){
			$fmakeRassilka->addParam('date',$date_new);
			$fmakeRassilka->addParam('date_create',time());
			$fmakeRassilka->addParam('count_item',sizeof($items));
			$fmakeRassilka->newItem();
			
			$fmakeMessages = new fmakeMessages();
			$fmakeMessages->setId(4);
			$_messages = $fmakeMessages->getInfo();
			
			$globalTemplateParam->set('items', $items);
			$globalTemplateParam->set('hostname',$hostname);
						
			$users_all = $fmakeSiteUser->getAllRassilka(true);
			//echo($_messages['template']);
			
			}
		//}
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
		$date = strtotime("today");
		$date = strtotime("-1 days", $date);
		$news_obj->order = "b.date DESC, a.id";
		$items_news_lent = $news_obj->getByPageAdmin(2, false, false,
			"a.`file` = 'item_news' and b.`date` > {$date}",true);
		foreach ($items_news_lent as $key => $value) {
			PrintAr(date("d.m.Y", $items_news_lent[$key]['date']));
		}
	}
	
	*/