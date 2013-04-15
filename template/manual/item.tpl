[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	
	<div id="item_news">
		<!--
		  jCarousel library
		-->
		<script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/styles/tango/skin.css" />
		<script type="text/javascript">
			{place_script|raw}
		</script>
		<h1>{item.caption}</h1>
		<div class="story">
			[[if item.picture]]<img align="left" style="float:left;" src="/{manual_obj.fileDirectory}{item.id}/406__{item.picture}">[[endif]]
			
			<div>
				<ul class="dop-params">
					[[if item.dop_params.info]]<li><strong>Описание деятельности:</strong> {item.dop_params.info|raw}</li>[[endif]]
					[[if item.dop_params.city]]<li><strong>Город:</strong> {item.dop_params.city}</li>[[endif]]
					[[if item.dop_params.addres]]<li><strong>Адрес:</strong> <a href="#adress">{item.dop_params.addres}</a></li>[[endif]]
					[[if item.dop_params.time_work]]<li><strong>Время работы:</strong> {item.dop_params.time_work}</li>[[endif]]
					[[if item.dop_params.phone]]<li><strong>Телефон:</strong> {item.dop_params.phone}</li>[[endif]]
					[[if item.dop_params.email]]<li><strong>Email:</strong> {item.dop_params.email}</li>[[endif]]
					[[if item.dop_params.web]]<li><strong>Web сайт:</strong> {item.dop_params.web}</li>[[endif]]
					[[if item.dop_params.fio_contakt]]<li><strong>ФИО контактного лица:</strong> {item.dop_params.fio_contakt}</li>[[endif]]
					[[if item.dop_params.phone_contakt]]<li><strong>Телефон контактного лица:</strong> {item.dop_params.phone_contakt}</li>[[endif]]
				</ul>
			</div>
			
			<div style="clear:both;"></div>
					
			[[set tags = item.tags]]
			[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
			
			[[if photos]]
				<div class="imglist fotoimg">
					<ul id="carouse-gallery" class="jcarousel-skin-tango" >
						[[for photo in photos]]
							<li>
								<a href="/images/galleries/{photo.id_catalog}/1024_{photo.image}" class="show" title="{photo.title}">
									<img src="/images/galleries/{photo.id_catalog}/thumbs/{photo.image}" alt="" />
								</a>
							</li>
						[[endfor]]
					</ul>
					[[raw]]
					<script type="text/javascript">
						$('#carouse-gallery').jcarousel({ 
							auto: 4,
							wrap: 'circular'
						});
					</script>
					[[endraw]]
				</div>
			[[endif]]
			<div style="margin-bottom:20px;">
				[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
			</div>
			
			[[ include TEMPLATE_PATH ~ "comments/main.tpl"]]
			
			<a name="adress"></a>
			<div class="map-places">
				[[raw]]
				<script type="">
					window.onload = function () { 
						ymaps.ready(function () {
							addPlace(array_place,true,true);
						})
					}
				</script>
				[[endraw]]
				<div id="map" style="width: 100%; height: 520px;"></div>
			</div>
		</div>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "manual/right_block_baner.tpl"]]
[[endblock]]