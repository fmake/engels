[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption}</h1>
		<div class="story">
			{item.text|raw}
		</div>
		
		[[set tags = item.tags]]
		[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
		
		<div class="imglist fotoimg">
			[[for photo in photos]]
				[[if loop.index0>=gap.to and loop.index0<=gap.from]]
					<a href="/images/galleries/{photo.id_catalog}/1024_{photo.image}" class="show" idrel="{photo.id}" title="{photo.title}">
						<img src="/images/galleries/{photo.id_catalog}/thumbs/{photo.image}" alt="" />
					</a>
				[[else]]
					<a href="/images/galleries/{photo.id_catalog}/1024_{photo.image}" class="show" title="{photo.title}" idrel="{photo.id}" ></a>
				[[endif]]
			[[endfor]]
			<div style="clear:both;"></div>
			[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
			
			<div style="margin-bottom:20px;">
				[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
			</div>
			
			[[ include TEMPLATE_PATH ~ "comments/main.tpl"]]
			<div style="clear:both;"></div>
		</div>
	</div>
	[[if dojs_foto]]
		<script type="text/javascript">
			[[raw]]
			$(document).ready(function(){
				$(".show[idrel=[[endraw]]{dojs_foto}][[raw]]").click()
			});
			[[endraw]]
		</script>
	[[endif]]
[[endblock]]

[[block right]]
	/*[[ include TEMPLATE_PATH ~ "photoreports/right_block_baner.tpl"]]*/
	[[ include TEMPLATE_PATH ~ "photoreports/new.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/recommend_news.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/what_say.tpl"]]
	[[ include TEMPLATE_PATH ~ "inBlock/journal.tpl"]]
<div class="kenta">
	<div class="page-container">
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