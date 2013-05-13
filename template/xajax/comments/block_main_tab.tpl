[[if main_comments]]
<div class="item">
	<ul style="width: auto">
[[for item in main_comments]]
		<li>
        	<p class="time">Дата комментария: {df('date','H:i d.m.Y',item.date)}</p>
        	<a href="{site_obj.getLinkPage(item.page_id)}#comment{item.id}" class="a">
        		<span>{item.page_caption}</span>
        	</a>
        	от [[if item.user_params.post_create]]
        	<a href="mailto:{item.user_params.login}@engels.bz" class="a">
        		{item.user_params.login}
        	</a>
			[[else]]
				{item.user_params.name_social}
			[[endif]]
			<div class="comment_text">
				<p>{item.text|raw}</p>
			</div>
        </li>
[[endfor]]
	</ul>
</div>
<div class="cl"></div>
[[endif]]
