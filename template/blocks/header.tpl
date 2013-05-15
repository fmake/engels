<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{modul.title}</title>


	<title></title>
    <meta charset="UTF-8" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <META NAME="AUTHOR" CONTENT="future-group.ru" />

    <!-- тут значиться мета теги адаптивной верстки -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="HandheldFriendly" content="true" />


	<meta name="description" content="[[if modul.description]]{modul.description}[[else]]{modul.title}[[endif]]" />
	<meta name="keywords" content="[[if modul.keywords]]{modul.keywords}[[else]]{modul.title}[[endif]]" />
	<link rel="stylesheet" type="text/css" href="/styles/main.css?ver=0.3" />
    <link rel="stylesheet" type="text/css" href="/styles/south-street/jquery-ui-1.8.22.custom.css?ver=0.1" />
    <link rel="stylesheet" type="text/css" href="/styles/colorbox.css?ver=0.1" />
    <link rel="stylesheet" type="text/css" href="/styles/lenta.css?ver=0.1">
	<meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">	
        <!--[if lte IE 7]>
        	<link rel="stylesheet" type="text/css" href="/css/iehack6.css?ver=0.1">
        <![endif]-->
	<script type="text/javascript" src="/js/jquery-1.7.1.min.js?ver=0.2"></script>
	<script src="/js/jquery.cookie.js?ver=0.2" type="text/javascript"></script>
	<script type="text/javascript" src="/js/fieldFocus.js?ver=0.2"></script>
	<script type="text/javascript" src="/js/jquery.ratings.js"></script>
	<script type="text/javascript" src="/js/scripts.js?ver=0.2"></script>
    <script src="/js/popup.js?ver=0.1"  type="text/javascript"></script>
    <script type="text/javascript" src="/js/jquery.ui.core.js?ver=0.1"></script>
    <script type="text/javascript" src="/js/jquery.ui.widget.js?ver=0.1"></script>
    <script type="text/javascript" src="/js/jquery.ui.datepicker.js?ver=0.1"></script>
    <script type="text/javascript" src="/js/jquery.ui.datepicker-ru.js?ver=0.1"></script>
	<script type="text/javascript" src="/js/jquery.colorbox.js?ver=0.1"></script>
	<script type="text/javascript" src="/js/slides.min.jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.min.js?ver=0.2"></script>

	[[if item.picture]]
		<link rel="image_src" href="/{site_obj.fileDirectory}{item.id}/406__{item.picture}" />
		<meta property="og:image" content="/{site_obj.fileDirectory}{item.id}/406__{item.picture}" />
	[[endif]]
	
	<link rel="stylesheet" type="text/css" href="/styles/maps/main.css" />
	<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
	<script src="/js/maps/yandex.maps.js?ver=0.1" type="text/javascript"></script>

	
	[[raw]]
		<script>
		$(function() {
			$.datepicker.setDefaults( $.datepicker.regional[ "ru" ] );
		});
		</script>
	[[endraw]]
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	{xajax.printJavascript('/fmake/libs/xajax/')}
</head>