/*БАНЕР new*/
	<div>
		<br/>
		<p>
			{baner_obj.showBanerType(7,request_uri)|raw}
		</p>
	</div>
/*БАНЕР new*/
/*БАНЕР new*/
	<div>
		<br/>
		<p>
			{baner_obj.showBanerType(8,request_uri)|raw}
		</p>
	</div>
/*БАНЕР new*/
/*БАНЕР new*/
	<div>
		<br/>
		<p>
			{baner_obj.showBanerType(9,request_uri)|raw}
		</p>
	</div>
/*БАНЕР new*/
/*БАНЕР
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

/*БАНЕР
[[if baner20]]
<div>
	<br/>
	<p>
		[[if baner20.url]]
			<noindex>
			<a rel="nofollow" target="_blank" href="{baner20.url}">
				{baner_obj.showBanerId(baner20.id,baner20.picture,baner20.format)|raw}
			</a>
			</noindex>
		[[else]]
			{baner_obj.showBanerId(baner20.id,baner20.picture,baner20.format)|raw}
		[[endif]]
	</p>
</div>
[[endif]]
/*БАНЕР*/

[[set news_no_images = 1]]
[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
