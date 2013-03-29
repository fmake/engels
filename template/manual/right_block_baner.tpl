<div id="right_news">
	/*БАНЕР new*/
		[[set baner_right_7 = baner_obj.showBanerType(7,request_uri)]]
		[[if baner_right_7]]
			<div>
				<br/>
				<p>
					{baner_right_7|raw}
				</p>
			</div>
		[[endif]]
	/*БАНЕР new*/
	/*БАНЕР new*/
		[[set baner_right_8 = baner_obj.showBanerType(8,request_uri)]]
		[[if baner_right_8]]
			<div>
				<br/>
				<p>
					{baner_right_8|raw}
				</p>
			</div>
		[[endif]]
	/*БАНЕР new*/
	/*БАНЕР new*/
		[[set baner_right_9 = baner_obj.showBanerType(9,request_uri)]]
		[[if baner_right_9]]
			<div>
				<br/>
				<p>
					{baner_right_9|raw}
				</p>
			</div>
		[[endif]]
	/*БАНЕР new*/

	[[set news_no_images = 1]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
</div>
