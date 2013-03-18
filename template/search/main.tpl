[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	
	<div id="item_news">
				
		<div id="all_news">
			[[for item in items]]
				<div class="item">
					[[if item.picture]]
						<div class="img">
							<a href="{item.full_url}"><img src="/{site_obj.fileDirectory}{item.id}/100_80_{item.picture}" alt="" /></a>
						</div>
					[[endif]]
					<div class="item_news">
						<p class="f14"><a href="{item.full_url}">{item.caption}</a></p>
						[[set tags = item.tags]]
						[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
					</div>
					<div class="cl"></div>
				</div>
			[[endfor]]
		</div>
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]