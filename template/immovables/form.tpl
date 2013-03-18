[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	<script>
		{place_script|raw}
	</script>
    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
	
		<h1>Добавление недвижимости</h1>
		<div class="form_add_advert">
		[[if request.immovableid]]
			<p class="h1">Ваше объявление будет доступно <a href="{site_obj.getLinkPage(request.immovableid)}">по ссылке</a> .</p>
		[[else]]
			[[if error]]
				<p class="error_block"> 
					Имеются незаполненные обязательные поля.
				</p>
			[[endif]]
			<form action="{advert_obj.getLinkPage(modul.id)}?form=add_immovable" method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="add_immovables" />
				<table>
					<tr>
						<td>Категория <span class="zvezdochka">*</span></td>
						<td>
							<select class="[[if error.parent]]error[[endif]]" name="parent">
								<option value="0">Выберите категорию</option>
								[[for item in categories]]
									<option value="{item.id}" [[if request.parent == item.id]]selected[[endif]]>{item.caption}</option>
								[[endfor]]
							<select>
						</td>
					</tr>
					<tr>
						<td>Тип недвижимости <span class="zvezdochka">*</span></td>
						<td>
							<select class="[[if error.type]]error[[endif]]" name="type">
								<option value="0">Выберите тип</option>
								[[for item in immovablesTypes]]
									<option value="{item.name}" [[if item.name == request.type]]selected="selected"[[endif]]>{item.name}</option>
								[[endfor]]
							<select>
						</td>
					</tr>
					<tr>
						<td>Срок публикации <span class="zvezdochka">*</span></td>
						<td>
							<select class="[[if error._date_end_publick]]error[[endif]]" name="_date_end_publick">
								<option [[if request._date_end_publick == '1week']]selected="selected"[[endif]] value="1week">Неделя</option>
								<option [[if request._date_end_publick == '1month' or not request._date_end_publick]]selected="selected"[[endif]] value="1month">1 месяц</option>
								<option [[if request._date_end_publick == '2month']]selected="selected"[[endif]] value="2month">2 месяца</option>
							<select>
						</td>
					</tr>
					<tr>
						<td>Название <span class="zvezdochka">*</span></td>
						<td>
							<input class="fieldfocus [[if error.caption]]error[[endif]]" title="Введите название" type="text" name="caption" value="{request.caption}" />
						</td>
					</tr>	
					<tr>
						<td>Кол-во комнат </td>
						<td>
							<input class="fieldfocus [[if error.count_room]]error[[endif]]" title="Введите кол-во комнат" type="text" name="count_room" value="{request.count_room}" /> (число)
						</td>
					</tr>
					<tr>
						<td>Этаж </td>
						<td>
							<input class="fieldfocus [[if error.floor]]error[[endif]]" title="Введите этаж" type="text" name="floor" value="{request.floor}" />
						</td>
					</tr>
					<tr>
						<td>Этажность дома </td>
						<td>
							<input class="fieldfocus [[if error.floors_home]]error[[endif]]" title="Введите этажность дома" type="text" name="floors_home" value="{request.floors_home}" />
						</td>
					</tr>
					<tr>
						<td>Общая площадь </td>
						<td>
							<input class="fieldfocus [[if error.general_area]]error[[endif]]" title="Введите общюю площадь" type="text" name="general_area" value="{request.general_area}" />
						</td>
					</tr>
					<tr>
						<td>Жилая площадь </td>
						<td>
							<input class="fieldfocus [[if error.living_area]]error[[endif]]" title="Введите жилую площадь" type="text" name="living_area" value="{request.living_area}" />
						</td>
					</tr>
					<tr>
						<td>Сан. узел </td>
						<td>
							<input class="fieldfocus [[if error.wc]]error[[endif]]" title="Введите текст" type="text" name="wc" value="{request.wc}" />
						</td>
					</tr>
					<tr>
						<td>Состояние </td>
						<td>
							<input class="fieldfocus [[if error.state]]error[[endif]]" title="Введите состояние" type="text" name="state" value="{request.state}" />
						</td>
					</tr>
					<tr>
						<td>Район </td>
						<td>
							<input class="fieldfocus [[if error.region]]error[[endif]]" title="Введите район" type="text" name="region" value="{request.region}" />
						</td>
					</tr>
					<tr>
						<td>Цена за м2 </td>
						<td>
							<input class="fieldfocus [[if error.price_m2]]error[[endif]]" title="Введите цену за м2" type="text" name="price_m2" value="{request.price_m2}" /> руб.
						</td>
					</tr>
					<tr>
						<td>Цена <span class="zvezdochka">*</span></td>
						<td>
							<input class="fieldfocus [[if error.price]]error[[endif]]" title="Введите цену" type="text" name="price" value="{request.price}" /> руб.
						</td>
					</tr>
					<tr>
						<td>Адрес </td>
						<td>
							<input class="fieldfocus [[if error.addres]]error[[endif]]" title="Введите адрес" type="text" name="addres" value="{request.addres}" />
						</td>
					</tr>
					<tr>
						<td>Телефон</td>
						<td>
							<input class="fieldfocus [[if error.phone]]error[[endif]]" title="Введите телефон" type="text" name="phone" value="{request.phone}" />
						</td>
					</tr>
					<tr>
						<td>Email </td>
						<td>
							<input class="fieldfocus [[if error.email]]error[[endif]]" title="Введите email" type="text" name="email" value="{request.email}" />
						</td>
					</tr>
					<tr>
						<td>Контактное лицо </td>
						<td>
							<input class="fieldfocus [[if error.name_user]]error[[endif]]" title="Введите ФИО" type="text" name="name_user" value="{request.name_user}" />
						</td>
					</tr>
					<tr>
						<td>Фото</td>
						<td>
							<input type="file" name="image" />
						</td>
					</tr>
					<tr>
						<td>Описание <span class="zvezdochka">*</span></td>
						<td>
							<textarea class="fieldfocus [[if error.info]]error[[endif]]" title="Введите описание недвижимости" name="info" >{request.info}</textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="right">
							<button onclick="$('#preloader_advert').show();" class="button" type="submit">
								<span class="button-left">
									<span class="button-right">
										<span class="button-text">
											<span>Добавить</span>
										</span>
									</span>
								</span>
							</button>
						</td>
					</tr>
				</table>
			</form>
			<div id="preloader_advert" class="preloader"><center><img src="/images/pre.gif"></center></div>
		[[endif]]
		</div>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "immovables/right_block_baner.tpl"]]
[[endblock]]