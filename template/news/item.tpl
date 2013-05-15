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
							<div class="cl"></div>
							<table class="table1">
								<tr>
									<td class="t1">ТЕКС</td>
									<td class="t2">
										<a href="#">Коментарии(12)</a>
									</td>
									<td class="t3">Всего читали 1</td>
									<td class="t3">Читают сейчас 10</td>
								</tr>
							</table>
							<div class="line">
								<img src="/images/tmp/tria.png" alt="" /></div>	
							<div class="cl"></div>
						[[endif]]
						<img src="/{site_obj.isFile(item.id, 744)}" alt="" width="444"/>
					</div>
					[[else]]
						<h1>{item.caption}</h1>
				[[endif]]
				<!-- NEW FUNCTIONAL -->
				<div class="psevdo">
					<div class="s_b_n">
						<a class="al_bt"></a>
						<a class="al_bt"></a>
						<a class="al_bt"></a>
						<a class="al_bt"></a>
					</div>
					<h1>Лента</h1>
					<div class="arrow_new">
						<a href="#">Все новости</a>
					</div>
					<div class="cl"></div>
					<div class="pre_item">
						<div class="item">
							<div class="load_content_news">
								<div class="caption">Пропал Парк Джи СУнг</div>
								<div class="cl"></div>
								<img src="/images/tmp/1.gif" width="100" height="100" />
								<div class="text">км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя </div>
							</div>
							<div class="time">
								14:15
							</div>
							<div class="icons">
								<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="У этой статьи есть Фото"/></a>
								<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="У этой статьи есть Видео"/></a>
								<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
							</div>
							<div class="cl"></div>
							<div class="note">
								<a href=""><span class="title">Здоровье</span></a>
								<a href="" class="show_this_news">В Энгельсе 17% супружеских пар не могут иметь детей</a>
								<span class="comments">[2]</span>
							</div>
						</div>
					</div>
					<div class="cl"></div>
					<div class="cl"></div>
					<div class="pre_item">
						<div class="item">
							<div class="load_content_news">
								<div class="caption">Пропал Парк Джи СУнг</div>
								<div class="cl"></div>
								<img src="/images/tmp/1.gif" width="100" height="100" />
								<div class="text">км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя </div>
							</div>
							<div class="time">
								14:15
							</div>
							<div class="icons">
								<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="У этой статьи есть Фото"/></a>
								<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="У этой статьи есть Видео"/></a>
								<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
							</div>
							<div class="cl"></div>
							<div class="note">
								<a href=""><span class="title">Здоровье</span></a>
								<a href="" class="show_this_news">В Энгельсе 17% супружеских пар не могут иметь детей</a>
								<span class="comments">[2]</span>
							</div>
						</div>
					</div>
					<div class="cl"></div>
					<div class="cl"></div>
					<div class="pre_item">
						<div class="item">
							<div class="load_content_news">
								<div class="caption">Пропал Парк Джи СУнг</div>
								<div class="cl"></div>
								<img src="/images/tmp/1.gif" width="100" height="100" />
								<div class="text">км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя </div>
							</div>
							<div class="time">
								14:15
							</div>
							<div class="icons">
								<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="У этой статьи есть Фото"/></a>
								<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="У этой статьи есть Видео"/></a>
								<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
							</div>
							<div class="cl"></div>
							<div class="note">
								<a href=""><span class="title">Здоровье</span></a>
								<a href="" class="show_this_news">В Энгельсе 17% супружеских пар не могут иметь детей</a>
								<span class="comments">[2]</span>
							</div>
						</div>
					</div>
					<div class="cl"></div>
					<div class="cl"></div>
					<div class="pre_item">
						<div class="item">
							<div class="load_content_news">
								<div class="caption">Пропал Парк Джи СУнг</div>
								<div class="cl"></div>
								<img src="/images/tmp/1.gif" width="100" height="100" />
								<div class="text">км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя </div>
							</div>
							<div class="time">
								14:15
							</div>
							<div class="icons">
								<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="У этой статьи есть Фото"/></a>
								<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="У этой статьи есть Видео"/></a>
								<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
							</div>
							<div class="cl"></div>
							<div class="note">
								<a href=""><span class="title">Здоровье</span></a>
								<a href="" class="show_this_news">В Энгельсе 17% супружеских пар не могут иметь детей</a>
								<span class="comments">[2]</span>
							</div>
						</div>
					</div>
					<div class="cl"></div>
					<div class="cl"></div>
					<div class="pre_item">
						<div class="item">
							<div class="load_content_news">
								<div class="caption">Пропал Парк Джи СУнг</div>
								<div class="cl"></div>
								<img src="/images/tmp/1.gif" width="100" height="100" />
								<div class="text">км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя </div>
							</div>
							<div class="time">
								14:15
							</div>
							<div class="icons">
								<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="У этой статьи есть Фото"/></a>
								<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="У этой статьи есть Видео"/></a>
								<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
							</div>
							<div class="cl"></div>
							<div class="note">
								<a href=""><span class="title">Здоровье</span></a>
								<a href="" class="show_this_news">В Энгельсе 17% супружеских пар не могут иметь детей</a>
								<span class="comments">[2]</span>
							</div>
						</div>
					</div>
					<div class="cl"></div>
					<div class="cl"></div>
					<div class="pre_item">
						<div class="item">
							<div class="load_content_news">
								<div class="caption">Пропал Парк Джи СУнг</div>
								<div class="cl"></div>
								<img src="/images/tmp/1.gif" width="100" height="100" />
								<div class="text">км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя </div>
							</div>
							<div class="time">
								14:15
							</div>
							<div class="icons">
								<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="У этой статьи есть Фото"/></a>
								<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="У этой статьи есть Видео"/></a>
								<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
							</div>
							<div class="cl"></div>
							<div class="note">
								<a href=""><span class="title">Здоровье</span></a>
								<a href="" class="show_this_news">В Энгельсе 17% супружеских пар не могут иметь детей</a>
								<span class="comments">[2]</span>
							</div>
						</div>
					</div>
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
							[[for item in exp]]
								[[if item.text_expert]]
									<div class="quot" id="quot{item.id}">
										[[if item.expert_picture]]
											<img src="/{site_obj.fileDirectory}{item.id_news}/expert/{item.id}/133_201{item.expert_picture}" alt="{item.expert}" height="150" />
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
	
	<div class="cl"></div>
