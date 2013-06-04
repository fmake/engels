[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
    <div id="item_news">
		<h1>{item.caption}</h1>
		<div class="story">
			[[if item.picture]]<img alt="" width="406" src="http://engels.bz/{advert_obj.fileDirectory}{item.id}/406__{item.picture}" align="left" style="float:left;">[[endif]]
			<p class="date">Дата добавления: {df('date','d.m.Y',item.dop_params.date)}</p>
			<div>
				<ul>
					<li><strong>Тип объявления:</strong> [[if item.dop_params.type_advert == 0]]Продаю[[elseif item.dop_params.type_advert == 1]]Покупаю[[elseif item.dop_params.type_advert == 2]]Аренда[[else]]Услуги[[endif]]</li>
					[[if item.dop_params.price]]<li><strong>Цена:</strong> {item.dop_params.price}</li>[[endif]]
					[[if item.dop_params.name_user]]<li><strong>Контактное лицо:</strong> {item.dop_params.name_user}</li>[[endif]]
					[[if item.dop_params.email]]<li><strong>Email:</strong> {item.dop_params.email}</li>[[endif]]
					[[if item.dop_params.phone]]<li><strong>Телефон:</strong> {item.dop_params.phone}</li>[[endif]]
				</ul>
			</div>
			<br/>
			<strong>Объявление:</strong></br>
			{item.text|raw}
		</div>
		<div style="margin-bottom:20px;">
			[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
		</div>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "advert/right_block_baner.tpl"]]
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