[[ include TEMPLATE_PATH ~ "blocks/header.tpl"]]
<body>
<div class="fullwidthtop">
	[[ include TEMPLATE_PATH ~ "blocks/site_header.tpl"]]
</div>
<div id="body">
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
	<div id="content">
		<div class="mbg8">
			[[if modul.index]]
				<img alt="1" src="/images/logo.png" style="float:left;margin-right:10px;">
			[[else]]
				<a href="/"><img alt="1" src="/images/logo.png" style="float:left;margin-right:10px;"></a>
			[[endif]]
			
			/*БАНЕР*/
			[[if baner0]]
				<p class="floatright" style="width: 722px; height: 95px;">
					[[if baner0.url]]
						<noindex>
						<a rel="nofollow" target="_blank" href="{baner0.url}">
							{baner_obj.showBanerId(baner0.id,baner0.picture,baner0.format)|raw}
						</a>
						</noindex>
					[[else]]
						{baner_obj.showBanerId(baner0.id,baner0.picture,baner0.format)|raw}
					[[endif]]
				</p>
			[[endif]]
			/*БАНЕР*/
			
			<div style="clear:both;"></div>
		</div>
		
		[[ include TEMPLATE_PATH ~ "blocks/menu.tpl"]]
		[[block center_all]]
		<div class="left" [[if not modul.index]]style="width:747px;margin-right:13px;"[[endif]] >
			[[block center]]
			<h3 class="main">Главное</h3>
			[[for item in items_news_main]]
				[[if loop.index == 1 ]]
				<div class="bignews">
					[[if item.picture]]
						<div class="posrel">
							<a href="{item.full_url}">
								<div class="bgcaption">
									<p>
										{item.anons|raw}
									</p>
								</div>
								<img alt="{item.title}" src="/{news_obj.fileDirectory}{item.id}/379_181_{item.picture}" />
							</a>
						</div>
					[[endif]]
					<a href="{item.full_url}">{item.caption}</a><br>
				</div>
				<div class="smallnews">
				[[else]]
					[[if loop.index == 2]]
						<div>
							[[if item.picture]]<a href="{item.full_url}"><img alt="{item.title}" src="/{news_obj.fileDirectory}{item.id}/100_80_{item.picture}" /></a>[[endif]]
						</div>
					[[endif]]
					<div>
						<a href="{news_obj.getLinkPage(item.id)}">{item.caption}</a>
						&nbsp;&nbsp;<span class="date">{df('date','d.m.Y',item.date)}</span>
					</div>
				[[endif]]
			[[endfor]]
			</div>
			<div style="clear:both;height:13px;"></div>
			<div class="line">
				<div class="info">
					<span>Анонс</span>
					<div class="bg"></div>
				</div>
				<div class="link">
					[[if configs.anons_main_title]]
						[[if configs.anons_main_url]]
							<a href="{configs.anons_main_url}">{configs.anons_main_title}</a>
						[[else]]
							{configs.anons_main_title}
						[[endif]]
					[[else]]	
						<a href="/novosti-ot-chitatelej/">Обо всех важных и интересных событиях города круглосуточно сообщайте нам</a>
					[[endif]]
				</div>
				<div style="clear:both;"></div> 
			</div>
			
			
			<div class="news-captions">
				<a href="{news_obj.getLinkPage(2)}" rel="news-tab-main" class="active">Новости [[if count_news_new>0]]+{count_news_new}[[endif]]</a><a href="{news_obj.getLinkPage(639)}" rel="obzor-tab-main" class="">Обзоры [[if count_news_obzor_new>0]]+{count_news_obzor_new}[[endif]]</a><a href="{news_obj.getLinkPage(2361)}" rel="project-tab-main" class="">Проекты [[if count_project_new>0]]+{count_project_new}[[endif]]</a><a href="{news_obj.getLinkPage(1042)}" rel="comment-tab-main" class="">Комментарии [[if count_comment_new>0]]+{count_comment_new}[[endif]]</a>
			</div>
			<div class="newslist-content">
				<div id="news-tab-main" class="tab-item active">
					[[ include TEMPLATE_PATH ~ "news/block_main_tab.tpl"]]				
				</div>
				<div id="obzor-tab-main" class="tab-item">
					[[set items_news = items_news_obzor]]
					[[set no_parent_show = 1]]
					[[ include TEMPLATE_PATH ~ "news/block_main_tab.tpl"]]				
				</div>
				<div id="project-tab-main" class="tab-item">
					[[set items_project = items_project]]
					[[set no_parent_show = 1]]
					[[ include TEMPLATE_PATH ~ "project/block_main_tab.tpl"]]				
				</div>
				<div id="comment-tab-main" class="tab-item">
					[[ include TEMPLATE_PATH ~ "comments/block_main_tab.tpl"]]
				</div>
			</div>
			[[endblock]]
			<div style="clear:both;"></div>
		</div>
		<div class="right" [[if not modul.index]]style="width:221px;"[[endif]]>
			[[block right]]
			<a href="/fotoreportazhi/" class="big">Фоторепортажи</a>
			<div class="mbten posrel">
				[[for photo in items_photo]]
					[[if loop.index0 == 0]]
						<div class="floatleft posrel">
							<a href="{photo.full_url}" >
								<img width="200" height="160" title="{photo.caption}" alt="{photo.title}" src="/{photo_obj.fileDirectory}{photo.id}/200_160_{photo.picture}" />
							</a>
						</div>
					[[else]]
						<div style="float:right;margin-bottom:6px"> 
							<a href="{photo.full_url}"><img width="144" height="77" title="{photo.caption}" alt="{photo.title}" src="/{photo_obj.fileDirectory}{photo.id}/144_77_{photo.picture}"/></a>
						</div>
					[[endif]]
				[[endfor]]
				<div style="clear:both;"></div>
			</div>
			
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
			
			<a href="{site_obj.getLinkPage(12)}" class="big">Гость Энгельс bz</a>
			<div style="margin-bottom:15px;">
				[[for interv in items_interv]]
					<div class="interview [[if loop.index == 3]]mrg0[[endif]]"> 
						<a href="{interv.full_url}"><img width="112" height="169" alt="{interv.title}" src="/{interv_obj.fileDirectory}{interv.id}/112_169_{interv.picture}"></a>
						<a href="{interv.full_url}">{interv.caption}</a>
					</div>
				[[endfor]]
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
		
		
		<a href="{site_obj.getLinkPage(3823)}" class="big" style="padding-left: 244px;width: 100px;">Эксперт</a>
		<div class="ekspert-block">
			<div class="left_baner">
				/*БАНЕР*/
				[[if baner16]]
				<div style="height: 169px;">
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
			</div>
			<div class="center_ekspert">
				[[for ekspert in items_ekspert]]
					<div class="item[[if not loop.first]] fl_left[[endif]]">
						<a href="{ekspert.full_url}">
							[[if ekspert.expert.picture]]
								<img alt="{ekspert.caption}" src="/images/users/{ekspert.expert.id_user}/112_169_{ekspert.expert.picture}" class="floatleft">
							[[elseif ekspert.picture]]
								<img alt="{ekspert.caption}" src="/{site_obj.fileDirectory}{ekspert.id}/112_169_{ekspert.picture}" class="floatleft">
							[[endif]]
						</a>					
						<p>
							<a href="{ekspert.full_url}">[[if ekspert.expert.name]]{ekspert.expert.name}.<br/>[[endif]] {ekspert.caption}</a> 
						</p>
						<div style="clear:both;"></div>
					</div>
				[[endfor]]
			</div>
			<div class="right_baner">
				/*БАНЕР*/
				[[if baner17]]
				<div style="height: 169px;">
					[[if baner17.url]]
						<noindex>
						<a rel="nofollow" target="_blank" href="{baner16.url}">
							{baner_obj.showBanerId(baner17.id,baner17.picture,baner17.format)|raw}
						</a>
						</noindex>
					[[else]]
						{baner_obj.showBanerId(baner17.id,baner17.picture,baner17.format)|raw}
					[[endif]]
				</div>
				[[endif]]
				/*БАНЕР*/
			</div>
		</div>
		<div style="clear:both;height: 20px;"></div>
		
		
		<div class="left-half">
			[[ include TEMPLATE_PATH ~ "meets/main_block.tpl"]]
		</div>
		<div class="right-half">
			[[ include TEMPLATE_PATH ~ "places/main_block.tpl"]]
		</div>
		
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
		
		<div class="left-half">
			<a href="{site_obj.getLinkPage(1238)}?form=add_manual">
				<button type="submit" class="button floatright">
					<span class="button-left">
						<span class="button-right">
							<span class="button-text">
								<span>Добавить компанию</span>
							</span>
						</span>
					</span>
				</button>
			</a>
			<a class="big" href="{site_obj.getLinkPage(1238)}">Справочник</a>
			<div class="leftside">
				[[for item in items_manual_main]]
					[[if loop.index%6 == 0]]
						</div>
						<div class="rightside">
						/*БАНЕР*/
						[[if baner3]]
							<p style="width: 201px;height: 175px;">
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
					[[endif]]
					<div class="block item mrg0">
						<div class="blockiteminfo" style="min-height: 100px;overflow: hidden;height:134px;">
							<a href="{item.full_url}">{item.caption}</a><br/>
							{item.info}
						</div>
					</div>
				[[endfor]]
			</div>
			<div style="clear:both;"></div>
			<br />
			/*
			<a class="big" href="/nedvizhimost/">Наши партнеры</a>
			<a href=""><img src="/images/partner.jpg" /></a><a href=""><img src="/images/partner.jpg" /></a><a href=""><img src="/images/partner.jpg" /></a>
			*/
		</div>
		
		<div class="right-half">
			
			[[if items_immovable_main]]
				<a href="{site_obj.getLinkPage(1291)}?form=add_immovable">
					<button type="submit" class="button floatright">
						<span class="button-left">
							<span class="button-right">
								<span class="button-text">
									<span>Добавить недвижимость</span>
								</span>
							</span>
						</span>
					</button>
				</a>
				<a href="{site_obj.getLinkPage(1291)}" class="big">Недвижимость</a>
				
				<div class="rightblock">
					<div class="leftside">
						[[for item in items_immovable_main]]
							[[if loop.index%4==0]]
								</div>
								<div class="rightside">
							[[endif]]
							<div class="block item mrg0">
								<div class="blockiteminfo">
									<a href="{item.full_url}">{item.addres} , комнат: {item.count_room}</a>
									[[if item.price]]<span class="price">{item.price} руб.</span>[[endif]]
								</div>
							</div>
						[[endfor]]
					</div>
					<div style="clear:both;"></div>
				</div>
			[[endif]]
			
			/*БАНЕР*/
			[[if baner4]]
				[[if baner4.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner4.url}">
						{baner_obj.showBanerId(baner4.id,baner4.picture,baner4.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner4.id,baner4.picture,baner4.format)|raw}
				[[endif]]
			[[endif]]
			/*БАНЕР*/
			
			<br/><br/>
						
			<a href="{site_obj.getLinkPage(796)}?form=add_advert">
				<button type="submit" class="button floatright">
					<span class="button-left">
						<span class="button-right">
							<span class="button-text">
								<span>Добавить объявление</span>
							</span>
						</span>
					</span>
				</button>
			</a>
			<a href="{site_obj.getLinkPage(796)}" class="big">Объявления</a>
			<div class="rightblock">
				<div class="leftside">
					[[for item in items_advert_main]]
						[[if loop.index%4==0]]
							</div>
							<div class="rightside">
						[[endif]]
						<div class="block item mrg0">
							<div class="name">[[if item.type_advert==0]]Продажа[[elseif item.type_advert == 1]]Покупаю[[elseif item.type_advert == 2]]Аренда[[else]]Услуги[[endif]]</div>
							<div class="blockiteminfo">
								<a href="{item.full_url}">{item.caption}</a>
								[[if item.price]]<span class="price">{item.price}</span>[[endif]]
							</div>
						</div>
					[[endfor]]
				</div>
				<div style="clear:both;"></div>
			</div>
			[[endblock]] 
		</div>
		[[if modul.id == 1]]
		<div style="clear:both;"></div>
		<a name="questionform"></a>
		<div class="rightblock context">
			[[for key,interv_item in interview]]
				<div class="block item ">
					<div class="question">
						<div class="name">
							<b>{interv_item.caption}</b>
						</div>
						[[if vopros[key]]]
						<div class="text">
							<form action="#questionform" method="post" id="QuestionFormRight{interv_item.id}">
								<input type="hidden" name="action" value="interview_right" />
								<input type="hidden" name="interview_id" value="{interv_item.id}" />
								[[for vopr in vopros[key] ]]
									[[if iscookie[key] ]]
										[[if vopr.url]]
											<p><label><span><a href="{vopr.url}">{vopr.caption}</a> - {vopr.stat}</span></label></p>
										[[else]]
											<p><label><span>{vopr.caption} - {vopr.stat}</span></label></p>
										[[endif]]
									[[else]]
										[[if vopr.url]]
											<p><label><input type="radio" name="response" value="{vopr.id}" />&nbsp;&nbsp;<span><a href="{vopr.url}">{vopr.caption}</a></span></label></p>
										[[else]]
											<p><label><input type="radio" name="response" value="{vopr.id}" />&nbsp;&nbsp;<span>{vopr.caption}</span></label></p>
										[[endif]]
									[[endif]]
								[[endfor]]
								[[if not iscookie[key]]]
									/*<div class="button">
										<a href="javascript: void(document.getElementById('QuestionFormRight{interv_item.id}').submit());" >Отправить</a>
									</div>*/
									<br/>
									<button class="button" type="submit">
										<span class="button-left">
											<span class="button-right">
												<span class="button-text">
													<span>Отправить</span>
												</span>
											</span>
										</span>
									</button>
								[[endif]]
							</form>
						</div>
						[[else]]
							нет вопросов
						[[endif]]
					</div>
				</div>
			[[endfor]]
			<div style="clear:both;height:13px;"></div>
		</div>
		[[endif]]
		<div style="clear:both;"></div>
		[[if configs.text_reklama and modul.id == 1]]
			<div class="rightblock context">
				{configs.text_reklama|raw}
				/*<div class="block item ">
					<div class="blockiteminfo">
						<a href="#">Кухни с гарантией 5 лет!</a><br/>
						Современные, качественные и красивые Итальянские кухни
					</div>
				</div>
				<div class="block item ">
					<div class="blockiteminfo">
						<a href="#">Кухни с гарантией 5 лет!</a><br/>
						Современные, качественные и красивые Итальянские кухни
					</div>
				</div>
				<div class="block item ">
					<div class="blockiteminfo">
						<a href="#">Кухни с гарантией 5 лет!</a><br/>
						Современные, качественные и красивые Итальянские кухни
					</div>
				</div>*/
				<div style="clear:both;height:13px;"></div>
				
			</div>
		[[endif]]
		[[endblock]]
		<div style="clear:both;"></div>
	</div>
	<div id="footer">
		{configs.footer|raw}
		<div style="clear:both;"></div>
		<div class="copy-text">
			Copyright © Энгельс bz - городской портал - свидетельство о регистрации ЭЛ№ФС77-52410<br/>
			Свидетельство выдано 28 декабря 2012 года Федеральной службой по надзору за соблюдением законодательства в сфере массовых коммуникаций и охране культурного наследия.
			При использовании материалов сайта - гиперссылка обязательна | Замечания и предложения направляйте по адресу <a href="mailto: info@engels.bz">info@engels.bz</a>
		</div>
	</div>
</div>
<div class="fullwidthbottom">
	<div id="afterfooter">
		[[if configs.link_fb]]
			<div class="soc fb">
				<a href="{configs.link_fb}" target="_blank" class="s">Facebook</a>
			</div>
		[[endif]]
		[[if configs.link_tw]]
		<div class="soc tw">
			<a href="{configs.link_tw}"  target="_blank" class="s">Twitter</a>
		</div>
		[[endif]]
		[[if configs.link_vk]]
		<div class="soc vk">
			<a href="{configs.link_vk}"  target="_blank" class="s">Vkontakte</a>
		</div>
		[[endif]]
		[[if configs.link_ya]]
		<div class="soc yawidget">
			<a href="{configs.link_ya}"  target="_blank" class="s">Yandex</a>
		</div>
		[[endif]]
		<div class="counter">
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
			</div>
			<div class="counter">
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
		<div class="by">
			<a href="http://engels.bz/reklama/" class="s">Реклама на сайте</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://future-group.ru" target="_blank" class="s">Создание сайтов</a><span> - Future</span>
		</div>
	</div>
</div>
[[ include TEMPLATE_PATH ~ "blocks/popup.tpl"]]
<div style="display:none;">
	{generate_page}
</div>

[[block include_block]]

[[endblock]]

</body>
</html>