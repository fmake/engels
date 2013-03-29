[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]] 

[[block content]]
	<p>
		<a href="/" class="breadcrubs">Главная</a>
		[[for b in breadcrubs]]
			[[if loop.last]]
				 / {b.caption}
			[[else]]
				<a href="{b.link}" class="breadcrubs">{b.caption}</a> /
			[[endif]]
		[[endfor]]
	</p>
	{item.alt_text|raw}
[[endblock]]
