<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Быстрый старт. Размещение интерактивной карты на странице</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
	<script src="/js/maps/yandex.maps.js" type="text/javascript"></script>
</head>

<body>
	<script>
		{place_script|raw}
	</script>
	[[raw]]
	<script type="">
		ymaps.ready(initAllPlace);
	</script>
	[[endraw]]
	
	<div class="afisha-topic">
		По категориям: 
		[[for cat in categories]]
			<a [[if loop.index0>0]]class="separator"[[endif]] onclick="showPlaces({cat.id},array_place);return false;" href="{cat.full_url}">{cat.caption}</a>
		[[endfor]]
	</div>
    <div id="map" style="width: 100%; height: 520px;"></div>
</body>

</html>