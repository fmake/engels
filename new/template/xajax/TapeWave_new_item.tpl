[[for item in items_news_lent]]
	<div class="pre_item">
		<div class="item">
			<div class="time">
				[[if item.date > to_day]]
					{df('date','H:i',item.date)}
				[[else]]
					{df('date','H:i d.m.Y',item.date)}
				[[endif]]
			</div>
			<div class="icons">
				[[if item.picture]]
					<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="Фото"/></a>
				[[endif]]

				[[if item.video]]
					<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="Видео"/></a>
				[[endif]]
				
				[[if item.mnenie]]
					<a href="{item.full_url}#quot"><img src="/images/bg/mp.png" alt="{item.mnenie}" title="У этой статьи есть Мнения" class="fix_img" /></a>
				[[endif]]
			</div>
			<div class="cl"></div>
			<div class="note">
				<a href="{news_obj.getLinkPage(item.parent)}"><span class="title">{item.name_category}</span></a>
				<a href="{item.full_url}">{item.caption}</a>
				[[if item.comment]]<span class="comments">[{item.comment}]</span>[[endif]]
			</div>
		</div>
	</div>
	<div class="cl"></div>
	[[if loop.index == loop.last]]
		<div id="last_id" hidden style="display: none;">{item.id}</div>
	[[endif]]
[[endfor]]