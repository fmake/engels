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
		
		[[if categories]]
			<div class="nav">
				<ul>
					[[set id_parent_page = item.parent]]
					[[set id_page = item.id]]
					[[for cat in categories]]
						<li class="[[if id_parent_page == cat.id or id_page == cat.id ]]active[[endif]]"><span><span><span><a href="{site_obj.getLinkPage(cat.id)}">{cat.caption}</a></span></span></span></li>
					[[endfor]]
				</ul>
			</div>
		[[endif]]
		<div class="cl"></div>
		
		[[ include TEMPLATE_PATH ~ "places/filter.tpl"]]
		
		<div class="story">
			[[if item.picture]]<img align="left" style="float:left;" src="/{places_obj.fileDirectory}{item.id}/406__{item.picture}">[[endif]]
			
			<div>
				<ul class="dop-params">
					<li class="rating"><strong>Рейтинг:</strong> <div class="block-rating" id="div-stars-update">{rating_show|raw}</div></li>
					[[if item.dop_params.addres]]<li><strong>Адрес:</strong> <a href="#adress">{item.dop_params.addres}</a></li>[[endif]]
					[[if item.dop_params.date_work]]<li><strong>Время работы:</strong> {item.dop_params.date_work}</li>[[endif]]
					[[if item.dop_params.phone]]<li><strong>Телефон:</strong> {item.dop_params.phone}</li>[[endif]]
					[[if item.dop_params.email]]<li><strong>Email:</strong> {item.dop_params.email}</li>[[endif]]
					[[if item.dop_params.web]]<li><strong>Web сайт:</strong> {item.dop_params.web}</li>[[endif]]
					[[if item.dop_params.wifi]]<li><strong>Wi-Fi:</strong> [[if item.dop_params.wifi=='1']]Да[[else]]Нет[[endif]]</li>[[endif]]
					[[if item.dop_params.bron_cherez_engels]]<li><strong>Бронь через Engels.bz:</strong> [[if item.dop_params.bron_cherez_engels=='1']]Да[[else]]Нет[[endif]]</li>[[endif]]
					[[if item.dop_params.kitchen]]<li><strong>Кухня:</strong> {item.dop_params.kitchen}</li>[[endif]]
					[[if item.dop_params.average_chek]]<li><strong>Средний счет:</strong> {item.dop_params.average_chek}</li>[[endif]]
					[[if item.dop_params.business_lunch]]<li><strong>Бизнес ланч:</strong> [[if item.dop_params.business_lunch=='1']]Да[[else]]Нет[[endif]]</li>[[endif]]
					[[if item.dop_params.banket]]<li><strong>Банкет:</strong> [[if item.dop_params.banket=='1']]Да[[else]]Нет[[endif]]</li>[[endif]]
					[[if item.dop_params.capacity]]<li><strong>Вместимость (кол-во чел.):</strong> {item.dop_params.capacity}</li>[[endif]]
					[[if item.dop_params.steam]]<li><strong>Парная:</strong> {item.dop_params.steam}</li>[[endif]]
					[[if item.dop_params.pool]]<li><strong>Бассейн:</strong> {item.dop_params.pool}</li>[[endif]]
					[[if item.dop_params.restroom]]<li><strong>Комната отдыха:</strong> {item.dop_params.restroom}</li>[[endif]]
					[[if item.dop_params.music]]<li><strong>Музыка:</strong> {item.dop_params.music}</li>[[endif]]
					[[if item.dop_params.residents]]<li><strong>Резиденты:</strong> {item.dop_params.residents}</li>[[endif]]
					[[if item.dop_params.num_dance_flors]]<li><strong>Кол-во танцполов:</strong> {item.dop_params.num_dance_flors}</li>[[endif]]
					[[if item.dop_params.num_track]]<li><strong>Кол-во дорожек:</strong> {item.dop_params.num_track}</li>[[endif]]
					[[if item.dop_params.type_billiards]]<li><strong>Вид бильярда:</strong> {item.dop_params.type_billiards}</li>[[endif]]
					[[if item.dop_params.num_tables]]<li><strong>Кол-во столов:</strong> {item.dop_params.num_tables}</li>[[endif]]
					[[if item.dop_params.more_services]]<li><strong>Доп. услуги:</strong> {item.dop_params.more_services}</li>[[endif]]
				</ul>
			</div>
			
			<div style="clear:both;"></div>
			
			{item.text|raw}
			
			[[set tags = item.tags]]
			[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
			
			[[if photos]]
				<div class="imglist fotoimg">
					<ul id="carouse-gallery" class="jcarousel-skin-tango" >
						[[for photo in photos]]
							<li>
								<a href="/images/galleries/{photo.id_catalog}/1024_{photo.image}" idrel="{photo.id}" class="show" title="{photo.title}">
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
			[[if items_meets]]
				<h3>Афиша:</h3>
				<ul class="place_photo_report">
				[[for item_meet in items_meets]]
					<li>
						<a href="{site_obj.getLinkPage(item_meet.id)}">{item_meet.caption}</a> [[if item_meet.date]]( {df('date','d.m.Y H:i',item_meet.date)} [[if item_meet.date_from]]- {df('date','d.m.Y H:i',item_meet.date_from)}[[endif]] )[[endif]]
					</li>
				[[endfor]]
				</ul>
			[[endif]]
			
			
			[[if items_photo_report]]
				<h3>Фоторепортажи:</h3>
				<div class="place_photo_report">
				[[for report in items_photo_report]]
					<div class="fotolist">
						[[if report.picture]]<a href="{report.full_url}"><img src="/{site_obj.fileDirectory}{report.id}/144_77_{report.picture}" alt=""></a>[[endif]]
						<div class="fotoinfo">
							<span class="date">{df('date','d.m.Y',report.date)}</span>
							<span class="view">{gallery_obj.getCountPhoto(report.id)}</span>
							<div style="clear:both;"></div>
						</div>
						<a href="{report.full_url}" class="fotolink">{report.caption}</a>
					</div>
				[[endfor]]
				<div class="cl"></div>
				</div>
			[[endif]]
			<div class="cl"></div>
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
			<div class="cl"></div>
		</div>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "places/right_block_baner.tpl"]]
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
				<!--СПРАВОЧНИК-->
				<div class="item">
					<a href="{site_obj.getLinkPage(1238)}" class="h1">
						<h1>Справочник</h1>
					</a>
					<div class="cl"></div>
					[[for item in items_manual_main2]]
						<div class="block [[if loop.index == 4 or loop.index == 1]]lt[[endif]]">
							<div class="caption">
								<a href="{item.full_url}">{item.caption}</a>
							</div>
							<div class="cl"></div>
							<div class="text">{item.info | raw}</div>
						</div>
						[[if loop.index == 3]]<div class="cl"></div>[[endif]]
					[[endfor]]
					<div class="cl"></div>
				</div>
				<!--СПРАВОЧНИК-->
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