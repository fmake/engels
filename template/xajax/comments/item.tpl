<a name="comment{item.id}"></a>
<div class="comments_item">
	<div class="img">
		[[if item.user_params.picture_social_link]]
			<img src="{item.user_params.picture_social_link}" style="float:left;">
		[[else]]
			[[if item.user_params.picture]]
				<img src="/images/users/{item.user_params.id_user}/50_50_{item.user_params.picture}" style="float:left;">
			[[endif]]
		[[endif]]
	</div>
	<div class="comment" style="margin: 10px 0;">
		<div class="title">
			<span class="name">
				[[if item.user_params.post_create]]
					<a href="mailto:{item.user_params.login}@engels.bz">
						[[if item.user_params.name]]
							{item.user_params.name}
						[[else]]
							{item.user_params.login}
						[[endif]]
					</a>
				[[else]]
					[[if item.user_params.name]]
						{item.user_params.name}
					[[else]]
						{item.user_params.name_social}
					[[endif]]
				[[endif]]
			</span>
			<span class="date">{df('date','H:i d.m.Y',item.date)}</span>
		</div>
		<div class="comment">
			{item.text|raw}
		</div>
	</div>
	<div class="cl"></div>
</div>