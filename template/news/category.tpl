[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
		
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	
	<div id="item_news">
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
		
		<div id="all_news">
			[[for new in news]]
				<div class="item">
					[[if new.picture]]
						<div class="img">
							<a href="{new.full_url}">
								<img src="/{news_obj.fileDirectory}{new.id}/100_80_{new.picture}" alt="" />
							</a>
						</div>
					[[endif]]
					<div class="item_news">
						<div class="date">
							<span class="time">{df('date','H:i d.m.Y',new.date)}</span>
						</div>
						<p class="f14"><a href="{new.full_url}">{new.caption}</a></p>
						<div class="text">
							{new.anons|raw}
						</div>
						[[set tags = new.tags]]
						[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
					</div>
					<div class="cl"></div>
				</div>
			[[endfor]]
		</div>
		<div class="cl"></div>
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>
[[endblock]]

[[block right]]
	
	[[ include TEMPLATE_PATH ~ "news/right_block_categor.tpl"]]
	
[[endblock]]