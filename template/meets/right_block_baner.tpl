[[if baner9 or baner10]]
	<div id="right_news">
		/*БАНЕР*/
		[[if baner9]]
		<div>
			<p>
				[[if baner9.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner9.url}">
						{baner_obj.showBanerId(baner9.id,baner9.picture,baner9.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner9.id,baner9.picture,baner9.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		/*БАНЕР*/
		[[if baner10]]
		<div>
			<p>
				[[if baner10.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner10.url}">
						{baner_obj.showBanerId(baner10.id,baner10.picture,baner10.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner10.id,baner10.picture,baner10.format)|raw}
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