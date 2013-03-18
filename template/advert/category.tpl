[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
    <div id="item_news">
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
			
		<div style="padding-top: 30px;">
			[[for item in adverts]]
				<div class="shortnews_advert">
					[[if item.picture]]<a href="{item.full_url}"><img alt="" src="http://engels.bz/{advert_obj.fileDirectory}{item.id}/100_80_{item.picture}" align="left" class="shortnewsimg"></a>[[endif]]
					<div class="date"><span>{df('date','d.m.Y H:i',item.date)}</span></div>
					<a href="{item.full_url}">{item.caption}</a>
					<p>	
						{item.text|raw}
					</p>
				</div>
			[[endfor]]
		
			[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
		</div>                            
		{item.text|raw}
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "advert/right_block_baner.tpl"]]
[[endblock]]
