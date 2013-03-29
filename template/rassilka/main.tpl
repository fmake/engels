
[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
		
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
		<div id="item_news">
				<p>
			<a href="/" class="breadcrubs">Главная</a>
			[[for b in breadcrubs]]
				[[if loop.last]]
					 / {b.caption}
				[[else]]
					<a href="{b.link}" class="breadcrubs">{b.caption}</a> /
				[[endif]]
			[[endfor]]
		</p>
		{item.alt_text|raw}
	</div>
[[endblock]]

[[block right]]
	
	[[ include TEMPLATE_PATH ~ "vote/right_block_baner.tpl"]]
	
[[endblock]]