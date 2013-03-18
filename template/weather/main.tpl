[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]

[[ macro printTod(tod) ]]
	[[if tod == 0]]
		Ночь
	[[elseif tod == 1]]
		Утро
	[[elseif tod == 2]]
		День
	[[elseif tod == 3]]
		Вечер
	[[endif]]
[[endmacro]]
[[ macro printMonth(month) ]]
	[[if month == 1]]
		января
	[[elseif month == 2]]
		февраля
	[[elseif month == 3]]
		марта
	[[elseif month == 4]]
		апреля
	[[elseif month == 5]]
		мая
	[[elseif month == 6]]
		июня
	[[elseif month == 7]]
		июля
	[[elseif month == 8]]
		августа
	[[elseif month == 9]]
		сентября
	[[elseif month == 10]]
		октября
	[[elseif month == 11]]
		ноября
	[[elseif month == 12]]
		декабря
	[[endif]]
[[endmacro]]
[[ macro printWeek(week) ]]
	[[if week == 1]]
		воскресенье
	[[elseif week == 2]]
		понедельник
	[[elseif week == 3]]
		вторник
	[[elseif week == 4]]
		среда
	[[elseif week == 5]]
		четверг
	[[elseif week == 6]]
		пятница
	[[elseif week == 7]]
		суббота
	[[endif]]
[[endmacro]]
[[ macro printTemperature(temper) ]]
	[[if temper > 0]]
		+{temper}
	[[else]]
		{temper}
	[[endif]]
[[endmacro]]


[[block center]]

	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]

	<div id="item_news">
		<h1>{modul.caption}</h1>
		<div class="story">
		
			<table width="100%" class="weather">
				[[for key,item in type_weather_param]]
					<tr valign="middle" align="center">
						[[set loop_first = loop.first]]
						[[if loop_first]]	
							<th align="left" class="first">{item.name|raw}</th>
						[[else]]
							<td align="left" class="first">{item.name|raw}</td>
						[[endif]]
						[[for i in 0..3]]
							[[if loop_first]]
								<th><b>{_self.printTod(array_weather_page[i][item.param]['tod'])}</b><br>{array_weather_page[i][item.param]['day']} {_self.printMonth(array_weather_page[i][item.param]['month'])}, {_self.printWeek(array_weather_page[i][item.param]['weekday'])}</th>
							[[else]]
								<td>{_self.printTemperature(array_weather_page[i][item.param]['@attributes']['max'])}.. {_self.printTemperature(array_weather_page[i][item.param]['@attributes']['min'])}</td>
							[[endif]]
						[[endfor]]
					</tr>
				[[endfor]]
			</table>
			<noindex>
			<center>Предоставлено <a rel="nofollow" href="http://www.gismeteo.ru/" target="_blank">Gismeteo.Ru</a></center>
			</noindex>
		</div>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]