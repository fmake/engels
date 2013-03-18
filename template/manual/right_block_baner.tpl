
/*БАНЕР*/
[[if baner18]]
<div>
	<br/>
	<p>
		[[if baner18.url]]
			<noindex>
			<a rel="nofollow" target="_blank" href="{baner18.url}">
				{baner_obj.showBanerId(baner18.id,baner18.picture,baner18.format)|raw}
			</a>
			</noindex>
		[[else]]
			{baner_obj.showBanerId(baner18.id,baner18.picture,baner18.format)|raw}
		[[endif]]
	</p>
</div>
[[endif]]
/*БАНЕР*/

[[set news_no_images = 1]]
[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
