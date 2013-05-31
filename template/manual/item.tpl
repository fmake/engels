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
	
<div class="cl"></div>
<div class="smarty_block">
	<div class="cl"></div>
	[[if news_for_recomend]]
		<div class="recomend">
			<h1>Рекомендуем</h1>
			<div class="cl"></div>
			<ul>
				[[for item in news_for_recomend]]
				<li>
					<a href="{item.full_url}"><img src="/{site_obj.isFile(item.id, 222, 127)}" alt="{item.title}" /></a>
					<div class="cl"></div>
					<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
					<div class="cl"></div>
					<div class="text">{item.anons | raw}</div>
				</li>
				[[endfor]]
			</ul>
			<div class="cl"></div>
		</div>
	[[endif]]
</div>
<div class="cl"></div>
<div class="say_out">
	<h1>Что говорят</h1>
	<div class="cl"></div>
	<div class="item">
		<div class="block_1" style="padding-top: 31px">
			<div class="cl"></div>
			[[for ekspert in items_news_exp]]
				[[if loop.index == 1 or loop.index == 2]]
				<div class="img [[if loop.index == 1]]ml0[[endif]]">
					<a href="{site_obj.getLinkPage(ekspert.id_news)}#quot{ekspert.id}">
						[[if ekspert.expert_picture]]
							<img width = "133" alt="{ekspert.caption}" src="/{site_obj.isFile(ekspert.id_news, 136, 149)}" />
						[[endif]]
					</a>						
					<div class="title">
						<a href="{site_obj.getLinkPage(ekspert.id_news)}#quot{ekspert.id}">{ekspert.caption}</a>
					</div>				
				</div>
				[[endif]]
				[[if loop.index == 2]]
			</div>	
		<div class="block_2" style="padding-top: 31px">
			<ul>
				[[endif]]
				[[if loop.index > 2]]
				<li>
					<a href="{site_obj.getLinkPage(ekspert.id_news)}#quot{ekspert.id}">{ekspert.caption}</a>
				</li>
				[[endif]]
			[[endfor]]
			</ul>
		</div>
	</div>
	<div class="item">
		<div class="block_1">
			<button class="say_out_button" onClick="window.location='{site_obj.getLinkPage(12)}'">
				<span>
					<span>
						<span>Гости</span>
					</span>
				</span>
			</button>
			<div class="cl"></div>
			[[for interv in items_interv]]
				[[if loop.index == 1 or loop.index == 2]]
					<div class="img [[if loop.index == 1]]ml0[[endif]]">
						<img src="/{site_obj.isFile(interv.id, 136, 149)}" alt="{interv.title}" /></a>
						<div class="title">
							<a href="{interv.full_url}">{interv.caption}</a>
						</div>				
					</div>
				[[endif]]
			[[if loop.index == 2]]
		</div>	
		<div class="block_2">
			<div class="link"><a href="{site_obj.getLinkPage(12)}">Другие гости</a></div>
			<ul>
			[[endif]]
			[[if loop.index > 2]]
				<li>
					<a href="{interv.full_url}">{interv.caption}</a>
				</li>
			[[endif]]
		[[endfor]]
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
</div>
</div>
<div id="journal">
		<div class="shadow_img top"></div>
		<div class="page-container">
			<!--АФИША-->
			<div class="my_new_afish">
				<a href="{site_obj.getLinkPage(4)}" class="h1">
					<h1>Афиша</h1>
				</a>
				[[for item in items_meets_main]]
					[[if loop.index == 1]]
						<div class="img1">
							<a href="{item.full_url}"><img src="/{site_obj.isFile(item.id, 244, 249)}" alt="{item.title}" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
						</div>
						<div class="img2">
							<div class="grid">
					[[else]]
								<div class="item_block  [[if loop.index == 2 or loop.index == 5]]lt[[endif]]">
									<a href="{item.full_url}"><img src="/{site_obj.fileDirectory}{item.id}/140_100_{item.picture}" width="140" height="100" alt="{item.title}"/></a>
									<div class="cl"></div>
									<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
								</div>
								[[if loop.index == 4]]<div class="cl"></div>[[endif]]
					[[endif]]
				[[endfor]]
								<div class="cl"></div>
							</div>
						</div>
				<div class="ap">
					<!--РЕКЛАМА -->
					/*БАНЕР new*/
						[[set baner_afisha = baner_obj.showBanerType(7,'/afisha/')]]
						[[if baner_afisha]]
							<div>
								<p>
									{baner_afisha|raw}
								</p>
							</div>
						[[endif]]
					/*БАНЕР new*/
				</div>
				<div class="cl"></div>	
			</div>
			<!--АФИША-->
			<!--МЕСТА-->
			<div class="my_new_afish">
				<a href="{site_obj.getLinkPage(5)}" class="h1">
				    <h1>Места</h1>
				</a>
    			[[for item in items_place_main2]]
	    			[[if loop.index == 1]]
						<div class="img1">
							<a href="{item.full_url}"><img src="/{site_obj.isFile(item.id, 244, 249)}" alt="{item.title}" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
						</div>
						<div class="img2">
							<div class="grid">
					[[else]]
							<div class="item_block [[if loop.index == 2 or loop.index == 5]]lt[[endif]]">
								<a href="{item.full_url}"><img src="/{site_obj.fileDirectory}{item.id}/140_100_{item.picture}" width="140" height="100" alt="{item.title}"/></a>
								<div class="cl"></div>
								<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
							</div>
						[[if loop.index == 4]]<div class="cl"></div>[[endif]]
					[[endif]]
				[[endfor]]
						<div class="cl"></div>
					</div>
				</div>
				<div class="ap">
					<!--РЕКЛАМА -->
					/*БАНЕР new*/
						[[set baner_mesta = baner_obj.showBanerType(7,'/mesta/')]]
						[[if baner_mesta]]
							<div>
								<p>
									{baner_mesta|raw}
								</p>
							</div>
						[[endif]]
					/*БАНЕР new*/
				</div>
				<div class="cl"></div>	
			</div>
			<!--МЕСТА-->
		</div>
		<div class="shadow">
			<div class="shadow_img"></div>
		</div>
	</div>
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