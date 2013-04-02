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
$xajax->register(XAJAX_FUNCTION, "addForm");
/* регистрация функции */

/* написание функции */

function addFormBaner($type = 0){
	$objResponse = new xajaxResponse();
	
	if($type == 1) $objResponse->script("$('#add_baner_params').prepend($('#id_new_post').html());");
	else $objResponse->script("$('#add_baner_params').prepend($('#id_new_baner').html());");
	
	return $objResponse;
}
function addForm(){
	$objResponse = new xajaxResponse();
	$objResponse->script("$('#add_form_mnenye').prepend($('#id_new_form').html());");
	return $objResponse;
}


/* написание функции */

$xajax->processRequest();
$globalTemplateParam->set('xajax', $xajax);