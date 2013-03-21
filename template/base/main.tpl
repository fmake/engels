[[ include TEMPLATE_PATH ~ "blocks/header.tpl"]]
<body>
/*facebook like*/
[[raw]]
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=339698956065200";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
[[endraw]]
/*facebook like*/
	<!-- PAGE START-->
	<div id="page">
		<!-- HEADER START -->
		[[ include TEMPLATE_PATH ~ "blocks/site_header.tpl"]]
		<!-- HEADER END -->
		<!-- TAPE NEWS START -->
		<div class="cl"></div>
		[[if modul.index]]
		<div id="block_news">
			<div class="page-container">
				<!--PERSON START-->
				<div id="person">
					[[if items_news_exp]]
					<div class="interview">
						<h1>Мнение</h1>
						[[for ekspert in items_news_exp]]
						<div class="item [[if loop.index == 2]]lc[[endif]]">
							<div class="img_h">
								[[if ekspert.expert]]
									<div class="hidden_title">
										<a href="{ekspert.full_url}#quot" class="bell">{ekspert.expert}</a>
									</div>
								[[endif]]
									<a href="{ekspert.full_url}#quot">
										[[if ekspert.expert_picture]]
											<img width="133" alt="{ekspert.caption}" src="/{site_obj.fileDirectory}{ekspert.id}/expert/133_201{ekspert.expert_picture}" />
										[[elseif ekspert.picture]]
											<img width="133" alt="{ekspert.caption}" src="/{site_obj.fileDirectory}{ekspert.id}/112_169_{ekspert.picture}" />
										[[endif]]
									</a>
							</div>
							<a href="{ekspert.full_url}#quot">{ekspert.caption}</a>
						</div>
						[[endfor]]
						<div class="cl"></div>
					</div>
					[[endif]]
					<div class="ap">
						/*БАНЕР*/
						[[if baner1]]
						<div style="height: 117px;">
								[[if baner1.url]]
									<noindex>
									<a rel="nofollow" target="_blank" href="{baner1.url}">
										{baner_obj.showBanerId(baner1.id,baner1.picture,baner1.format)|raw}
									</a>
									</noindex>
								[[else]]
									{baner_obj.showBanerId(baner1.id,baner1.picture,baner1.format)|raw}
								[[endif]]
						</div>
						[[endif]]
						/*БАНЕР*/
					</div>
					<div class="cl"></div>
					<!-- ГОСТИ СТАРТ -->
					<div class="guest">
						<a href="{site_obj.getLinkPage(12)}" class="h1"><h1>Гости</h1></a>
						[[for interv in items_interv]]
						[[if loop.index != 3]]
						<div class="item [[if loop.index%2 == 0]]lc[[endif]]">
							<div class="img">
								<a href="{interv.full_url}">
									<img width="133" alt="{interv.title}" src="/{interv_obj.fileDirectory}{interv.id}/112_169_{interv.picture}" />
								</a>
							</div>
							<a href="{interv.full_url}">{interv.caption}</a>
						</div>
						[[elseif loop.index == 3 ]]
						<div class="cl"></div>
						</div>
						<div class="cl"></div>
						<div class="guest">
							<div class="item [[if loop.index%2 == 0]]lc[[endif]]">
								<div class="img">
									<a href="{interv.full_url}"><img  width="133" alt="{interv.title}" src="/{interv_obj.fileDirectory}{interv.id}/112_169_{interv.picture}" /></a>
								</div>
								<a href="{interv.full_url}">{interv.caption}</a>
							</div>
						[[endif]]
						[[endfor]]
						<div class="cl"></div>
					</div>

					<!-- ГОСТИ КОНЕЦ -->
					<!-- ЭКСПЕРТЫ СТАРТ -->
					<div class="guest">
						<a href="{site_obj.getLinkPage(3823)}" class="h1"><h1>Эксперт</h1></a>
						[[for ekspert in items_ekspert]]
						<div class="item [[if loop.index == 2]]lc[[endif]]">
							<div class="img_h">
								<a href="{ekspert.full_url}#answer_comment_item0">
									[[if ekspert.expert.picture]]
										<img width="133" alt="{ekspert.caption}" src="/images/users/{ekspert.expert.id_user}/112_169_{ekspert.expert.picture}" />
									[[elseif ekspert.picture]]
										<img width="133" alt="{ekspert.caption}" src="/{site_obj.fileDirectory}{ekspert.id}/112_169_{ekspert.picture}" />
									[[endif]]
								</a>
							</div>
							<a href="{ekspert.full_url}#answer_comment_item0">{ekspert.caption}</a>
						</div>
						[[endfor]]
						<div class="cl"></div>
					</div>
				</div>
				<!--PERSON END-->
				<div id="tape">
					<h1>Лента новостей</h1>
					/*
					<div class="nav">
						<ul>
							<li class="active" ><span><span><span><a href="#">Энгельс</a></span></span></span></li>
							<li><span><span><span><a href="#">Саратов</a></span></span></span></li>
							<li><span><span><span><a href="#">Все новости</a></span></span></span></li>
						</ul>
					</div>
					*/
					<div class="arrow"></div>
					<div class="news" id="x_tape">
					[[for item in items_news_lent]]
						[[if loop.index == 4]]
							/*БАНЕР*/
							[[if baner16]]
							<div style="">
									[[if baner16.url]]
										<noindex>
										<a rel="nofollow" target="_blank" href="{baner16.url}">
											{baner_obj.showBanerId(baner16.id,baner16.picture,baner16.format)|raw}
										</a>
										</noindex>
									[[else]]
										{baner_obj.showBanerId(baner16.id,baner16.picture,baner16.format)|raw}
									[[endif]]
							</div>
							[[endif]]
							/*БАНЕР*/
						[[endif]]
						[[if loop.index == 6]]
							/*БАНЕР*/
							[[if baner17]]
							<div style="">
									[[if baner17.url]]
										<noindex>
										<a rel="nofollow" target="_blank" href="{baner17.url}">
											{baner_obj.showBanerId(baner17.id,baner17.picture,baner17.format)|raw}
										</a>
										</noindex>
									[[else]]
										{baner_obj.showBanerId(baner17.id,baner17.picture,baner17.format)|raw}
									[[endif]]
							</div>
							[[endif]]
							/*БАНЕР*/
						[[endif]]
						<div class="item">
							<div class="time">
								[[if item.date > to_date]]
									{df('date','H:i',item.date)}
								[[else]]
									{df('date','H:i d.m.Y',item.date)}
								[[endif]]
							</div>
							<div class="icons">
								[[if item.picture]]<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="Фото"/></a>[[endif]]
								[[if item.video]]<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="Видео"/></a>[[endif]]
							</div>
							<div class="cl"></div>
							<div class="note">
								<a href="{news_obj.getLinkPage(item.parent)}"><span class="title">{item.name_category}</span></a>
								<a href="{news_obj.getLinkPage(item.id)}">{item.caption}</a>
								[[if item.comment]]<span class="comments">[{item.comment}]</span>[[endif]]
							</div>
						</div>
						[[if loop.index == 3 ]]
							[[set tape = 13 ]]
						[[endif]]
					[[endfor]]
					<div class="arrow niz" rel = "{tape}"></div>
					</div>
				</div>
				<!-- TAPE NEWS END -->
				[[raw]]
					<script type="text/javascript">
						$(function(){
							$(".slaider").slides({
								preload: true,
								preloadImage: '/images/pre.gif',
								play: 5000,
								pause: 2500,
								hoverPause: true,
								container: 'all_slaid',
								next: 'arrow-right',
								prev: 'arrow-left',
								paginationClass: 'slaider_nav',
								currentClass: 'active'
							})
						});
					</script>
				[[endraw]]
				<div id="block_main">
					<h1>Главное</h1>
					<div class="slaider">
						<div class="arrow-left">
							<img src="/images/bg/left-arrow.png" alt=""/>
						</div>
						<div class="arrow-right">
							<img src="/images/bg/right-arrow.png" alt=""/>
						</div>
						<div class="all_slaid">
						[[for item in items_news_main]]
						[[if item.picture ]]
							<div class="slaider-item">
								<a href="{item.full_url}">
									<div class="caption_top">
										<h2>{item.caption}</h2>
									</div>
								</a>
								[[if item.anons]]
								<a href="{item.full_url}">
									<div class="caption_down">
										<span>{item.anons|raw}</span>
									</div>
								</a>
								[[endif]]
							   	<a href="{item.full_url}">
							   		<img alt="{item.title}" src="/{news_obj.fileDirectory}{item.id}/379_181_{item.picture}" width="391px" height="181px" />
								</a>
							</div>
						[[endif]]
						[[endfor]]
						</div>
					</div>

					<div class="news-foto">
						<div class="news-bar">
							<div class="rb">
								<div class="inside">
									<div class="link">
										<a href="{news_obj.getLinkPage(2)}" rel="news-tab-main" class="active" id="rad">
											<div>Новости [[if count_news_new>0]]+{count_news_new}[[endif]]</div>
										</a>
										<a href="{news_obj.getLinkPage(639)}" rel="obzor-tab-main" class="">
											<div>Обзоры [[if count_news_obzor_new>0]]+{count_news_obzor_new}[[endif]]</div>
										</a>
										/*<a href="{news_obj.getLinkPage(2361)}" rel="project-tab-main" class="">
											<div>Проекты [[if count_project_new>0]]+{count_project_new}[[endif]]</div>
										</a>*/
										<a href="{news_obj.getLinkPage(1042)}" rel="comment-tab-main" class="">
											<div>Комментарии [[if count_comment_new>0]]+{count_comment_new}[[endif]]</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="cl"></div>
							<div class="newslist-content items">
								<div id="news-tab-main" class="tab-item active">
									[[ include TEMPLATE_PATH ~ "news/block_main_tab.tpl"]]                                         
								</div>
								<div id="obzor-tab-main" class="tab-item">
									[[set items_news = items_news_obzor]]
									[[set no_parent_show = 1]]
									[[ include TEMPLATE_PATH ~ "news/block_main_tab.tpl"]]              
								</div>
								/*<div id="project-tab-main" class="tab-item">
									[[set items_project = items_project]]
									[[set no_parent_show = 1]]
									[[ include TEMPLATE_PATH ~ "project/block_main_tab.tpl"]]               
								</div>*/
								<div id="comment-tab-main" class="tab-item">
									[[ include TEMPLATE_PATH ~ "comments/block_main_tab.tpl"]]
								</div>                         
							</div>                
					</div>
					<div class="fotorep">
						<a href="/fotoreportazhi/" class="h1"><h1>Фоторепортажи</h1></a>
						<a href="/fotoreportazhi/" class="fotolink">Все фото</a>
						<div class="cl"></div>
						<!--FOTO TOLLBAR START-->
						<div id="f-toolbar">
							[[for report in items_photo]]
							[[if loop.index < 13]]
								<div class="item">
								<div class="hidden_item">
									<div class="hidden_link">
										<div class="time">{df('date','d.m.Y',report.date)}</div>
										<div class="icons"><a href="{report.full_url}"><img src="/images/bg/fotocamera.png" alt="" title="Фото" />{gallery_obj.getCountPhoto(report.id)}</a></div>
										<div class="cl"></div>
										<a href="{report.full_url}" class="d-l">{report.caption}</a>
									</div>
									<a href="{report.full_url}"><img src="/{photo_obj.fileDirectory}{report.id}/200_160_{report.picture}" alt="" width = "200px" height="154px" /></a>
								</div>
								<img src="/{photo_obj.fileDirectory}{report.id}/200_160_{report.picture}" alt="" width = "132px" height="102px"/>
								</div>
								[[endif]]
							[[endfor]]
						</div>
						<!--FOTO TOLLBAR END-->
					</div>
				</div>
				<div class="cl"></div>
				<div class="niz_ap">
					/*БАНЕР*/
					[[if baner2]]
						<p>
						[[if baner2.url]]
							<noindex>
							<a rel="nofollow" target="_blank" href="{baner2.url}">
								{baner_obj.showBanerId(baner2.id,baner2.picture,baner2.format)|raw}
							</a>
							</noindex>
						[[else]]
							{baner_obj.showBanerId(baner2.id,baner2.picture,baner2.format)|raw}
						[[endif]]
						</p>
					[[endif]]
					/*БАНЕР*/
				</div>
			</div>
			<div class="cl"></div>
		</div>
		<div class="cl"></div>
	<!--BLOCK NEWS END-->
	<!-- JOURNAL START -->
	<div id="journal">
			<div class="shadow_img top"></div>
		<div class="page-container">
			<!--АФИША СТАРТ -->
			<div id="afish">
				[[ include TEMPLATE_PATH ~ "meets/main_block.tpl"]]
			</div>
			<!-- АФИША КОНЕЦ -->
			<div id="place">
				[[ include TEMPLATE_PATH ~ "places/main_block.tpl"]]
				<div class="cl"></div>
				<div class="map">
					<a href="#"><img src="images/icons/google_map.png" alt=""/></a>
					<a href="{place_obj.getLinkPage(5)}?maps=true" class="f16">Посмотреть на интерактивной карте</a>
				</div>
			</div>
			<div class="cl"></div>
			[[if items_news_inwave]]
				<div id="pointer">
					/*<h1>Журнал в теме</h1>*/
					[[for item in items_news_inwave]]
						<div class="item">
							[[if item.picture]]
								<a href="{item.full_url}"><div class="img"><img src="/{news_obj.fileDirectory}{item.id}/100_80_{item.picture}" alt="{item.description}" width="80px" height="80px" /></a></div>
							[[endif]]
							<div class="title"><a href="{item.full_url}" class="f14">{item.caption}</a></div>
							/*<div class="text">{item.text|raw}</div>*/
						</div>
							[[if loop.index%4 == 0]]
								<div class="cl"></div>
							[[endif]]
					[[endfor]]
					<div class="cl"></div>
				</div>
			[[endif]]
		</div>
		<div class="cl"></div>
		<div class="shadow">
			<div class="shadow_img"></div>
		</div>
	</div>
	<!-- JOURNAL END-->
	<!-- FORMS START-->
	<div id="forms">
		<div class=page-container>

			/*БАНЕР*/
				[[if baner4]]
				<div style="">
				  [[if baner4.url]]
				   <noindex>
				   <a rel="nofollow" target="_blank" href="{baner4.url}">
				    {baner_obj.showBanerId(baner4.id,baner4.picture,baner4.format)|raw}
				   </a>
				   </noindex>
				  [[else]]
				   {baner_obj.showBanerId(baner4.id,baner4.picture,baner4.format)|raw}
				  [[endif]]
				</div>
				[[endif]]
			/*БАНЕР*/

		<!-- СПРАВОЧНИК START -->
			<div class="asks">
				<a href="{site_obj.getLinkPage(1238)}" class="h1">
					<h1>Справочник</h1>
				</a>
				<button onclick="location.href = '{site_obj.getLinkPage(1238)}?form=add_manual';">
					<span><span><span>Добавить компанию</span></span></span>
				</button>
				<div class="cl"></div>
				<div class="desk">
					<div class="page-container">
					[[for item in items_manual_main]]
						[[if baner3]]
							[[if loop.index != 3 and loop.index != 2]]
								[[if loop.index == 7]]
								
								[[else]]
									<div class="item">
										<div class="title">
											<a href="{item.full_url}">{item.caption}</a>
										</div>
										[[if item.info or item.info != 0 or item.info != "" or item.info !=" "]]
											<div class="text">{item.info}</div>
										[[endif]]
									</div>
								[[endif]]
							[[elseif loop.index == 2]]
								<div class="">
									/*БАНЕР*/
									[[if baner3]]
										<p style="width: 201px;height: 110px;">
										[[if baner3.url]]								
											<noindex>
											<a rel="nofollow" target="_blank" href="{baner3.url}">
												{baner_obj.showBanerId(baner3.id,baner3.picture,baner3.format)|raw}
											</a>
											</noindex>
										[[else]]
											{baner_obj.showBanerId(baner3.id,baner3.picture,baner3.format)|raw}
										[[endif]]
										</p>
									[[endif]]
									/*БАНЕР*/
								</div>
								 <div class="item">
									<div class="title">
										<a href="{item.full_url}">{item.caption}</a>
									</div>
									<div class="text">{item.info}</div>
								</div>
							[[elseif loop.index == 3]]
								</div>
								<div class="page-container">
									<div class="item">
										<div class="title">
											<a href="{item.full_url}">{item.caption}</a>
										</div>
										<div class="text">{item.info}</div>
									</div>
							[[endif]]
						[[else]]
							[[if loop.index != 4]]
								<div class="item">
									<div class="title">
										<a href="{item.full_url}">{item.caption}</a>
									</div>
									<div class="text">{item.info}</div>
								</div>
							[[elseif loop.index == 4]]
								</div>
								<div class="page-container">
									<div class="item">
										<div class="title">
											<a href="{item.full_url}">{item.caption}</a>
										</div>
										<div class="text">{item.info}</div>
									</div>
							[[endif]]
						[[endif]]
					[[endfor]]
					</div>
				</div>
			</div>
		<!-- СПРАВОЧНИК END -->
		<!-- НЕДВИЖИМОСТЬ START -->
			<div class="asks2">
				<div class="buyplace">
					<a href="{site_obj.getLinkPage(1291)}" class="h1">
						<h1>Недвижимость</h1>
					</a>
					<button onclick="location.href ='{site_obj.getLinkPage(1291)}?form=add_immovable';">
						<span><span><span>Добавлить недвижимость</span></span></span>
					</button>
					<div class="cl"></div>
					<div class="desk">
						<div class="page-container">
							[[for item in items_immovable_main]]
								[[if loop.index%4==0]]
									</div>
									<div class="page-container">
								[[endif]]
							<div class="item">
								<a href="{item.full_url}">{item.addres} , комнат : {item.count_room}</a>[[if item.price]]<span>{item.price} руб.</span>[[endif]]
							</div>
							[[endfor]]
						</div>
					</div>
				</div>
				<div class="cl"></div>

				/*БАНЕР*/
					[[if baner21]]
					<div style="">
					  [[if baner21.url]]
					   <noindex>
					   <a rel="nofollow" target="_blank" href="{baner21.url}">
					    {baner_obj.showBanerId(baner21.id,baner21.picture,baner21.format)|raw}
					   </a>
					   </noindex>
					  [[else]]
					   {baner_obj.showBanerId(baner21.id,baner21.picture,baner21.format)|raw}
					  [[endif]]
					</div>
					[[endif]]
				/*БАНЕР*/

				<div class="tasks">
					<a href = "{site_obj.getLinkPage(796)}" class = "h1">
						<h1>Объявления</h1>
					</a>
					<button onclick="location.href ='{site_obj.getLinkPage(796)}?form=add_advert';">
						<span><span><span>Добавлить Объявления</span></span></span>
					</button>
					<div class="cl"></div>
					<div class="desk">
						<div class="page-container">
							[[for item in items_advert_main]]
								[[if loop.index%4==0]]
								</div>
								<div class="page-container">
								[[endif]]
							<div class="item">
								<div class="title">[[if item.type_advert==0]]Продажа[[elseif item.type_advert == 1]]Покупаю[[elseif item.type_advert == 2]]Аренда[[else]]Услуги[[endif]]</div>
								<a href="{item.full_url}">{item.caption}</a>[[if item.price]]<span>{item.price}</span>[[endif]]
							</div>
							[[endfor]]
						</div>
					</div>
				</div>
			</div>
		<!-- НЕДВИЖИМОСТЬ END -->
			<div class="cl"></div>
			<!-- ГОЛОСОВАНИЕ START -->
				<div id="votes">
					<h1>Голосование</h1>
					<a name="golosovanie"></a>
					[[for key,interv_item in interview]]
					<div class="vote">
						<div class="title">{interv_item.caption}</div>
					[[if vopros[key] ]]
						<form action="#questionform" method="post" id="QuestionFormRight{interv_item.id}" onsubmit="SubmitFormVote({interv_item.id}); return false;" style="position: relative;"> 
							<img src="/images/pre.gif" style="display: none; position: absolute; left: 95px; top: 21px;" alt="" /> 
							[[set Quest = vopros[key] ]]
							[[set Cook = iscookie[key] ]]
							[[set interview_id = interv_item.id ]]
							[[set Do = 0]]
							[[ include TEMPLATE_PATH ~ "xajax/vote_main.tpl"]]
						</form>
					[[else]]
						нет вопросов
					[[endif]]
				</div>
				[[endfor]]
				<div class="cl"></div>
			</div>
			<!-- ГОЛОСОВАНИЕ END -->
		</div>
		<div class="cl"></div>
		<div class="shadow">
			<div class="shadow_img"></div>
		</div>
	</div>
	<!-- FORMS END-->
	[[else]]
		<div id="block_news">
			<div class="page-container">
				[[block center]]
				
				[[endblock]]
				
				[[block right]]
					<div id="right_news">
						
						<div class="right_item_news">
							<h1>Другие новости</h1>
							<div class="news">
								<div class="item">
									<div class="time">19:18</div>
									<div class="icons"></div>
									<div class="cl"></div>
									<div class="note"><span class="title">Дорога:</span><a href="#">В дорожной аварии в Объединенных Арабских Эмиратах погибли 22 человека</a><span class="comments">[6]</span></div>
								</div>
								<div class="item">
									<div class="time">19:18</div>
									<div class="icons"><a href="#"><img src="/images/bg/fotocamera.png" alt="" title="Фото"/></a><a href="#"><img src="/images/bg/camera.png" alt="" title="Видео"/></a></div>
									<div class="cl"></div>
									<div class="note"><span class="title">Аэропорт:</span><a href="#">В «Шереметьево» и «Внуково» из-за погоды задерживают рейсы</a><span class="comments">[600]</span></div>
								</div>
								<div class="item">
									<div class="time">19:18</div>
									<div class="icons"></div>
									<div class="cl"></div>
									<div class="note"><span class="title">Дорога:</span><a href="#">В дорожной аварии в Объединенных Арабских Эмиратах погибли 22 человека</a><span class="comments">[6]</span></div>
								</div>
							 </div>
						</div>
							<div class="right_item_news">
								<h1>Фоторепортажи</h1>
								<div class="hidden_item" style="width: 200px;">
									<div class="hidden_link" >
										<div class="time">23.01.2013</div>
										<div class="icons"><a href="#"><img src="/images/bg/fotocamera.png" alt="" title="Фото"/>[600]</a></div>
										<div class="cl"></div>
										<a href="#" class="d-l">Линк этой новости...</a>
									</div>
									<a href="#"><img src="/images/tmp/1.gif" width="200" alt="" /></a>
								</div>
							</div>
						<img src="/images/tmp/right_on_tut_on_ryadom.png" alt="" class="ap"/>
						<div class="right_item_news">
							<h1>Объявления</h1>
							<div class="tasks">
								<div class="desk">
									<div class="page-container">
										<div class="item">
											<div class="title">Услуги</div>
											<a href="#">ТЭО, бизнес-план для получения кредита в банке, гранта и т.п.</a><span></span>
										</div>
										<div class="item">
											<div class="title">Услуги</div>
											<a href="#">Ремонт квартир</a><span>договорная</span>
										</div>
										<div class="item">
											<div class="title">Услуги</div>
											<a href="#">Ремонт квартир</a><span>договорная</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="right_item_news">
							<h1>Места</h1>
							<div class="place">
								<div class="item">
									<a href="#"><img src="/images/tmp/f2.png" alt=""/></a>
									<a href="#">Выставка живописи Сергея Сакова</a>
								</div>
							</div>
						</div>
					</div>
					<div class="cl"></div>
					</div>
					<div class="niz_ap">
						<img src="/images/tmp/novii_god.png" alt="" />
					</div>
				[[endblock]]
				<div class="cl"></div>
				[[block baner_niz]]
					[[if modul.index]]
						<div class="niz_ap">
							<img src="/images/tmp/novii_god.png" alt="" />
						</div>
					[[endif]]
				[[endblock]]
			</div>
		</div>
	[[endif]]