<div class="smarty_block">
	<div class="partner_block">
		<h1>Новости партнеров</h1>
		<ul>
			<li>
				<img src="/images/tmp/1.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
			<li>
				<img src="/images/tmp/1.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
			<li>
				<img src="/images/tmp/1.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
			<li>
				<img src="/images/tmp/1.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
			<li>
				<img src="/images/tmp/1.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
		</ul>
	</div>
	<div class="cl"></div>

	<div class="recomend">
		<h1>Рекомендуем</h1>
		<div class="cl"></div>
		<ul>
			<li>
				<img src="/images/tmp/2.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
			<li>
				<img src="/images/tmp/2.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
			<li>
				<img src="/images/tmp/2.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
			<li>
				<img src="/images/tmp/2.png" alt="" />
				<div class="cl"></div>
				<div class="caption"><a href="#">Выставка живописи Сергея Сакова</a></div>
				<div class="cl"></div>
				<div class="text">И хотя ученые уверяют, что он не заденет планету и пролетит на безопасном </div>
			</li>
		</ul>
		<div class="cl"></div>
	</div>
</div>
<div class="cl"></div>
<div class="say_out">
	<h1>Что говорят</h1>
	<div class="cl"></div>
	<div class="item">
		<div class="block_1">
			<button class="say_out_button"><span><span><span>Мнения</span></span></span></button>
			<div class="cl"></div>
			<div class="img ml0">
				<img src="/images/tmp/3.png" alt="" />
				<div class="title">
					<a href="#">Задай вопрос психологу</a>
				</div>				
			</div>
			<div class="img">
				<img src="/images/tmp/3.png" alt="" />
				<div class="title">
					<a href="#">Задай вопрос психологу</a>
				</div>				
			</div>
		</div>	
		<div class="block_2">
			<div class="link"><a href="">Еще мнения</a></div>
			<ul>
				<li>
					<a href="#">
						"Тренерская работа - мне хобби"
					</a>
				</li>
				<li>
					<a href="#">
						"Тренерская работа - мне хобби"
					</a>
				</li>
				<li>
					<a href="#">
						"Тренерская работа - мне хобби"
					</a>
				</li>
				<li>
					<a href="#">  
						"Тренерская работа - мне хобби"
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="item">
		<div class="block_1">
			<button class="say_out_button"><span><span><span>Гости</span></span></span></button>
			<div class="cl"></div>
			<div class="img ml0">
				<img src="/images/tmp/3.png" alt="" />
				<div class="title">
					<a href="#">Задай вопрос психологу</a>
				</div>				
			</div>
			<div class="img">
				<img src="/images/tmp/3.png" alt="" />
				<div class="title">
					<a href="#">Задай вопрос психологу</a>
				</div>				
			</div>
		</div>	
		<div class="block_2">
			<div class="link"><a href="">Другие гости</a></div>
			<ul>
				<li>
					<a href="#">
						"Тренерская работа - мне хобби"
					</a>
				</li>
				<li>
					<a href="#">
						"Тренерская работа - мне хобби"
					</a>
				</li>
				<li>
					<a href="#">
						"Тренерская работа - мне хобби"
					</a>
				</li>
				<li>
					<a href="#">  
						"Тренерская работа - мне хобби"
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
</div>
</div>
<div id="journal">
		<div class="shadow_img top"></div>
		<div class="page-container">
			<div class="my_new_afish">
				<h1>
					Афиша
				</h1>
				<div class="img1">
					<img src="/images/tmp/4.png" alt="#" />
					<div class="cl"></div>
					<div class="caption"><a href="#">Отрицание пространства</a></div>
				</div>
				<div class="img2">
					<div class="grid">
						<div class="item_block lt">
							<a href=""><img src="/images/tmp/5.png" alt="" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="">Отрицание пространства</a></div>
						</div>
						<div class="item_block">
							<a href=""><img src="/images/tmp/5.png" alt="" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="">Отрицание пространства</a></div>
						</div>
						<div class="item_block">
							<a href=""><img src="/images/tmp/5.png" alt="" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="">Отрицание пространства</a></div>
						</div>
						<div class="cl"></div>
						<div class="item_block lt">
							<a href=""><img src="/images/tmp/5.png" alt="" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="">Отрицание пространства</a></div>
						</div>
						<div class="item_block">
							<a href=""><img src="/images/tmp/5.png" alt="" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="">Отрицание пространства</a></div>
						</div>
						<div class="item_block">
							<a href=""><img src="/images/tmp/5.png" alt="" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="">Отрицание пространства</a></div>
						</div>
						<div class="cl"></div>
					</div>
				</div>
				<div class="ap">
					<!--РЕКЛАМА -->
				</div>
				<div class="cl"></div>	
			</div>
			<!--МЕСТА-->
			<div class="my_new_afish">
				<a href="{site_obj.getLinkPage(5)}" class="h1">
				    <h1>Места</h1>
				</a>
    			[[for item in items_place_main2]]
	    			[[if loop.index == 1]]
						<div class="img1">
							<a href="{item.full_url}"><img src="/{site_obj.isFile(item.id, 244, 249)}" alt="{item.title}" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
						</div>
						<div class="img2">
							<div class="grid">
					[[else]]
							<div class="item_block [[if loop.index == 2 or loop.index == 5]]lt[[endif]]">
								<a href="{item.full_url}"><img src="/{site_obj.fileDirectory}{item.id}/140_100_{item.picture}" width="140" height="100" alt="{item.title}"/></a>
								<div class="cl"></div>
								<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
							</div>
						[[if loop.index == 4]]<div class="cl"></div>[[endif]]
					[[endif]]
				[[endfor]]
						<div class="cl"></div>
					</div>
				</div>
				<div class="ap">
					<!--РЕКЛАМА -->
				</div>
				<div class="cl"></div>	
			</div>
			<!--МЕСТА-->
		</div>
		<div class="shadow">
			<div class="shadow_img"></div>
		</div>
	</div>
