<?php
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('./fmake/FController.php');

$absitem = new fmakeNews();

$id_page_modul = 2;
$fmakeTypeTable = new fmakeTypeTable();
$absitem_dop = new fmakeTypeTable();
$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);

$mneniya = new fmakeMneniya();
$all_m = $mneniya->getAll();

$older = $absitem ->getByPageAdmin(2, false, false, "a.`file` = 'item_news' and b.`text_expert` != '' and b.`expert` != '' ");
PrintAr($older);

/*
if($older)foreach ($older as $key => $value) {
	if ($older[$key]['expert'] != 0 or $older[$key]['text_expert'] != 0 or $older[$key]['active_mnenie'] != 0 or $order[$key]['expert_picture'] != 0 ) {
		$mneniya -> addParam('text_expert', $older[$key]['text_expert']);
		$mneniya -> addParam('expert', $older[$key]['expert']);
		$mneniya -> addParam('active_mnenie', $older[$key]['active_mnenie']);
		$mneniya -> addParam('expert_picture', $older[$key]['expert_picture']);
		$mneniya -> addParam('id_news', $older[$key]['id']);
		$mneniya -> newItem();
		if ($older[$key]['expert_picture']) {
			$absitem->addExpertFile("{ROOT}/{$absitem->fileDirectory}/{$older[$key][id]}/expert/{$mneniya->id}", $older[$key]['expert_picture'], $mneniya->id);
		}
	}
}
*/
?>