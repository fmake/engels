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
	
	//$select_sitepage_options = '<option value=\"\">Выберете одну из страниц</option><option value=\"\">Все</option>';
	$select_sitepage_options = $select_type_options;
	
	//$str_add_baner = "<div class=\"line_baner_add\"><b>Настройка банера</b><br/>Название: <input title=\"Название банера\" type=\"text\" name=\"baner[new][caption][]\" value=\"\" style=\"width:200px;\"/><br/>Банер: <input title=\"Загрузка банера\" type=\"file\" name=\"baner_new_picture[]}\" /><br/>Тип банера: <select title=\"Тип банера\" name=\"baner[new][id_type][]\">".$select_type_options."</select><br/>Ссылка: <input title=\"Ссылка на банер\" type=\"text\" name=\"baner[new][url][]\" value=\"\" style=\"width:150px;\"/><br/>Цена за показ: <input title=\"Цена за показ\" type=\"text\" name=\"baner[new][price_baner_view][]\" value=\"\" style=\"width:150px;\"/> Цена за клик: <input title=\"Цена за клик\" type=\"text\" name=\"baner[new][price_baner_click][]\" value=\"\" style=\"width:150px;\"/><br/><b>Ограничения</b><br/>Страницы применения: <select title=\"Основные типы страниц\" name=\"baner[new][select_regular_exp][]\">".$select_sitepage_options."</select><input type=\"text\" name=\"baner[new][regular_exp][]\" value=\"\" /><br/>Периуд активности: <input title=\"Дата начала\" type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"baner[new][date_to][]\" value=\"\"  /><input title=\"Дата окончания\" type=\"text\" class=\"datepickerTimeField2\" id=\"filter-date2\" name=\"baner[new][date_from][]\" value=\"\"  /><br/>Расход: <input title=\"Цена расхода банера\" type=\"text\" name=\"baner[new][price][]\" value=\"\" style=\"width:80px;\"/> Кол-во показов: <input title=\"Кол.во показов банера\" type=\"text\" name=\"baner[new][max_count_view][]\" value=\"\" style=\"width:80px;\"/><br/><span class=\"delete_baner\" style=\"color:red;cursor:pointer;\">удалить</span></div>";
	//$objResponse->prepend("add_baner_params","innerHTML", $str_add_baner);
	$objResponse->script("$('#add_baner_params').prepend($('#id_new_baner').html());");
	return $objResponse;
}

/* написание функции */

$xajax->processRequest();
$globalTemplateParam->set('xajax', $xajax);