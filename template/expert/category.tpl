[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption}</h1>
			
		[[for new in items]]
			<div class="shortnews">
				[[if new.expert.picture]]
					<a href="{new.full_url}"><img alt="" src="/images/users/{new.expert.id_user}/100_80_{new.expert.picture}" align="left"class="shortnewsimg"></a>
				[[elseif new.picture]]
					<a href="{new.full_url}"><img alt="" src="/{site_obj.fileDirectory}{new.id}/100_80_{new.picture}" align="left"class="shortnewsimg"></a>
				[[endif]]
				<div class="date"><span>{df('date','d.m.Y H:i',new.date)}</span></div>
				<a href="{new.full_url}">{new.caption}</a>
				[[if new.expert.job]]<p class="count_vopros">Должность: {new.expert.job}</p>[[endif]]
				<p class="count_vopros">Вопросов: {new.comment}</p>
				<p class=""><a href="{new.full_url}#comments"><b>Задать вопрос / посмотреть ответы</b></a></p>
				/*<p>
					{new.anons|raw}
				</p>*/
			</div>
		[[else]]
			<p><center><h3>Пока нет ни одной темы</h3></center></p>
		[[endfor]]
		
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block_baner.tpl"]]
[[endblock]]