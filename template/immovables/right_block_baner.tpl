[[if baner14 or baner15]]
	<div id="right_news">
		/*БАНЕР*/
		[[if baner14]]
		<div>
			<p>
				[[if baner14.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner14.url}">
						{baner_obj.showBanerId(baner14.id,baner14.picture,baner14.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner14.id,baner14.picture,baner14.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		/*БАНЕР*/
		[[if baner15]]
		<div>
			<p>
				[[if baner15.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner15.url}">
						{baner_obj.showBanerId(baner15.id,baner15.picture,baner15.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner15.id,baner15.picture,baner15.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/

		<div style="clear:both;"></div>
	</div>
[[else]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endif]]