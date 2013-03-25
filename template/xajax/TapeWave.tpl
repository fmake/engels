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
				[[if item.picture]]<a href="{item.full_url}#item_news"><img src="/images/bg/fotocamera.png" alt="" title="Фото"/></a>[[endif]]
				[[if item.video]]<a href="{item.full_url}#video"><img src="/images/bg/camera.png" alt="" title="Видео"/></a>[[endif]]
			</div>
			<div class="cl"></div>
			<div class="note">
				<a href="{news_obj.getLinkPage(item.parent)}"><span class="title">{item.name_category}</span></a>
				<a href="{news_obj.getLinkPage(item.id)}">{item.caption}</a>
				[[if item.comment]]<span class="comments">[{item.comment}]</span>[[endif]]
			</div>
		</div>
	</div>
[[endfor]]