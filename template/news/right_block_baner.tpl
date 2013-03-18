[[if baner5 or baner6]]
	<div id="right_news">
		/*БАНЕР*/
		[[if baner5]]
		<div>
			<p style="width: 221px;height: 400px;">
				[[if baner5.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner5.url}">
						{baner_obj.showBanerId(baner5.id,baner5.picture,baner5.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner5.id,baner5.picture,baner5.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		/*БАНЕР*/
		[[if baner6]]
		<div>
			<p style="width: 221px;height: 400px;">
				[[if baner6.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner6.url}">
						{baner_obj.showBanerId(baner6.id,baner6.picture,baner6.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner6.id,baner6.picture,baner6.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		
		<div style="clear:both;"></div>
	</div>
[[else]]
	[[ include TEMPLATE_PATH ~ "news/right_block_news_theme.tpl"]]
[[endif]]