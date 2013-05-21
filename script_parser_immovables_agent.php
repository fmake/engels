<?php 

header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(7);
date_default_timezone_set('Europe/Moscow');

require('./fmake/FController.php');

//if ($_GET['key'] == '1029384756') {

	$modul_id = 1291;
	$site = "http://www.s-mls.ru";
	$page = $_GET['page'];
	$limit = ($_GET['limit'])? $_GET['limit'] : 100;
	$update = $_GET['update'];
	
	$fmakeSiteModulRelation = new fmakeSiteModule_relation();
	$fmakeImmovables = new fmakeImmovables();

	$fmakeImmovables_dop = new fmakeTypeTable();
	$fmakeImmovables_dop->table = $fmakeImmovables_dop->getTable($modul_id);
	/*
	$items = $fmakeImmovables->getByPageAdmin($modul_id, false,false,"a.`file` = 'item_immovables'");

	if($items) foreach ($items as $key=>$item) {
		$fmakeImmovables_dop->setId($item['id']);
		$fmakeImmovables_dop->addParam("date_parser_update",0);
		$fmakeImmovables_dop->update();
	}
	*/

	$time_update = strtotime("-3 hours",time());

	if ($update == 'new') {
		$items = $fmakeImmovables->getByPageAdmin($modul_id, $limit,$page,"a.`file` = 'item_immovables' and b.`link_site` != '' and b.`date_parser_update` = 0 ");
	} else {
		$items = $fmakeImmovables->getByPageAdmin($modul_id, $limit,$page,"a.`file` = 'item_immovables' and b.`link_site` != '' and b.`date_parser_update` < {$time_update} ");
	}
/*
	if($items) foreach ($items as $key=>$item) {
		$data = $fmakeImmovables->parserVnutr($item['link_site']);
		//printAr($data);
		$fmakeImmovables->setParamLink($item['link_site']);
		$info_item = $fmakeImmovables->getInfo();
		//printAr($info_item);
		if ($info_item) {
			//echo "{$info_item['id']}";
			$fmakeImmovables->addParam("redir", $fmakeImmovables->transliter($info_item['caption']).$fmakeImmovables->id);
			$fmakeImmovables->addParam("active", 1);
			$fmakeImmovables->update();
			$parent = $info_item['parent'];
			$fmakeSiteModulRelation->setPageRelation($parent, $fmakeImmovables->id);
			
			//if ($info_item) {
				$fmakeImmovables_dop->setId($info_item[$fmakeImmovables->idField]);
			//}
			$info = "Агент : {$data['agent']}<br/>Агентство : {$data['agentstvo']}";
			$fmakeImmovables_dop->addParam("info",mysql_real_escape_string($info));
			$fmakeImmovables_dop->addParam("date_parser_update",time());
			
			$fmakeImmovables_dop->update();
		}
	}
*/
	printAr($items);

	echo "Ok";
//}