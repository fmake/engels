[[if baner12 or baner13]]
	<div id="right_news">
		/*БАНЕР*/
		[[if baner12]]
		<div>
			<p>
				[[if baner12.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner12.url}">
						{baner_obj.showBanerId(baner12.id,baner12.picture,baner12.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner12.id,baner12.picture,baner12.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		/*БАНЕР*/
		[[if baner13]]
		<div>
			<p>
				[[if baner13.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner13.url}">
						{baner_obj.showBanerId(baner13.id,baner13.picture,baner13.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner13.id,baner13.picture,baner13.format)|raw}
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