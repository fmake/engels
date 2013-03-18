/*<div id="right_news">
	<div class="right_item_news">
		<h1>Новости по теме</h1>
		<div class="news">
			[[for item in news_right_block]]	
				
					<div class="item">
						<div class="time">{df('date','H:i',item.date)}</div>
						<div class="icons"></div>
						<div class="cl"></div>
						<div class="note">
							[[if item.name_category]]<span class="title">{item.name_category}:</span>[[endif]]
							<a href="{item.full_url}">{item.caption}</a>
							[[if item.comment]]<span class="comments">[{item.comment}]</span>[[endif]]
						</div>
					</div>
				[[endif]]
			[[endfor]]
		 </div>
	</div>
</div>
<div class="cl"></div>
*/
<div id="right_news">
	<div class="right_item_news">
		<h1>Новости по теме</h1>
		<div class="news">
			[[for item in news_right_block]]
				[[if loop.index < 4 ]]
					<div class="item">
						<div class="time">{df('date','H:i',item.date)}</div>
						<div class="icons"></div>
						<div class="cl"></div>
						<div class="note">
							[[if item.name_category]]<span class="title">{item.name_category}:</span>[[endif]]
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
	
	[[if baner5 or baner6]]
		<br />
		/*БАНЕР*/
		[[if baner5]]
		<div>
			<p>
				[[if baner5.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner5.url}">
						{baner_obj.showBanerId(baner5.id,baner5.picture,baner5.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner5.id,baner5.picture,baner5.format)|raw}
				[[endif]]
			</p>
		</div>
		[[endif]]
		/*БАНЕР*/
		/*БАНЕР*/
		[[if baner6]]
		<div>
			<p>
				[[if baner6.url]]
					<noindex>
					<a rel="nofollow" target="_blank" href="{baner6.url}">
						{baner_obj.showBanerId(baner6.id,baner6.picture,baner6.format)|raw}
					</a>
					</noindex>
				[[else]]
					{baner_obj.showBanerId(baner6.id,baner6.picture,baner6.format)|raw}
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
</div>
<div class="cl"></div>