<div class="cl"></div>
</div>
<div class="cl"></div>
    <div id="down">
        <div class="page-container">
            <div class="menu">
                <div class="logo">
                    <img src="/images/logo/footer_logo_header.png" alt=""/>
                    <img class="i14" src="/images/icons/14+.png" alt="" />
                </div>
                <div class="nav">
					
					<a href="{site_obj.getLinkPage(5)}"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Места</div></div></div></a>
					<a href="{site_obj.getLinkPage(4)}"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Афиша</div></div></div></a>
					<a href="{site_obj.getLinkPage(12)}"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Гости</div></div></div></a>
                    <a href="{site_obj.getLinkPage(796)}"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Объявления</div></div></div></a>
                    <a href="{site_obj.getLinkPage(1238)}"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Справочник</div></div></div></a>
                    <a href="{site_obj.getLinkPage(2)}"  class="d-n" ><div class="rr"><div class="ll"><div class="cc">Новости</div></div></div></a>
                    <div class="cl"></div>
                    /*
                    <a href="#"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Места</div></div></div></a>
                    <a href="#"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Объявления</div></div></div></a>
                    <a href="#"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Справочник</div></div></div></a>
                    <a href="#"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Новости</div></div></div></a>
                    <a href="#"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Город</div></div></div></a>
                    <a href="#"  class="d-n"><div class="rr"><div class="ll"><div class="cc">Саратов</div></div></div></a>
                    <div class="cl"></div>
                    */
                    <div class="info">
                        <div class="float-left"><a href="mailto:{configs.email}">{configs.email}</a>, {configs.phone1}, {configs.phone2}</div>
                        <div class="float-right">
                        	<span>Engels.bz в социальных сетях:</span>
                        	<div class="soc_net">			
                         		<ul>
                         			[[if configs.link_vk]]
                        				<li><a class="soc_net_item lmnone vk" href = "{configs.link_vk}" target="_blank" title="Vkontakte"></a></li>
                        			[[endif]]

                        			[[if configs.link_tw]]
                        				<li><a class="soc_net_item tw" href = "{configs.link_tw}" target="_blank" title="Twitter"></a></li>
                        			[[endif]]

                        			[[if configs.link_yt]]
                        				<li><a class="soc_net_item yt" href = "{configs.link_yt}" target="_blank" title="YouTube"></a></li>
                        			[[endif]]

                        			[[if configs.link_fb]]
                        				<li><a class="soc_net_item fb" href = "{configs.link_fb}" target="_blank" title="Facebook"></a></li>
                        			[[endif]]

                        			[[if configs.link_ya]]
	                        			<li><a href="{configs.link_ya}"  target="_blank" class="soc_net_item ya" title="Yandex"></a></li>
	                        		[[endif]]
                        		</ul>
                        	</div>
                        </div>
                    </div>
                </div>
                <div class="cl"></div>
            </div>
            <div class="cl"></div>
            <div class="all">
                /*<div class="f-t-r">
                    УЧРЕДИТЕЛЬ И РЕДАКЦИЯ: ЗАО «ИД «Комсомольская правда».<br/>
                    Сетевое издание (сайт) зарегистрировано Роскомнадзором, свидетельство Эл№ФC77-50166 от 15 июня 2012.<br/>
                    Главный редактор - Сунгоркин В.Н.<br/>
                    Шеф-редактор сайта - Носова О.В.<br/>
                </div>
                <div class="f-t">
                    125993, Москва, Старый Петровско-Разумовский проезд, 1/23, стр. 1. Тел. +7 (495) 777-02-82.<br/>
                    Исключительные права на материалы, размещённые на интернет-сайте www.kp.ru, в соответствии с законодательством Российской Федерации об охране результатов интеллектуальной деятельности принадлежат
                </div> */
            </div>
            <div class="cl"></div>
            <div class="corypting">
                Copyright © Энгельс bz - городской портал - свидетельство о регистрации ЭЛ№ФС77-52410<br/>
                Свидетельство выдано 28 декабря 2012 года Федеральной службой по надзору за соблюдением законодательства в сфере массовых коммуникаций и охране культурного наследия. При использовании материалов сайта - гиперссылка обязательна | Замечания и предложения направляйте по адресу <a href="mailto:{configs.email}">{configs.email}</a>
            </div>
            <div class="cl"></div>
        </div>
        <div class="cl">
        </div>
    </div>
    <div id="footer">
        <div class="page-container">
            <div class="task1">
                [[raw]]
				<!--LiveInternet counter--><script type="text/javascript"><!--
				document.write("<a href='http://www.liveinternet.ru/click' "+
				"target=_blank><img src='//counter.yadro.ru/hit?t14.9;r"+
				escape(document.referrer)+((typeof(screen)=="undefined")?"":
				";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
				screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
				";"+Math.random()+
				"' alt='' title='LiveInternet: показано число просмотров за 24"+
				" часа, посетителей за 24 часа и за сегодня' "+
				"border='0' width='88' height='31'><\/a>")
				//--></script><!--/LiveInternet-->
				[[endraw]]
            </div>
            <div class="task2">
				[[raw]]
                <!-- Yandex.Metrika informer -->
				<a href="http://metrika.yandex.ru/stat/?id=16861387&amp;from=informer"
				target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/16861387/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
				style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:16861387,type:0,lang:'ru'});return false}catch(e){}"/></a>
				<!-- /Yandex.Metrika informer -->

				<!-- Yandex.Metrika counter -->
				<script type="text/javascript">
				(function (d, w, c) {
					(w[c] = w[c] || []).push(function() {
						try {
							w.yaCounter16861387 = new Ya.Metrika({id:16861387, enableAll: true, webvisor:true});
						} catch(e) { }
					});
					
					var n = d.getElementsByTagName("script")[0],
						s = d.createElement("script"),
						f = function () { n.parentNode.insertBefore(s, n); };
					s.type = "text/javascript";
					s.async = true;
					s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

					if (w.opera == "[object Opera]") {
						d.addEventListener("DOMContentLoaded", f);
					} else { f(); }
				})(document, window, "yandex_metrika_callbacks");
				</script>
				<noscript><div><img src="//mc.yandex.ru/watch/16861387" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
				<!-- /Yandex.Metrika counter -->
				[[endraw]]
            </div>
            <div class="create">
                <div class="ques">
                    <a href="{site_obj.getLinkPage(2326)}">Реклама на сайте</a>
                </div>
                <div class="company">
                    <a href="http://Future-Group.ru/" target="_blank">Создание сайтов</a> - Future
                </div>
            </div>
        </div>
    </div>
<div class="cl"></div>
<div style="display:none;">
	{generate_page}
	<br />
	<script>
		xajax_SiteCount({id_page});
	</script>
</div>

[[block include_block]]

[[endblock]]

</body>
</html>