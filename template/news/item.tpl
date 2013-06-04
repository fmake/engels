[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	<div class="new_news">
		<div id="item_news">
			<div id="item_new">
				/*<h1>{item.caption}</h1>*/
				[[if item.picture]]
					<div class="img">
						[[if item.caption]]
							<div class="caption_top_new">
								<h1>{item.caption}</h1>
							</div>
							<div class="cl"></div>
						[[endif]]
						/*<div class="avtor_foto">Фото: Черекаев </div>*/
						[[if item.dop_params.anons]]
							<div class="annotation_new">
								<div>{item.dop_params.anons|raw}</div>
							</div>
						[[endif]]
							<div class="cl"></div>
							<table class="table1">
								<tr>
									<td class="t1">ТЕКСТ</td>
									<td class="t2">
										<a href="#comments">Коментарии [[if all_user_com]]({all_user_com})[[endif]]</a>
									</td>
									<td class="t3">Всего читали {count_newses.count}</td>
									[[if who_is_online]]<td class="t3">Читают {who_is_online}</td>[[endif]]
								</tr>
							</table>
							<div class="line">
								<img src="/images/tmp/tria.png" alt="" /></div>	
							<div class="cl"></div>
						<img src="/{site_obj.isFile(item.id, 744)}" alt="" width="444"/>
					</div>
					[[else]]
						<h1>{item.caption}</h1>
				[[endif]]
				<!-- NEW FUNCTIONAL -->
				<div class="psevdo">
					<div class="s_b_n">
					<script type="text/javascript" src="//yandex.st/share/share.js"
					charset="utf-8"></script>
					<div class="yashare-auto-init" data-yashareL10n="ru"
					 data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki"></div> 
					</div>
					[[if items_news_lent]]
						<h1>Лента</h1>
						<div class="arrow_new">
							<a href="{site_obj.getLinkPage(2)}">Все новости</a>
						</div>
						<div class="cl"></div>
						[[for item in items_news_lent]]
							<div class="pre_item">
								<div class="item">
									<div class="load_content_news">
										<div class="caption">{item.caption}</div>
										<div class="cl"></div>
										<img src="/{site_obj.isFile(item.id, 100, 100)}" width="100" height="100" />
										<div class="text">{item.anons}</div>
									</div>
									<div class="time">
										[[if item.date > to_day]]
											{df('date','H:i',item.date)}
										[[else]]
											{df('date','H:i d.m.Y',item.date)}
										[[endif]]
									</div>
									<div class="icons">
										[[if item.picture]]
											<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="У этой статьи есть Фото"/></a>
										[[endif]]
										
										[[if item.video]]
											<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="У этой статьи есть Видео"/></a>
										[[endif]]

										[[if item.mnenie]]
											<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
										[[endif]]
									</div>
									<div class="cl"></div>
									<div class="note">
										<a href="{news_obj.getLinkPage(item.parent)}"><span class="title">{item.name_category}</span></a>
										<a href="{news_obj.getLinkPage(item.id)}" class="show_this_news">{item.caption}</a>
										[[if item.comment]]<span class="comments">[{item.comment}]</span>[[endif]]
									</div>
								</div>
							</div>
							<div class="cl"></div>
						[[endfor]]
					[[endif]]
					<div id="psevdo_news_tape_close"></div>	
					<div class="cl"></div>
				</div>	
				<!-- NEW FUNCTIONAL -->
				<div class="cl"></div>
				<div class="text">
					[[if item.dop_params.autor]]<span class="avtor">Автор: {item.dop_params.autor}</span>[[endif]]
					[[if item.dop_params.date]]<span class="date">{df('date','d.m.Y H:i',item.dop_params.date)}</span>[[endif]]
					<div class="cl"></div>
					<div class="full_text">
						<p>{item.text|raw}</p>
						<div id="quot">
							[[for soso in exp]]
								[[if soso.text_expert]]
									<div class="quot" id="quot{soso.id}">
										[[if soso.expert_picture]]
											<img src="/{site_obj.fileDirectory}{soso.id_news}/expert/{soso.id}/133_201{soso.expert_picture}" alt="{soso.expert}" height="150" />
										[[endif]]
										<img src="/images/icons/apostrof.png" alt="" />
										[[if soso.expert]]
											<div class="n-c">{soso.expert}</div>
										[[endif]]
										[[if soso.text_expert]]
											<p>{soso.text_expert|raw}</p>
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
						[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
						<br />
			/*БАНЕР new*/
				<div class="cl"></div>
				<p style="width: 740px;">
					{baner_obj.showBanerType(10,request_uri)|raw}
				</p>
			/*БАНЕР new*/
			<div class="cl"></div>
			/*<div class="socbutt">
				[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
			</div><br/>*/
			<div class="cl"></div>
			
			[[ include TEMPLATE_PATH ~ "comments/main.tpl"]]
			
			[[ include TEMPLATE_PATH ~ "blocks/marketgid_block.tpl"]]
			
		</div>
	</div>

[[endblock]]

[[block right]]
	
	[[ include TEMPLATE_PATH ~ "news/right_block_baner.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/recommend_news.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/what_say.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/journal.tpl"]]
<div class="kenta">
	<div class="page-container">
		<h1>Фоторепортажи</h1>
			<div class="item">
				<button class="next"></button>
				<button class="prev"></button>
				<div class="cl"></div>
				<div id="carusel">
					<ul>
						[[for report in items_photo]]
						<li>
							<div class="hidden_item" style="width: 171px;">
								<div class="hidden_link">
									<div class="time">{df('date','d.m.Y',report.date)}</div>
									<div class="icons"><a href="{report.full_url}"><img src="/images/bg/fotocamera.png" alt="" title="Фото" />{gallery_obj.getCountPhoto(report.id)}</a></div>
									<div class="cl"></div>
									<a href="{report.full_url}" class="d-l">{report.caption}</a>
								</div>
								<a href="{report.full_url}"><img src="/{photo_obj.fileDirectory}{report.id}/200_160_{report.picture}" alt="" width="171px" height="154px"></a>
							</div>
						</li>
						[[endfor]]
					</ul>
				</div>
				
			</div>
			<div class="cl"></div>
			<div class="block_all_bew">
				<!--СПРАВОЧНИК-->
				<div class="item">
					<a href="{site_obj.getLinkPage(1238)}" class="h1">
						<h1>Справочник</h1>
					</a>
					<div class="cl"></div>
					[[for item in items_manual_main2]]
						<div class="block [[if loop.index == 4 or loop.index == 1]]lt[[endif]]">
							<div class="caption">
								<a href="{item.full_url}">{item.caption}</a>
							</div>
							<div class="cl"></div>
							<div class="text">{item.info | raw}</div>
						</div>
						[[if loop.index == 3]]<div class="cl"></div>[[endif]]
					[[endfor]]
					<div class="cl"></div>
				</div>
				<!--СПРАВОЧНИК-->
				<!--ОБЬЯВЛЕНИЯ-->
				<div class="item">
					<a href = "{site_obj.getLinkPage(796)}" class = "h1">
						<h1>Объявления</h1>
					</a>
					<div class="cl"></div>
					[[for item in items_advert_main2]]
						<div class="block [[if loop.index == 4 or loop.index == 1]]lt[[endif]]">
							<div class="category">[[if item.type_advert2==0]]Продажа[[elseif item.type_advert2 == 1]]Покупаю[[elseif item.type_advert2 == 2]]Аренда[[else]]Услуги[[endif]]</div>
							<div class="cl"></div>
							<div class="text">
								<a href="{item.full_url}">{item.caption}</a>[[if item.price]]<span> {item.price}</span>[[endif]]
							</div>
						</div>
						[[if loop.index == 3]]
							<div class="cl"></div>
						[[endif]]
					[[endfor]]
					<div class="cl"></div>
				</div>
				<!--ОБЬЯВЛЕНИЯ-->
			</div>
			<div class="ap_bl">
				/*БАНЕР new*/
					[[set baner_spravochnik = baner_obj.showBanerType(7,'/spravochnik/')]]
					[[if baner_spravochnik]]
						<div>
							<p>
								{baner_spravochnik|raw}
							</p>
						</div>
					[[endif]]
				/*БАНЕР new*/
			</div>
			<div class="cl"></div>
			<div class="ttl"></div>


[[endblock]]

[[block include_block]]
	/*[[ include TEMPLATE_PATH ~ "blocks/nnn_block_include.tpl"]]*/
	[[ include TEMPLATE_PATH ~ "blocks/marketgid_block_include.tpl"]]
[[endblock]]
