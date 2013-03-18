<?php

	$breadcrubs = $modul->getBreadCrumbs($modul->id);	

	$xmlParser = new xmlParser();
	$array_weather = $xmlParser->fileXmlToArray("http://informer.gismeteo.ru/xml/34175_1.xml");
	
	$array_weather_page = $array_weather['REPORT']['TOWN']['FORECAST'];
	$type_weather_param = array(0=>array("param"=>"@attributes","name"=>"Дата"),1=>array("param"=>"TEMPERATURE","name"=>"Tемпература<br>воздуха, °C"));
	if ($_GET['debug']==1) {
		//printAr($array_weather);
	}
	
	$globalTemplateParam->set('breadcrubs', $breadcrubs);
	$globalTemplateParam->set('array_weather_page', $array_weather_page);
	$globalTemplateParam->set('type_weather_param', $type_weather_param);
	$modul->template = "weather/main.tpl";
	
?>