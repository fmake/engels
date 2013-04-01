[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<div class="names">
			<h1>{modul.caption}</h1>
		</div>
		<div class="cl"></div>

		<div id="all_news">
		[[for item in comments]]
				<div class="item">
					[[if new.picture]]
						<div class="img">
							<a href="{new.full_url}">
								<img src="/{news_obj.fileDirectory}{new.id}/100_80_{new.picture}" alt="" />
							</a>
						</div>
					[[endif]]
					<div class="item_news">
						<div class="date">
							<span class="time">Дата комментария: {df('date','H:i d.m.Y',item.date)}</span>
						</div>
						<p class="f14">
							<a href="{new.full_url}">
								[[if item.user_params.post_create]]
									<a href="mailto:{item.user_params.login}@engels.bz">
										{item.user_params.login}
									</a>
								[[else]]
									{item.user_params.name_social}
								[[endif]]
							</a>
						</p>
						<div class="text">
							{new.text|raw}
						</div>
						[[set tags = new.tags]]
						[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
					</div>
					<div class="cl"></div>
				</div>
			[[endfor]]
		</div>

		<div class="cl"></div>
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>
	
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]