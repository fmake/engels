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
		<h1>Фоторепортажи</h1>
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
	
	[[if baner7 or baner8]]
		<br />
		/*БАНЕР*/
		[[if baner9]]
		<div>
			<p>
				[[if baner9.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner9.url}">
						{baner_obj.showBanerId(baner9.id,baner9.picture,baner9.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner9.id,baner9.picture,baner9.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		/*БАНЕР*/
		[[if baner10]]
		<div>
			<p>
				[[if baner10.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner10.url}">
						{baner_obj.showBanerId(baner10.id,baner10.picture,baner10.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner10.id,baner10.picture,baner10.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
	[[endif]]
	<div class="right_item_news">
		<h1>Объявления</h1>
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
		<h1>Места</h1>
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
</div>