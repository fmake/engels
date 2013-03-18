<?php

	$breadcrubs = $modul->getBreadCrumbs($modul->id);	

	$globalTemplateParam->set('breadcrubs', $breadcrubs);
	$modul->template = "text/text_no_news.tpl";
	
?>