<div class="kenta">
	<div class="page-container">
		<h1>Фоторепортажи</h1>
			<div class="item">
				<div class="hidden_item" style="width: 171px;">
					<div class="hidden_link">
						<div class="time">22.03.2013</div>
						<div class="icons"><a href=""><img src="/images/bg/fotocamera.png" alt="" title="Фото">20</a></div>
						<div class="cl"></div>
						<a href="" class="d-l">ПЧ-27 приняла участие в пожарно-тактических учениях</a>
					</div>
					<a href=""><img src="/images/tmp/1.gif" alt="" width="171px" height="154px"></a>
				</div>
				<div class="hidden_item" style="width: 171px;">
					<div class="hidden_link">
						<div class="time">22.03.2013</div>
						<div class="icons"><a href=""><img src="/images/bg/fotocamera.png" alt="" title="Фото">20</a></div>
						<div class="cl"></div>
						<a href="" class="d-l">ПЧ-27 приняла участие в пожарно-тактических учениях</a>
					</div>
					<a href=""><img src="/images/tmp/1.gif" alt="" width="171px" height="154px"></a>
				</div>
				<div class="hidden_item" style="width: 171px;">
					<div class="hidden_link">
						<div class="time">22.03.2013</div>
						<div class="icons"><a href=""><img src="/images/bg/fotocamera.png" alt="" title="Фото">20</a></div>
						<div class="cl"></div>
						<a href="" class="d-l">ПЧ-27 приняла участие в пожарно-тактических учениях</a>
					</div>
					<a href=""><img src="/images/tmp/1.gif" alt="" width="171px" height="154px"></a>
				</div>
				<div class="hidden_item" style="width: 171px;">
					<div class="hidden_link">
						<div class="time">22.03.2013</div>
						<div class="icons"><a href=""><img src="/images/bg/fotocamera.png" alt="" title="Фото">20</a></div>
						<div class="cl"></div>
						<a href="" class="d-l">ПЧ-27 приняла участие в пожарно-тактических учениях</a>
					</div>
					<a href=""><img src="/images/tmp/1.gif" alt="" width="171px" height="154px"></a>
				</div>
				<div class="hidden_item" style="width: 171px;">
					<div class="hidden_link">
						<div class="time">22.03.2013</div>
						<div class="icons"><a href=""><img src="/images/bg/fotocamera.png" alt="" title="Фото">20</a></div>
						<div class="cl"></div>
						<a href="" class="d-l">ПЧ-27 приняла участие в пожарно-тактических учениях</a>
					</div>
					<a href=""><img src="/images/tmp/1.gif" alt="" width="171px" height="154px"></a>
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
			<div class="ap_bl"></div>
			<div class="cl"></div>
			<div class="ttl"></div>


[[endblock]]

[[block include_block]]
	/*[[ include TEMPLATE_PATH ~ "blocks/nnn_block_include.tpl"]]*/
	[[ include TEMPLATE_PATH ~ "blocks/marketgid_block_include.tpl"]]
[[endblock]]
