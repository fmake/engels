[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		/*<h1>
			{modul.caption} 
			[[if search_date_to]]
				( c {df('date','d.m.Y',search_date_to)} по {df('date','d.m.Y',search_date_from)})
			[[endif]]
		</h1>*/
		/*<div class="name_filter">Поиск событий города</div>*/
		[[if categories]]
			<div class="nav">
				<ul>
					[[set id_parent_page = item.parent]]
					[[set id_page = item.id]]
					[[for cat in categories]]
						<li class="[[if id_parent_page == cat.id or id_page == cat.id ]]active[[endif]]">
							<a href="{site_obj.getLinkPage(cat.id)}">
								<span>
									<span>
										<span>
											<div class="dotted">{cat.caption}</div>
										</span>
									</span>
								</span>
							</a>
						</li>
					[[endfor]]
				</ul>
			</div>
		[[endif]]
		<div class="cl"></div>
		
		/*[[ include TEMPLATE_PATH ~ "meets/meet_filter.tpl"]]
		
		[[if not_found]]
		<p>По вашему запросу ничего не найдено. Попробуйте уточнить поиск.</p>
		[[endif]]*/
		
		<div class="cl" style="margin-top: 20px;"></div>
		[[for key, items in meets]]
			<div class="left_date">{df('date','d.m',key)}</div>
			<div class="all_meet_block" >
			[[for key, s_item in items]]
				<div class="cat_meet_block">
					[[if showed_caption != 1]]
						<div class="captionses">
							<a href="
								[[for cat in categories]]
									[[if cat.caption == key]]
										{site_obj.getLinkPage(cat.id)}
									[[endif]]
								[[endfor]]
							">
								{key}
							</a>
							<br />
						</div>
					[[endif]]
				[[for item in s_item]]
					[[if loop.index < 3]]
						<div class="meet_block" style="width: auto;">
							[[if item.picture]]<a href="{item.full_url}"><img alt="" src="/{meets_obj.fileDirectory}{item.id}/100_80_{item.picture}" align="left" class="shortnewsimg"></a>[[endif]]
							<div class="all_title" style="width: 100px; float: left;">
								<a class="bl" href="{item.full_url}">{item.caption}</a>
							</div>
							/*[[set tags = item.tags]]
							[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]*/
						</div>
					[[endif]]
				[[endfor]]
				</div>
			[[endfor]]
			</div>
			<div class="cl"></div>
		[[endfor]]
		<div class="cl"></div>
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>

[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "meets/right_block_categor.tpl"]]
[[endblock]]

