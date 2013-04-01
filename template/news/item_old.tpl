[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	
	<div class="new_news">
		<div id="item_news">
			<div id="item_new">
				<h1>{item.caption}</h1>
				[[if item.picture]]
						<img src="/{site_obj.isFile(item.id, 400)}" alt="" style="float: left; padding-right: 10px; "/>
				[[endif]]
				<div class="text">
					[[if item.dop_params.autor]]<span class="avtor">Автор: {item.dop_params.autor}</span>[[endif]]
					[[if item.dop_params.date]]<span class="date" style="float: none;">{df('date','d.m.Y H:i',item.dop_params.date)}</span>[[endif]]
					<div class="full_text">
						<p>{item.text|raw}</p>
							<div id="quot">
								[[for item in exp]]
									[[if item.text_expert]]
										<div class="quot" id="quot">
											[[if item.expert_picture]]
												<img src="/{site_obj.fileDirectory}{item.id_news}/expert/{item.id}/133_201{item.expert_picture}" alt="" />
											[[endif]]
											<img src="/images/icons/apostrof.png" alt="" />
											[[if item.expert]]
												<div class="n-c">{item.expert}</div>
											[[endif]]
											[[if item.text_expert]]
												<p>{item.text_expert|raw}</p>
											[[endif]]
											<div class="cl"></div>
										</div>
									[[endif]]
								[[endfor]]
							</div>
						<div id="video">
							[[if item.dop_params.video]]
								{item.dop_params.video|raw}
							[[endif]]
						</div>
						/*
						<div class="quot">
							<img src="/images/tmp/specialist.png" alt="" />
							<img src="/images/icons/apostrof.png" alt="" /><div class="n-c">Сергей Валентинович</div>
							<p>Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном от нее расстоянии в 27,7 тыс. км, тем не менее, интерес к нему не ослабевает.Сообщается, что</p>
							<div class="cl"></div>
						</div>
						<p>А НАСА заявило о том, что сближение астероида 2012 DA14 с Землей будет показано в прямом эфире. Специалисты агентства</p>
						*/
					</div>
				</div>
			</div>
			/*БАНЕР new*/
				<div class="cl"></div>
				<p style="width: 740px;">
						{baner_obj.showBanerType(10,request_uri)|raw}
				</p>
			/*БАНЕР new*/
			/*БАНЕР
			[[if baner19]] 
				<div class="cl"></div>
				<p style="width: 740px;">
				[[if baner19.url]]					
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner19.url}">
						{baner_obj.showBanerId(baner19.id,baner19.picture,baner19.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner19.id,baner19.picture,baner19.format)|raw}
				[[endif]]
				</p>
			[[endif]]
			/*БАНЕР*/
			<div class="cl"></div>
			<div class="socbutt">
				[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
			</div><br/>
			<div class="cl"></div>
			
			[[ include TEMPLATE_PATH ~ "comments/main.tpl"]]
			
			[[ include TEMPLATE_PATH ~ "blocks/marketgid_block.tpl"]]
			
		</div>
	</div>
[[endblock]]

[[block right]]
	
	[[ include TEMPLATE_PATH ~ "news/right_block_baner.tpl"]]
	
[[endblock]]

[[block include_block]]
	/*[[ include TEMPLATE_PATH ~ "blocks/nnn_block_include.tpl"]]*/
	[[ include TEMPLATE_PATH ~ "blocks/marketgid_block_include.tpl"]]
[[endblock]]