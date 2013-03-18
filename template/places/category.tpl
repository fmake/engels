[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
    <div id="item_news">
		<h1>{item.caption}</h1>
		
		<div class="add_advert_button">
			<a href="{site_obj.getLinkPage(modul.params.id)}?form=add_place">
				<button type="submit" class="button">
					<span class="button-left">
						<span class="button-right">
							<span class="button-text">
								<span><b>Добавить место</b></span>
							</span>
						</span>
					</span>
				</button>
			</a>
		</div>
		
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
		
		<div class="item_places">
			[[for item in places]]
				<div class="shortnews [[if loop.index%2 == 0]]grey[[endif]]">
						<a href="{item.full_url}" class="img">
							[[if item.picture]]
								<img alt="" src="/{places_obj.fileDirectory}{item.id}/100_80_{item.picture}" align="left" />
							[[endif]]
						</a>
					<div class="date">
					<a href="{item.full_url}" class="caption">{item.caption}</a>
						<div class="name_place">
							<b>Раздел: </b>
							<a href="{places_obj.getLinkPage(item.parent)}">
								<span>{item.name_category}</span>
							</a>
						</div>
					</div>
					<div class="adress">	
						{item.addres}
					</div>
					<div class="phone">
						{item.phone}
					</div>
					[[set tags = item.tags]]
					/*[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]*/
					<div class="cl"></div>
				</div>
			[[endfor]]
		
			[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
		</div>                            
		{item.text|raw}
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "places/right_block_baner.tpl"]]
[[endblock]]
