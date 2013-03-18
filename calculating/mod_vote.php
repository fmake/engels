<?php 
#mod_vote

$fmakeInterview = new fmakeInterview();
$count = $fmakeInterview->getNumRows(true);
$interview = $fmakeInterview->getInterview($count); 

$iscookie = array();
$vopros = array();
if ($interview) foreach ($interview as $key=>$interview_item) {
	
	$fmakeInterview->table = $fmakeInterview->table_vopros;
	$vopros[$key] = $fmakeInterview->getVoproses($interview_item['id'],true);
	if($request->interview_id != $interview_item['id']) {
		$iscookie[$key] = $fmakeInterview->isCookies($interview_item['id']);
	} else {
		if($iscookie_no_error) $iscookie[$key] = true;
		else $iscookie[$key] = false;
	}
}

$breadcrubs = $modul->getBreadCrumbs($modul->id);
$globalTemplateParam->set('vopros',$vopros);
$globalTemplateParam->set('interview',$interview);
$globalTemplateParam->set('iscookie',$iscookie);
$globalTemplateParam->set('breadcrubs', $breadcrubs);

$modul->template = "vote/main.tpl";