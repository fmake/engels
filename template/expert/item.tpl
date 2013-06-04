[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption}</h1>
		<div class="story">
			[[if item.expert.picture]]
				<img alt="" src="/images/users/{item.expert.id_user}/225_300_{item.expert.picture}" align="left" style="float:left;" />
			[[elseif item.picture]]
				<img alt="" src="/{site_obj.fileDirectory}{item.id}/406__{item.picture}" align="left" widht="225" style="float:left;" />
			[[endif]] 
			[[if item.dop_params.date]]<p class="date">Дата добавления: {df('date','d.m.Y H:i',item.dop_params.date)}</p>[[endif]]
			<p class="autor">Эксперт : 
				[[if item.expert.name]]
					{item.expert.name}
				[[elseif item.expert.name_social]]
					{item.expert.name_social}
				[[else]]
					{item.expert.login}
				[[endif]]
			</p>
			{item.text|raw}
		</div>
		
		<div style="margin-bottom:20px;">
			[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
		</div>
		
		[[set id_expert = item.dop_params.id_user]]
		[[ include TEMPLATE_PATH ~ "comments/expert/main.tpl"]]
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