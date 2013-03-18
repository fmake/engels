[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption}</h1>
		<div class="add_advert_button">
			<a href="{site_obj.getLinkPage(1291)}?form=add_immovable">
				<button type="submit" class="button">
					<span class="button-left">
						<span class="button-right">
							<span class="button-text">
								<span><b>Добавить недвижимость</b></span>
							</span>
						</span>
					</span>
				</button>
			</a>
		</div>
		[[ include TEMPLATE_PATH ~ "immovables/immovables_filter.tpl"]]
		
		[[for item in immovables]]
			<div class="shortnews inline_block">
				[[if item.picture]]<a href="{item.full_url}"><img alt="" src="/{site_obj.fileDirectory}{item.id}/100_80_{item.picture}" align="left" class="shortnewsimg"></a>[[endif]]
				<div class="date">
					<div class="name">
						<a href="{site_obj.getLinkPage(item.parent)}"><span>{item.name_category}</span></a>
					</div>
					<span>{df('date','d.m.Y',item.date)}</span>
				</div>
				<a href="{item.full_url}">{item.addres} , комнат: {item.count_room}</a>
				<p>	
					{item.price} руб.
				</p>
				[[set tags = item.tags]]
				[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
			</div>
		[[endfor]]
		
		[[if not_found]]
			<h2>По данным параметрам ничего не найдено.</h2>
		[[endif]]
		
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>	
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "immovables/right_block_baner.tpl"]]
[[endblock]]