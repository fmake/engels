<div id="right_news">
	<div class="right_item_news">
		<a href = "{site_obj.getLinkPage(2)}" class = "h1">
			<h1>Новости</h1>
		</a>
		<div class="news">
			[[for item in news_right_block]]
				<div class="item">
					<div class="time">{df('date','H:i',item.date)}</div>
					<div class="icons"></div>
					<div class="cl"></div>
					<div class="note">
						[[if item.name_category]]<a href="{site_obj.getLinkPage(item.parent)}"><span class="title">{item.name_category}:</span></a>[[endif]]
						<a href="{item.full_url}">{item.caption}</a>
						[[if item.comment]]<span class="comments">[{item.comment}]</span>[[endif]]
					</div>
				</div>
			[[endfor]]
		 </div>
	</div>
</div>
<div class="cl"></div>