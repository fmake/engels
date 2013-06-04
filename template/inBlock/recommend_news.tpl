<div class="cl"></div>
<div class="smarty_block">
	<div class="cl"></div>
	[[if news_for_recomend]]
		<div class="recomend">
			<h1>Рекомендуем</h1>
			<div class="cl"></div>
			<ul>
				[[for item in news_for_recomend]]
				<li>
					<a href="{item.full_url}"><img src="/{site_obj.isFile(item.id, 222, 127)}" alt="{item.title}" /></a>
					<div class="cl"></div>
					<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
					<div class="cl"></div>
					<div class="text">{item.anons | raw}</div>
				</li>
				[[endfor]]
			</ul>
			<div class="cl"></div>
		</div>
	[[endif]]
</div>
<div class="cl"></div>