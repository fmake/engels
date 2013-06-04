[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption}</h1>
		<div class="story">
			[[if photos]]
				<div class="immovable-gallery">
					<div class="items-gallery">
						[[for photo in photos]]
							<div class="item-gallery">
								<a title="{photo.title}" class="show cboxElement" href="/images/galleries/{photo.id_catalog}/1024_{photo.image}">
									<img width="100" height="75" alt="" src="/images/galleries/{photo.id_catalog}/thumbs/{photo.image}" />
								</a>
							</div>
						[[endfor]]
					</div>
				</div>
			[[endif]]
			<table>
				[[if item.dop_params.count_room]]<tr class="item-param-immovable"><td class="width167"><strong>Кол-во комнат: </strong></td><td>{item.dop_params.count_room}</td></tr>[[endif]]
				[[if item.dop_params.floor]]<tr class="item-param-immovable"><td class="width167"><strong>Этаж: </strong></td><td>{item.dop_params.floor}</td></tr>[[endif]]
				[[if item.dop_params.floors_home]]<tr class="item-param-immovable"><td class="width167"><strong>Этажность дома: </strong></td><td>{item.dop_params.floors_home}</td></tr>[[endif]]
				[[if item.dop_params.general_area]]<tr class="item-param-immovable"><td class="width167"><strong>Общая площадь: </strong></td><td>{item.dop_params.general_area}</td></tr>[[endif]]
				[[if item.dop_params.living_area]]<tr class="item-param-immovable"><td class="width167"><strong>Жилая площадь: </strong></td><td>{item.dop_params.living_area}</td></tr>[[endif]]
				[[if item.dop_params.wc]]<tr class="item-param-immovable"><td class="width167"><strong>Сан. узел: </strong></td><td>{item.dop_params.wc}</td></tr>[[endif]]
				[[if item.dop_params.state]]<tr class="item-param-immovable"><td class="width167"><strong>Состояние: </strong></td><td>{item.dop_params.state}</td></tr>[[endif]]
				[[if item.dop_params.region]]<tr class="item-param-immovable"><td class="width167"><strong>Район: </strong></td><td>{item.dop_params.region}</td></tr>[[endif]]
				[[if item.dop_params.price_m2]]<tr class="item-param-immovable"><td class="width167"><strong>Цена за м2: </strong></td><td>{item.dop_params.price_m2} руб.</td></tr>[[endif]]
				[[if item.dop_params.price]]<tr class="item-param-immovable"><td class="width167"><strong>Цена: </strong></td><td>{item.dop_params.price} руб.</td></tr>[[endif]]
				[[if item.dop_params.addres]]<tr class="item-param-immovable"><td class="width167"><strong>Адрес: </strong></td><td>{item.dop_params.addres}</td></tr>[[endif]]
				[[if item.dop_params.phone]]<tr class="item-param-immovable"><td class="width167"><strong>Телефон: </strong></td><td>{item.dop_params.phone}</td></tr>[[endif]]
				[[if item.dop_params.email]]<tr class="item-param-immovable"><td class="width167"><strong>Email: </strong></td><td>{item.dop_params.email}</td></tr>[[endif]]
				[[if item.dop_params.name_user]]<tr class="item-param-immovable"><td class="width167"><strong>Контактное лицо: </strong></td><td>{item.dop_params.name_user}</td></tr>[[endif]]
			</table>
			<div style="clear:both;"></div>
			<table>
				[[if item.dop_params.info]]<tr class="item-param-immovable"><td class="width167"><strong>Описание: </strong></td><td>{item.dop_params.info|raw}</td></tr>[[endif]]
			</table>
		</div>
		
		[[set tags = item.tags]]
		[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
		<br/>
		<div style="margin-bottom:20px;">
			[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
		</div>
		
		[[ include TEMPLATE_PATH ~ "comments/main.tpl"]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "immovables/right_block_baner.tpl"]]
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