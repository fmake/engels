<?php
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(7);
date_default_timezone_set('Europe/Moscow');
//error_reporting(E_ALL);
//echo "Сайт временно не работает. Техническое обслуживание.";
//exit();

/*---------------время генерации страницы--------------------*/
// считываем текущее время
$start_time = microtime();
// разделяем секунды и миллисекунды (становятся значениями начальных ключей массива-списка)
$start_array = explode(" ",$start_time);
// это и есть стартовое время
$start_time = $start_array[1] + $start_array[0]; 
/*---------------время генерации страницы--------------------*/

require('./fmake/FController.php');
require('./fmake/libs/function_xajax.php');
require('./fmake/libs/login.php');

$modulObj = new fmakeAdminController();
$admin = $modulObj->getUserObj();
$admin->load();

if ($configs->site_on_off == '1' ){
	
	switch ($request->action){
		case 'feedback':
			$fmakeFeedback = new fmakeFeedback();
			$error = false;
			if(!trim($request ->email) || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request ->email)) $error['email'] = "Некорректный Email";
			if($fmakeFeedback->isEmail(trim($request ->email))) $error['duble'] = "Данный email уже записан";
			if(!$error){
				$fmakeFeedback->addParam("email",$request->email);
				$fmakeFeedback->newItem();
				$message = "Ты узнаешь первым!";
				$globalTemplateParam->set('message',$message);
			}else {
				$globalTemplateParam->set('errors',$error);
			}
			
			break;
	}
	if(!$admin->isLogined()){
		$modul->template = "zagluwka/main.tpl";

		$template = $twig->loadTemplate($modul->template);
		$template->display($globalTemplateParam->get());
		exit();
	}
}

//echo "1111";

/*---------курс валют----------*/
$cache = new cacheValue();
if (!$cache->isCache("usd_valuta")) {
	$date = date("d/m/Y",time());
	$xmlParser = new xmlParser();
	$array = $xmlParser->fileXmlToArray("http://www.cbr.ru/scripts/XML_daily.asp?date_req={$date}");
	
	if ($array['Valute'])foreach($array['Valute'] as $key=>$item) {
		if ($item['CharCode'] == 'USD') {
			$ar = explode(",",$item['Value']);
			$usd_valuta = $cache->addCache("usd_valuta",$ar[0].".".substr($ar[1],0,2));
		}
		if ($item['CharCode'] == 'EUR') {
			$ar = explode(",",$item['Value']);
			$eur_valuta = $cache->addCache("eur_valuta",$ar[0].".".substr($ar[1],0,2));
		}
	}
} else {
	$usd_valuta = $cache->getCacheValue("usd_valuta");
	$eur_valuta = $cache->getCacheValue("eur_valuta");
}
if (!$cache->isCache("weather")) {
	$xmlParser = new xmlParser();
	$array_weather = $xmlParser->fileXmlToArray("http://informer.gismeteo.ru/xml/34175_1.xml");
	$array_weather = $array_weather['REPORT']['TOWN']['FORECAST'][0]['TEMPERATURE']['@attributes'];
	
	$max_weather = intval($array_weather['max']);
	$min_weather = intval($array_weather['min']);
	$temperature = round(($max_weather+$min_weather)/2);
	if($temperature>0) $temperature = "+".$temperature;
	$weather = $cache->addCache("weather",$temperature);
	
} else {
	$weather = $cache->getCacheValue("weather");
}

$globalTemplateParam->set('usd_valuta',$usd_valuta);
$globalTemplateParam->set('eur_valuta',$eur_valuta);
$globalTemplateParam->set('weather',$weather);
/*---------курс валют----------*/



$fmakeBanerContent = new fmakeBanerContent();
$globalTemplateParam->set('baner_obj',$fmakeBanerContent);
$array_baner = $fmakeBanerContent->getBanersShow(true);

if ($array_baner) foreach ($array_baner as $key=>$item) {
	$globalTemplateParam->set('baner'.$item['id_type'],$item);
}

	

