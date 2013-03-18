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
[[endblock]]