[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption}</h1>
		<div class="story">
			[[if item.expert.picture]]
				<img alt="" src="/images/users/{item.expert.id_user}/225_300_{item.expert.picture}" align="left" style="float:left;" />
			[[elseif item.picture]]
				<img alt="" src="/{site_obj.fileDirectory}{item.id}/406__{item.picture}" align="left" widht="225" style="float:left;" />
			[[endif]] 
			[[if item.dop_params.date]]<p class="date">Дата добавления: {df('date','d.m.Y H:i',item.dop_params.date)}</p>[[endif]]
			<p class="autor">Эксперт : 
				[[if item.expert.name]]
					{item.expert.name}
				[[elseif item.expert.name_social]]
					{item.expert.name_social}
				[[else]]
					{item.expert.login}
				[[endif]]
			</p>
			{item.text|raw}
		</div>
		
		<div style="margin-bottom:20px;">
			[[ include TEMPLATE_PATH ~ "blocks/block_social_like.tpl"]]
		</div>
		
		[[set id_expert = item.dop_params.id_user]]
		[[ include TEMPLATE_PATH ~ "comments/expert/main.tpl"]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block_baner.tpl"]]
[[endblock]]