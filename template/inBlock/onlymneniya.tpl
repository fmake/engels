<div class="say_out">
	<h1>Что говорят</h1>
	<div class="cl"></div>
	<div class="item">
		<div class="block_1" style="padding-top: 31px">
			<div class="cl"></div>
			[[for ekspert in items_news_exp]]
				<div class="img [[if loop.index == 1]]ml0[[endif]]">
					<a href="{site_obj.getLinkPage(ekspert.id_news)}#quot{ekspert.id}">
						[[if ekspert.expert_picture]]
							<img width = "133" alt="{ekspert.caption}" src="/{site_obj.isFile(ekspert.id_news, 136, 149)}" />
						[[endif]]
					</a>						
					<div class="title">
						<a href="{site_obj.getLinkPage(ekspert.id_news)}#quot{ekspert.id}">{ekspert.caption}</a>
					</div>				
				</div>
			[[endfor]]
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
</div>
</div>