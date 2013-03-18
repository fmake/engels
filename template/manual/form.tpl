[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]

	<div class="names">
		<span>Добавление компани в справочник</span>
	</div>
	<div class="form_add_advert">
	[[if request.manualid]]
		<p class="h1">Ваш объект будет доступен <a href="{site_obj.getLinkPage(request.manualid)}">по ссылке</a> .</p>
	[[else]]
		[[if error]]
			<p class="error_block"> 
				Имеются незаполненные обязательные поля.
			</p>
		[[endif]]
		<form action="{site_obj.getLinkPage(modul.id)}?form=add_manual" method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="add_manual" />
			<table>
				<tr>
					<td>Основная категория <span class="zvezdochka">*</span></td>
					<td>
						<select class="[[if error.parent]]error[[endif]]" name="parent">
							<option value="0">Выберите категорию</option>
							[[for item in categories]]
								<option value="{item.id}" [[if request.parent == item.id]]selected[[endif]]>{item.caption}</option>
								[[for catitem in item.child]]
									<option style="margin-left: 15px;" value="{catitem.id}" [[if request.parent == catitem.id]]selected[[endif]]>{catitem.caption}</option>
									[[for catitem_item in catitem.child]]
										<option style="margin-left: 30px;" value="{catitem_item.id}" [[if request.parent == catitem_item.id]]selected[[endif]]>{catitem_item.caption}</option>
									[[endfor]]
								[[endfor]]
							[[endfor]]
						<select>
					</td>
				</tr>
				<tr>
					<td>Категории </td>
					<td>
						<select class="[[if error.parent]]error[[endif]]" multiple="multiple" name="parents[]" style="height: 120px;">
							[[for item in categories]]
								<option value="{item.id}" [[if request.parent == item.id]]selected[[endif]]>{item.caption}</option>
								[[for catitem in item.child]]
									<option style="margin-left: 15px;" value="{catitem.id}" [[if request.parent == catitem.id]]selected[[endif]]>{catitem.caption}</option>
									[[for catitem_item in catitem.child]]
										<option style="margin-left: 30px;" value="{catitem_item.id}" [[if request.parent == catitem_item.id]]selected[[endif]]>{catitem_item.caption}</option>
									[[endfor]]
								[[endfor]]
							[[endfor]]
						<select>
					</td>
				</tr>
				<tr>
					<td>Название <span class="zvezdochka">*</span></td>
					<td>
						<input class="fieldfocus [[if error.caption]]error[[endif]]" title="Введите название объявления" type="text" name="caption" value="{request.caption}" />
					</td>
				</tr>
				<tr>
					<td>ФИО контактного лица</td>
					<td>
						<input class="fieldfocus [[if error.fio_contakt]]error[[endif]]" title="Введите ФИО контактного лица" type="text" name="fio_contakt" value="{request.fio_contakt}" />
					</td>
				</tr>
				<tr>
					<td>Телефон контактного лица</td>
					<td>
						<input class="fieldfocus [[if error.phone_contakt]]error[[endif]]" title="Введите Телефон контактного лица" type="text" name="phone_contakt" value="{request.phone_contakt}" />
					</td>
				</tr>
				<tr>
					<td>Время работы</td>
					<td>
						<input class="fieldfocus [[if error.time_work]]error[[endif]]" title="Введите Время работы" type="text" name="time_work" value="{request.time_work}" />
					</td>
				</tr>
				<tr>
					<td>Web</td>
					<td>
						<input class="fieldfocus [[if error.web]]error[[endif]]" title="Введите Web-ресурс" type="text" name="web" value="{request.web}" />
					</td>
				</tr>
				<tr>
					<td>Адрес</td>
					<td>
						<input class="fieldfocus [[if error.addres]]error[[endif]]" title="Введите Адрес" type="text" name="addres" value="{request.addres}" />
					</td>
				</tr>
				<tr>
					<td>Город</td>
					<td>
						<input class="fieldfocus [[if error.city]]error[[endif]]" title="Введите Город" type="text" name="city" value="{request.city}" />
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input class="fieldfocus [[if error.email]]error[[endif]]" title="Введите контактный email" type="text" name="email" value="{request.email}" />
					</td>
				</tr>
				<tr>
					<td>Телефон</td>
					<td>
						<input class="fieldfocus [[if error.phone]]error[[endif]]" title="Введите контактный телефон" type="text" name="phone" value="{request.phone}" />
					</td>
				</tr>
				<tr>
					<td>Фото</td>
					<td>
						<input type="file" name="image" />
					</td>
				</tr>
				<tr>
					<td>Краткое описание <span class="zvezdochka">*</span></td>
					<td>
						<textarea class="fieldfocus [[if error.text]]error[[endif]]" title="Введите Краткое описание" name="text" >{request.text}</textarea>
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
		<div id="preloader_advert" class="preloader"><center><img src="/images/preloader.gif"></center></div>
	[[endif]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "manual/right_block_baner.tpl"]]
[[endblock]]