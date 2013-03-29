[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
		
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
		<div id="item_news">
		{item.alt_text|raw}
	</div>
[[endblock]]

[[block right]]
	
	[[ include TEMPLATE_PATH ~ "vote/right_block_baner.tpl"]]
	
[[endblock]]