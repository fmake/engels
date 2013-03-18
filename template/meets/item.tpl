[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
    <div id="item_news">
		<h1>{item.caption}</h1>
		<div class="name_filter">Поиск событий города</div>
		[[if categories]]
			<div class="nav">
				<ul>
					[[set id_parent_page = item.parent]]
					[[set id_page = item.id]]
					[[for cat in categories]]
						<li class="[[if id_parent_page == cat.id or id_page == cat.id ]]active[[endif]]"><a href="{site_obj.getLinkPage(cat.id)}"><span><span><span>{cat.caption}</span></span></span></a></li>
					[[endfor]]
				</ul>
			</div>
		[[endif]]
		<div class="cl"></div>
		
		/*[[ include TEMPLATE_PATH ~ "meets/meet_filter.tpl"]]*/
		
		<div class="story">
			[[if item.picture]]
				<img alt="" width="406" src="/{site_obj.fileDirectory}{item.id}/406__{item.picture}" align="left" style="float:left;" />
			[[endif]] 
			<p class="date">Дата : {df('date','d.m.Y',item.dop_params.date)}[[if item.dop_params.date_from]] - {df('date','d.m.Y',item.dop_params.date_from)}[[endif]]</p>
			
			[[if item.dop_params.info_place]]<div class="info_place">Мероприятие пройдет в <a href="{site_obj.getLinkPage(item.dop_params.info_place.id)}">{item.dop_params.info_place.caption}</a></div>[[endif]]
			
			{item.text|raw}
		</div>

		[[set tags = item.tags]]
		[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
		
		<div style="margin-bottom:20px;">
			[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
		</div>
		
		[[ include TEMPLATE_PATH ~ "comments/main.tpl"]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "meets/right_block_categor.tpl"]]
[[endblock]]