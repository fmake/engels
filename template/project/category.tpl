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
		
		<div style="padding-bottom: 15px;">
			{item.text|raw}
		</div>
		<div style="clear:both;height: 15px;"></div>
		[[for new in items]]
			<div class="shortnews">
				[[if new.picture]]<a href="{new.full_url}"><img alt="" src="/{site_obj.fileDirectory}{new.id}/100_80_{new.picture}" align="left"class="shortnewsimg"></a>[[endif]]
				<div class="date"><span>{df('date','d.m.Y H:i',new.date)}</span></div>
				<a href="{new.full_url}">{new.caption}</a>
				<p>	
					{new.anons|raw}
				</p>
				[[set tags = new.tags]]
				[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
			</div>
		[[endfor]]
		
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>	
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]