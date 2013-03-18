<?php
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(7);

define('ROOT', realpath(dirname(__FILE__)));
require('./fmake/FController.php');

//printAr($_REQUEST);
switch($_GET['action']){
	case 'link':
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: https://www.facebook.com/dialog/oauth?client_id=404043026331078&redirect_uri=http://engels.bz/fb.php&scope=offline_access,publish_stream,manage_pages');
		break;
	case 'post_news':
		if($_GET['key']=='1029384756' && $_GET['id_news']){
			
			$id_group = '412064752192199';
			$id_content = $_GET['id_news'];
		
			$fmakeSiteModule = new fmakeSiteModule();
			$url = $fmakeSiteModule->getLinkPage($id_content);
				
			$fmakeSiteModule->setId($id_content);
			$item = $fmakeSiteModule->getInfo();
			
			$id_page_modul = 2;

			$fmakeTypeTable = new fmakeTypeTable();
			$absitem_dop = new fmakeTypeTable();
			$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);
			$absitem_dop->setId($id_content);
			$items_dop = $absitem_dop->getInfo();
			
			$fb = new FBapi();
			$array_replace1 = array('&amp;','&quot;','&lt;','&gt;','&nbsp;','&laquo;','&raquo;');
			$array_replace2 = array('&','"','<','>',' ','"','"');
			$anotaciya = strip_tags($items_dop['anons']);
			$anotaciya = str_replace($array_replace1, $array_replace2, $anotaciya);
			//$anotaciya = "Тестовое сообщение";
			$post = array("message"=>$anotaciya,"link"=>"http://{$_SERVER['HTTP_HOST']}{$url}");

			$status = $fb->SendWallGroup($post,$id_group);
			//echo 'qq';
			//printAr($status);
		}
		break;
	default:
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: /');
		break;
}

if($request->code){
	$fb = new FBapi();
	$fb->getAccessToken($request->code);
	
	header("HTTP/1.1 301 Moved Permanently");
	header('Location: /admin/?modul=_adm_configs_socseti');
}
//https://www.facebook.com/dialog/oauth?client_id=375926435809726&redirect_uri=http://vsena5.net/fb.php&response_type=code
//https://www.facebook.com/dialog/oauth?client_id=404043026331078&redirect_uri=http://engels.bz/fb.php&scope=offline_access,publish_stream 