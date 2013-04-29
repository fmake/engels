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
	[[ include TEMPLATE_PATH ~ "photoreports/right_block_baner.tpl"]]
[[endblock]]