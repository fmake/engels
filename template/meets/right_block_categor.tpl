<div id="right_news">
	<div class="right_item_news">
		<h1>Другие новости</h1>
		<div class="news">
			[[for item in news_right_block]]
				[[if loop.index < 4 ]]
					<div class="item">
						<div class="time">{df('date','H:i',item.date)}</div>
						<div class="icons"></div>
						<div class="cl"></div>
						<div class="note">
							[[if item.name_category]]<a href="{news_obj.getLinkPage(item.parent)}"><span class="title">{item.name_category}:</span></a>[[endif]]
							<a href="{item.full_url}">{item.caption}</a>
							[[if item.comment]]<span class="comments">[{item.comment}]</span>[[endif]]
						</div>
					</div>
				[[endif]]
			[[endfor]]
		 </div>
	</div>
	<div class="right_item_news">
		<a href = "{site_obj.getLinkPage(9)}" class = "h1">
			<h1>Фоторепортажи</h1>
		</a>
		[[for report in items_photo]]
			<div class="item">
				<div class="hidden_item" style="width: 200px;">
					<div class="hidden_link">
						<div class="time">{df('date','d.m.Y',report.date)}</div>
						<div class="icons"><a href="{report.full_url}"><img src="/images/bg/fotocamera.png" alt="" title="Фото" />{gallery_obj.getCountPhoto(report.id)}</a></div>
						<div class="cl"></div>
						<a href="{report.full_url}" class="d-l">{report.caption}</a>
					</div>
					<a href="{report.full_url}"><img src="/{photo_obj.fileDirectory}{report.id}/200_160_{report.picture}" alt="" width = "200px" height="154px" /></a>
				</div>
			</div>
		[[endfor]]
		
	</div>
	
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
	
	<div class="right_item_news">
		<a href = "{site_obj.getLinkPage(796)}" class = "h1">
			<h1>Объявления</h1>
		</a>
		<div class="tasks">
			<div class="desk">
				<div class="page-container">
					[[for item in items_advert_main]]
						<div class="item">
							<div class="title">[[if item.type_advert==0]]Продажа[[elseif item.type_advert == 1]]Покупаю[[elseif item.type_advert == 2]]Аренда[[else]]Услуги[[endif]]</div>
							<a href="{item.full_url}">{item.caption}</a>[[if item.price]]<span>{item.price}</span>[[endif]]
						</div>
					[[endfor]]
				</div>
			</div>
		</div>
	</div>
	<div class="right_item_news">
		<a href = "{site_obj.getLinkPage(5)}" class = "h1">
			<h1>Места</h1>
		</a>
		<div class="place">
			[[for item in items_place_main]]
				<div class="item">
					[[if item.picture]]
					<a href="{item.full_url}">
						<img src="/{site_obj.fileDirectory}{item.id}/140_100_{item.picture}" width="140" height="100" alt="{item.title}"/>
					</a>
					[[endif]]
				   <a href="{item.full_url}"class="h30px">{item.caption}</a>
				</div>
			[[endfor]]
		</div>
	</div>
	<div class="right_item_news">
	<!-- ГОЛОСОВАНИЕ START -->
		<div id="votes">
			<a href = "{site_obj.getLinkPage(7030)}" class = "h1">
				<h1>Голосование</h1>
			</a>
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
</div>