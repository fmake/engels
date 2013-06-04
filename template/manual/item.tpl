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
	[[ include TEMPLATE_PATH ~ "inBlock/recommend_news.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/what_say.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/journal.tpl"]]
<div class="kenta">
	<div class="page-container">
		<h1>Фоторепортажи</h1>
			<div class="item">
				<button class="next"></button>
				<button class="prev"></button>
				<div class="cl"></div>
				<div id="carusel">
					<ul>
						[[for report in items_photo]]
						<li>
							<div class="hidden_item" style="width: 171px;">
								<div class="hidden_link">
									<div class="time">{df('date','d.m.Y',report.date)}</div>
									<div class="icons"><a href="{report.full_url}"><img src="/images/bg/fotocamera.png" alt="" title="Фото" />{gallery_obj.getCountPhoto(report.id)}</a></div>
									<div class="cl"></div>
									<a href="{report.full_url}" class="d-l">{report.caption}</a>
								</div>
								<a href="{report.full_url}"><img src="/{photo_obj.fileDirectory}{report.id}/200_160_{report.picture}" alt="" width="171px" height="154px"></a>
							</div>
						</li>
						[[endfor]]
					</ul>
				</div>
				
			</div>
			<div class="cl"></div>
			<div class="block_all_bew">
				<!--ОБЬЯВЛЕНИЯ-->
				<div class="item">
					<a href = "{site_obj.getLinkPage(796)}" class = "h1">
						<h1>Объявления</h1>
					</a>
					<div class="cl"></div>
					[[for item in items_advert_main2]]
						<div class="block [[if loop.index == 4 or loop.index == 1]]lt[[endif]]">
							<div class="category">[[if item.type_advert2==0]]Продажа[[elseif item.type_advert2 == 1]]Покупаю[[elseif item.type_advert2 == 2]]Аренда[[else]]Услуги[[endif]]</div>
							<div class="cl"></div>
							<div class="text">
								<a href="{item.full_url}">{item.caption}</a>[[if item.price]]<span> {item.price}</span>[[endif]]
							</div>
						</div>
						[[if loop.index == 3]]
							<div class="cl"></div>
						[[endif]]
					[[endfor]]
					<div class="cl"></div>
				</div>
				<!--ОБЬЯВЛЕНИЯ-->
			</div>
			<div class="ap_bl">
				/*БАНЕР new*/
					[[set baner_spravochnik = baner_obj.showBanerType(7,'/spravochnik/')]]
					[[if baner_spravochnik]]
						<div>
							<p>
								{baner_spravochnik|raw}
							</p>
						</div>
					[[endif]]
				/*БАНЕР new*/
			</div>
			<div class="cl"></div>
			<div class="ttl"></div>
[[endblock]]