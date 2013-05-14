[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	
	<div class="new_news">
		<div id="item_news">
			<div id="item_new">
				/*<h1>{item.caption}</h1>*/
				[[if item.picture]]
					<div class="img">
						[[if item.caption]]
							<div class="caption_top">
								<h1>{item.caption}</h1>
							</div>
						[[endif]]
						/*<div class="avtor_foto">Фото: Черекаев </div>*/
						[[if item.dop_params.anons]]
							<div class="annotation">
								<div>{item.dop_params.anons|raw}</div>
							</div>
						[[endif]]
						<img src="/{site_obj.isFile(item.id, 744)}" alt="" />
					</div>
					[[else]]
						<h1>{item.caption}</h1>
				[[endif]]

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
			/*БАНЕР new*/
				<div class="cl"></div>
				<p style="width: 740px;">
					{baner_obj.showBanerType(10,request_uri)|raw}
				</p>
			/*БАНЕР new*/
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
			<div class="my_new_afish">
				<h1>
					Места
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
				<div class="item">
					<h1>Справочник</h1>
					<div class="cl"></div>
					<div class="block lt">
						<div class="caption"><a href="">Кафель Никовъ</a></div>
						<div class="cl"></div>
						<div class="text">Керамическая плитка, керамогранит ,мозайка, искуствеый камень, тротуарная</div>
					</div>
					<div class="block">
						<div class="caption"><a href="">Кафель Никовъ</a></div>
						<div class="cl"></div>
						<div class="text">Керамическая плитка, керамогранит ,мозайка, искуствеый камень, тротуарная</div>
					</div>
					<div class="block">
						<div class="caption"><a href="">Кафель Никовъ</a></div>
						<div class="cl"></div>
						<div class="text">Керамическая плитка, керамогранит ,мозайка, искуствеый камень, тротуарная</div>
					</div>
					<div class="block lt">
						<div class="caption"><a href="">Кафель Никовъ</a></div>
						<div class="cl"></div>
						<div class="text">Керамическая плитка, керамогранит ,мозайка, искуствеый камень, тротуарная</div>
					</div>
					<div class="block">
						<div class="caption"><a href="">Кафель Никовъ</a></div>
						<div class="cl"></div>
						<div class="text">Керамическая плитка, керамогранит ,мозайка, искуствеый камень, тротуарная</div>
					</div>
					<div class="block">
						<div class="caption"><a href="">Кафель Никовъ</a></div>
						<div class="cl"></div>
						<div class="text">Керамическая плитка, керамогранит ,мозайка, искуствеый камень, тротуарная</div>
					</div>
					<div class="cl"></div>
				</div>
				<div class="item">
					<h1>Объявления</h1>
					<div class="cl"></div>
				</div>
			</div>


[[endblock]]

[[block include_block]]
	/*[[ include TEMPLATE_PATH ~ "blocks/nnn_block_include.tpl"]]*/
	[[ include TEMPLATE_PATH ~ "blocks/marketgid_block_include.tpl"]]
[[endblock]]
