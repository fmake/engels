<?php
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(7);
date_default_timezone_set('Europe/Moscow');

require('./fmake/FController.php');

$news_obj = new fmakeSiteModule();

$date = strtotime("-7 day",time());
$date = strtotime("today",$date);
//$limit_newsrss = 9;
$rssnews = $news_obj->getByPageAdmin(2, false,false,"a.`file` = 'item_news' and b.`rss_yandex_news` = '1' and b.`date`>= '{$date}'",true);

if ($rssnews) foreach($rssnews as $key=>$item) {
	$rssnews[$key]['text'] = strip_tags($item['text']);
	//$to = array("&","<",">","'",'"');
	//$from = array("&amp;","&lt;","&gt;","&apos;","&quot;");
	$to = array("<",">","'",'"');
	$from = array("&lt;","&gt;","&apos;","&quot;");
	//$rssnews[$key]['text'] = str_replace($to,$from,$rssnews[$key]['text']);
	$rssnews[$key]['text'] = html_entity_decode($rssnews[$key]['text'],ENT_QUOTES,'UTF-8');
	//$rssnews[$key]['text'] = htmlspecialchars($rssnews[$key]['text'], ENT_QUOTES,'UTF-8');
	$rssnews[$key]['full_url'] = htmlspecialchars($item['full_url'], ENT_QUOTES,'UTF-8');
	$rssnews[$key]['caption'] = htmlspecialchars($item['caption'], ENT_QUOTES,'UTF-8');
	$rssnews[$key]['autor'] = htmlspecialchars($item['autor'], ENT_QUOTES,'UTF-8');
	$rssnews[$key]['name_category'] = htmlspecialchars($item['name_category'], ENT_QUOTES,'UTF-8');
	$rssnews[$key]['description'] = htmlspecialchars($item['anons'], ENT_QUOTES,'UTF-8');
	//$rssnews[$key]['full_url'] = str_replace($to,$from,$item['full_url']);
	//$rssnews[$key]['caption'] = str_replace($to,$from,$item['caption']);
	//$rssnews[$key]['autor'] = str_replace($to,$from,$item['autor']);
	//$rssnews[$key]['name_categor'] = str_replace($to,$from,$item['name_categor']);
	//$rssnews[$key]['description'] = str_replace($to,$from,$item['description']);
	
	$rssnews[$key]['picture_length'] = filesize(ROOT."/".$news_obj->fileDirectory."/".$item['id']."/406__".$item['picture']);
}

$globalTemplateParam->set('rssnews', $rssnews);
$globalTemplateParam->set('news_obj', $news_obj);

$template = "rambler/news_rss.tpl";

$template = $twig->loadTemplate($template);
$template->display($globalTemplateParam->get());