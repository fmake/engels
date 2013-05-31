<div class="say_out">
	<h1>Что говорят</h1>
	<div class="cl"></div>
	<div class="item">
		<div class="block_1" style="padding-top: 31px">
			<div class="cl"></div>
			[[for ekspert in items_news_exp]]
				[[if loop.index == 1 or loop.index == 2]]
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
				[[endif]]
				[[if loop.index == 2]]
			</div>	
		<div class="block_2" style="padding-top: 31px">
			<ul>
				[[endif]]
				[[if loop.index > 2]]
				<li>
					<a href="{site_obj.getLinkPage(ekspert.id_news)}#quot{ekspert.id}">{ekspert.caption}</a>
				</li>
				[[endif]]
			[[endfor]]
			</ul>
		</div>
	</div>
	<div class="item">
		<div class="block_1">
			<button class="say_out_button" onClick="window.location='{site_obj.getLinkPage(12)}'">
				<span>
					<span>
						<span>Гости</span>
					</span>
				</span>
			</button>
			<div class="cl"></div>
			[[for interv in items_interv]]
				[[if loop.index == 1 or loop.index == 2]]
					<div class="img [[if loop.index == 1]]ml0[[endif]]">
						<img src="/{site_obj.isFile(interv.id, 136, 149)}" alt="{interv.title}" /></a>
						<div class="title">
							<a href="{interv.full_url}">{interv.caption}</a>
						</div>				
					</div>
				[[endif]]
			[[if loop.index == 2]]
		</div>	
		<div class="block_2">
			<div class="link"><a href="{site_obj.getLinkPage(12)}">Другие гости</a></div>
			<ul>
			[[endif]]
			[[if loop.index > 2]]
				<li>
					<a href="{interv.full_url}">{interv.caption}</a>
				</li>
			[[endif]]
		[[endfor]]
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
</div>
</div>