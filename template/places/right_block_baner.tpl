[[if baner7 or baner8]]
	<div id="right_news">
		/*БАНЕР*/
		[[if baner7]]
		<div>
			<p>
				[[if baner7.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner7.url}">
						{baner_obj.showBanerId(baner7.id,baner7.picture,baner7.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner7.id,baner7.picture,baner7.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		/*БАНЕР*/
		[[if baner8]]
		<div>
			<p>
				[[if baner8.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner8.url}">
						{baner_obj.showBanerId(baner8.id,baner8.picture,baner8.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner8.id,baner8.picture,baner8.format)|raw}
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