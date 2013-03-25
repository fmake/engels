<?php

/* ------------вспомогательные функции----------------- */

/* ------------вспомогательные функции----------------- */

require_once (ROOT . "/fmake/libs/xajax/xajax_core/xajax.inc.php");
//$xajax = new xajax();
$xajax = new xajax("/admin/index.php");
$xajax->configure('decodeUTF8Input', true);
if($_GET['debug']==1 && $_GET['key']=='5523887') $xajax->configure('debug',true);
$xajax->configure('javascript URI', '/fmake/libs/xajax/');

/* регистрация функции */
$xajax->register(XAJAX_FUNCTION, "addFormBaner");
/* регистрация функции */

/* написание функции */

function addFormBaner(){
	$objResponse = new xajaxResponse();
	$fmakeBanerContent = new fmakeBanerContent();
	$type_baners = $fmakeBanerContent->type_baners;
	if($type_baners)foreach($type_baners as $key=>$item){
		$select_type_options .= '<option value="'.$key.'">'.$item.'</option>';
	}
	$str_add_baner = "<div class=\"line_baner_add\">
	<input title=\"Название банера\" type=\"text\" name=\"baner[new][caption][]\" style=\"width:200px;\"/><input title=\"Загрузка банера\" type=\"file\" name=\"baner_new_picture[]\" />
	<select title=\"Тип банера\" name=\"baner[new][id_type][]\">".$select_type_options."</select>
	<input title=\"Цена расхода банера\" type=\"text\" name=\"baner[new][price][]\" style=\"width:80px;\"/>
	<input title=\"Кол.во показов банера\" type=\"text\" name=\"baner[new][max_count_view][]\"  style=\"width:80px;\"/>
	<input title=\"Ссылка на банер\" type=\"text\" name=\"baner[new][url][]\" style=\"width:150px;\"/>
	<input class=\"delete_baner\" title=\"Удалить\" type=\"submit\" />
	</div>";
	//$objResponse->prepend("add_baner_params","innerHTML", $str_add_baner);
	$objResponse->script("$('#add_baner_params').prepend('".$str_add_baner."');");
	return $objResponse;
}
function delete_banner(){
	$objResponse = new xajaxResponse();
	$fmakeBanerContent = new fmakeBanerContent();
}
/* написание функции */

$xajax->processRequest();
$globalTemplateParam->set('xajax', $xajax);