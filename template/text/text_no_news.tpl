[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]

	<div id="item_news">
		<h1>{modul.caption}</h1>
		<div class="story">
			{modul.text|raw}
		</div>
	</div>
[[endblock]]

[[block right]]
	
[[endblock]]