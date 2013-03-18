[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]] 

[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]    
	<div id="item_news">   
		<h1>{modul.caption}</h1>
		
		{item.text|raw}

		[[if registration_true]]
			<p class="h1">
			{configs.register_site|raw}<br/>
				Ваша персональная почта <a target="_blank" href="/ya_mail.php?login={user_params.login}" class="h1">{request.login}@{domain}</a> .
			</p>
			
		[[else]]
			[[if error]]
				<span class="error">
				[[for er in error]]
					{er}<br/>
				[[endfor]]
				</span>
			[[endif]]
			<div class="register">
				<form method="post" name="registration" onsubmit="javascript: document.registration.submit(); return false;">
				<input type="hidden" name="action" value="register"> 
				<div class="form">
					<table>
						<tr>
							<td class="name_form">Логин:</td>
							<td><input type="text" name="login" value="{request.login}" text_popup="Введите логин для входа в личный кабинет"/></td>
						</tr>
						<tr>
							<td class="name_form">Пароль:</td>
							<td><input type="password" name="password" text_popup="Введите пароль для входа в личный кабинет"/></td>
						</tr>
						<tr>
							<td class="name_form">Повторите пароль:</td>
							<td><input type="password" name="password_succed" text_popup="Повторите пароль "/></td>
						</tr>
						<tr>
							<td class="name_form">Статус:</td>
							<td>
								<select name="type" onchange="changeStatusUser(this.value)" text_popup="выберите тип пользователя">
									<option value="user" [[if request.type == 'user']]selected[[endif]]>Пользователь сайта</option>
									<option value="ekspert" [[if request.type == 'ekspert']]selected[[endif]]>Эксперт</option>
								</select>
							</td>
						</tr>
						<tr id="first_name" [[if request.type != 'ekspert']]style="display:none;"[[endif]]>
							<td class="name_form">Имя:</td>
							<td><input type="text" name="first_name" value="{request.first_name}" text_popup="Введите Ваше имя"/></td>
						</tr>
						<tr id="second_name" [[if request.type != 'ekspert']]style="display:none;"[[endif]]>
							<td class="name_form">Фамилия:</td>
							<td><input type="text" name="second_name" value="{request.second_name}" text_popup="Введите Вашу фамилию"/></td>
						</tr>
						<tr id="main_email" [[if request.type != 'ekspert']]style="display:none;"[[endif]]>
							<td class="name_form">Основной email:</td>
							<td><input type="text" name="main_email" value="{request.main_email}"  text_popup="Введите основной email для оповещений"/></td>
						</tr>
						<tr id="job" [[if request.type != 'ekspert']]style="display:none;"[[endif]]>
							<td class="name_form">Должность:</td>
							<td><input type="text" name="job" value="{request.job}" text_popup="Введите Вашу должность"/></td>
						</tr>
						<tr id="oblast_ekspert" [[if request.type != 'ekspert']]style="display:none;"[[endif]]>
							<td class="name_form">Тема эксперта:</td>
							<td>
								<select class="" name="id_oblast_ekspert" text_popup="Выберите основную Вашу тему">
									[[for item in categories]]
										<option value="{item.id}" [[if request.id_oblast_ekspert == item.id]]selected[[endif]]>{item.caption}</option>
										[[for catitem in item.child]]
											<option style="margin-left: 15px;" value="{catitem.id}" [[if request.id_oblast_ekspert == catitem.id]]selected[[endif]]>{catitem.caption}</option>
											[[for catitem_item in catitem.child]]
												<option style="margin-left: 30px;" value="{catitem_item.id}" [[if request.id_oblast_ekspert == catitem_item.id]]selected[[endif]]>{catitem_item.caption}</option>
											[[endfor]]
										[[endfor]]
									[[endfor]]
								<select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td align="right">
								<button class="button" type="submit">
									<span class="button-left">
										<span class="button-right">
											<span class="button-text">
												<span>Регистрация</span>
											</span>
										</span>
									</span>
								</button>	
							</td>
						</tr>
					</table>
					<div class="social-enter"><span>Войти через:</span> 
						<img src="/images/tmp/vka.jpg" alt="vk" class="social_link" id="vkontakte" />
						<img src="/images/tmp/fba.jpg" alt="fb" class="social_link" id="facebook" />
					</div>
				</div>
				</form>
				
				<div id="informer" class="informer">
					<p>
						Текст всплывающего окна
					</p>
					<span class="ecke"></span>
				</div>
			</div>
		[[endif]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]