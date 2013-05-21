<?php 
/*
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(7);
date_default_timezone_set('Europe/Moscow');
*/
require('./fmake/FController.php');

if ($_GET['key'] == '1029384756') {

	$fmakeImmovables = new fmakeImmovables();

	//$data = $fmakeImmovables->parserObject(1);
	$page = 1;
	//while (1) {
		//$page++;
		$data = $fmakeImmovables->parserObject($page);
		
		//if($data) foreach ($data as $key=>$item) {
		//	$data[$key]['dop'] = $fmakeImmovables->parserVnutr("http://www.s-mls.ru".$item['link']);	
		//	if($key > 200) break;
		//}
		
		//if ($data) printAr($data);
	//}
	//printAr($data);
	$modul_id = 1291;
	/*
	1304 - Покупка
	1306 - Продажа
	1307 - Сдать
	1308 - Снять
	*/
	$parent = 1306;
	/*
	Комнаты
	Гаражи и машиноместа
	Дома, дачи, коттеджи
	Коммерческая недвижимость
	Земельные участки
	Квартиры
	*/
	$type = "Квартиры";
	$caption = "Продажа квартиры";
	$site = "http://www.s-mls.ru";

	$fmakeImmovables->updateActiveParseItem();

	/*if ($data) foreach ($data as $key=>$item) {
		$fmakeSiteModulRelation = new fmakeSiteModule_relation();
		$fmakeImmovables = new fmakeImmovables();
		
		$fmakeImmovables_dop = new fmakeTypeTable();
		$fmakeImmovables_dop->table = $fmakeImmovables_dop->getTable($modul_id);
		
		$fmakeImmovables->setParamLink($site.$item['link']);
		$info_item = $fmakeImmovables->getInfo();
		
		$fmakeImmovables->addParam("parent",$parent);
		$fmakeImmovables->addParam("caption",$caption);
		$fmakeImmovables->addParam("title",$caption);
		if (!$info_item) $fmakeImmovables->addParam("redir",$fmakeImmovables->transliter($caption));
		//$fmakeImmovables->addParam("text",$request->text);
		$fmakeImmovables->addParam("file","item_immovables");
		$fmakeImmovables->addParam("active",1);
		
		if ($info_item) $fmakeImmovables->update();
		else $fmakeImmovables->newItem();
		
		if (!$info_item) {
			$item_info = $fmakeImmovables->getInfo();
			$fmakeImmovables->addParam("redir", $item_info['redir'].$fmakeImmovables->id);
			$fmakeImmovables->update();
		
			$fmakeSiteModulRelation->setPageRelation($parent, $fmakeImmovables->id);
		}
		
		if ($info_item) {
			$fmakeImmovables_dop->setId($info_item[$fmakeImmovables->idField]);
		}
		$fmakeImmovables_dop->addParam("id", $fmakeImmovables->id);
		if (!$info_item) $fmakeImmovables_dop->addParam("date", time());
		
		$fmakeImmovables_dop->addParam("date_end_publick", strtotime("+1 months",time()));

		$fmakeImmovables_dop->addParam("type",$type);
		$fmakeImmovables_dop->addParam("count_room",$item["count_room"]);
		$fmakeImmovables_dop->addParam("floor",$item["floor"]);
		$fmakeImmovables_dop->addParam("general_area",$item["general_area"]);
		$fmakeImmovables_dop->addParam("price",$item["price"]."000");
		$fmakeImmovables_dop->addParam("addres",iconv("windows-1251" ,"utf-8", $item["addres"]));
		$fmakeImmovables_dop->addParam("link_site",$site.$item['link']);
		
		if ($info_item) $fmakeImmovables_dop->update();
		else $fmakeImmovables_dop->newItem();
	}*/
	echo "Ok";
	printAr($data);
}
