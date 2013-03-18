<div id="right_news">
	/*БАНЕР*/
	[[if baner11]]
		<div>
			<p>
				[[if baner11.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner11.url}">
						{baner_obj.showBanerId(baner11.id,baner11.picture,baner11.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner11.id,baner11.picture,baner11.format)|raw}
				[[endif]]
			</p>
		</div>
	[[endif]]
	/*БАНЕР*/

	[[set news_no_images = 1]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
</div>