$modul = new fmakeSiteModule();
$globalTemplateParam->set('site_obj',$modul);
$url = $request -> getEscape('url') ? $request -> getEscape('url') : $request -> getEscape('modul');
$url = explode('/', $url);
$url = $url[0];

//printAr($_REQUEST);
//echo $request -> getEscape('modul');
$modul->getPage($request -> getEscape('modul') , $twig, $url);
//добавляем каталог к основным модулям
$menu = $modul->getAllForMenuSite(0, true,$q=true,$flag=true,true);

$request_uri = $_SERVER['REQUEST_URI'];

/*--------правый блок с последними новостями--------*/
$fmakeComments = new fmakeComments();

/*новости по теме*/
if ($modul->id == 2) {
	$news_theme = new fmakeNews();
	$news_theme->setRedir($request->modul);
	$item_news_theme_cat = $news_theme->getInfo();
	if ($item_news_theme_cat['id'] == $modul->id) {
		$cat_theme = "";
	} elseif ($item_news_theme_cat['file'] == 'item_news') {
		$parent = $item_news_theme_cat['parent'];
		$cat_theme = "a.parent in ({$parent}) AND "; 
	} else {
		//$parents = $news_theme->getCats($item_news_theme_cat['id']);
		$cat_theme = ""; 
	}
} else {
	$cat_theme = "";
}
/*новости по теме*/
$limit_news_right = 7;
$tmp_order = $modul->order;
$modul->order = "b.date DESC, a.id";
$news_right_block = $modul->getByPageAdmin(2, $limit_news_right,1," {$cat_theme} a.`file` = 'item_news'",true);
if ($news_right_block) foreach ($news_right_block as $key=>$item) {
	$news_right_block[$key]['comment'] = $fmakeComments->getByPageCount($item[$modul->idField],true);
}
$modul->order = $tmp_order;
$globalTemplateParam->set('news_right_block',$news_right_block);

if($_GET['debug']==1){
	//$static = new fmakeCount();
	//$short_news = $static->getShortNameNews(7);
	//printAr($short_news);
	//printAr($modul->id);
	//echo($request->modul);
}

/*--------правый блок с последними новостями--------*/

/*--------меню с самыми посещяемыми новостями--------*/
$static = new fmakeCount();
$short_news = $static->getShortNameNews(4);
$globalTemplateParam->set('short_news',$short_news);
/*--------меню с самыми посещяемыми новостями--------*/

//$time_new = date('d',time())." ".$modul->getMounth(date("m",time()))." ".date('Y',time())." ".date('H:i',time());
$time_new = '<span>Сегодня <b>'.date('d',time()).' '.$modul->getMounth(date("m",time())).'</b></span><img src="/images/icons/time_header.png" alt="Время"/><span class="time">'.date('H:i',time()).'</span>';
$globalTemplateParam->set('time_new',$time_new);
$globalTemplateParam->set('request_uri',$request_uri);
$globalTemplateParam->set('menu',$menu);
$globalTemplateParam->set('url',$url);
PrintAr($configs);
$modul->template = "base/main.tpl";
$globalTemplateParam->set('modul',$modul);
if($modul->file){
	include($modul->file.".php");
} 
//PrintAr($request_uri);
//echo 'qq';
/*---------------время генерации страницы--------------------*/
// делаем то же, что и в start.php, только используем другие переменные
$end_time = microtime();
$end_array = explode(" ",$end_time);
$end_time = $end_array[1] + $end_array[0];
// вычитаем из конечного времени начальное
$time = $end_time - $start_time;
$time = round($time,2);
// выводим в выходной поток (броузер) время генерации страницы
$generate_page_time = "Страница сгенерирована за {$time} секунд"; 
$globalTemplateParam->set('generate_page',$generate_page_time);
/*---------------время генерации страницы--------------------*/

/*-- вывод id страницы --*/
$modul->setRedir($request->modul);
$page_id = $modul->getInfo();
$page_id = "{$page_id['id']}";
$globalTemplateParam->set('id_page',$page_id);
/*-- конец вывода id страницы--*/

$template = $twig->loadTemplate($modul->template);
$template->display($globalTemplateParam->get());
