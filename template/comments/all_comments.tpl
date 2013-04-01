[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<div class="names">
			<h1>{modul.caption}</h1>
		</div>
		<div class="cl"></div>
		[[for item in comments]]
			<div class="item_comments">
				<div class="date">Дата комментария: {df('date','H:i d.m.Y',item.date)}</div>
				<div class="comment_caption">
					<a href="/{site_obj.getLinkPage(item.page_id)}#comment{item.id}">{item.page_caption}</a> от 
					[[if item.user_params.post_create]]
						<a href="mailto:{item.user_params.login}@engels.bz">
							{item.user_params.login}
						</a>
					[[else]]
						{item.user_params.name_social}
					[[endif]]
				</div>
				<div class="comment_text">
					<p>{item.text|raw}</p>
				</div>
			</div>
		[[endfor]]
		<div class="cl"></div>
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>
	
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]