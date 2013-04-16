[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]] 

[[block center]]
	<div id="item_news">
		<h1>{modul.caption}</h1>
		<div class="form_add_advert">
			[[if error_edit_user_params]]
				<p class="" style="color: red;">
					[[for er in error_edit_user_params]]
						{er}<br/>
					[[endfor]]
				</p>
			[[endif]]
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="edit_user_params" />
				<table>
					[[if not (user_params.id_vk or user_params.id_fb)]]
						<tr>
							<td colspan="2">
								[[if user_params.picture]]
									<img src="/images/users/{user.id}/100_80_{user_params.picture}" alt="" />
								[[endif]]
							</td>
						</tr>
						<tr>
							<td>Фото:</td>
							<td>
								<input type="file" name="avatar"  id="image_avatar" accept="image/jpg"/>
							</td>
						</tr>
					[[endif]]
					[[if user_params.post_create]]
						<tr>
							<td>Почта:</td>
							<td><a href="/ya_mail.php?login={user_params.login}" target="_blank" class="l">{user_params.login}@engels.bz ( {user_params.message_new} )</a><br/><br/></td>
						</tr>
					[[endif]]
					[[if user_params.id_vk]]
						<tr>
							<td colspan="2">
								[[if user_params.picture_social_link]]
									<img src="{user_params.picture_social_link}" alt="" />
								[[endif]]
							</td>
						</tr>
						<tr>
							<td>Вконтакте:</td>
							<td><a href="http://vk.com/id{user_params.id_vk}" target="_blank" class="l">{user_params.name_social}</a><br/><br/></td>
						</tr>
					[[endif]]
					[[if user_params.id_fb]]
						<tr>
							<td colspan="2">
								[[if user_params.picture_social_link]]
									<img src="{user_params.picture_social_link}" alt="" />
								[[endif]]
							</td>
						</tr>
						<tr>
							<td>Facebook:</td>
							<td><a href="http://facebook.com/{user_params.id_fb}" target="_blank" class="l">{user_params.name_social}</a><br/><br/></td>
						</tr>
					[[endif]]
					<tr>
						<td>Имя:</td>
						<td><input class="fieldfocus" type="text" name="name" title="Имя" value="[[if user_params.name]]{user_params.name}[[endif]]"/></td>
					</tr>
					<tr>
						<td>Основная почта:</td>
						<td><input class="fieldfocus" type="text" name="main_email" title="Основная почта" value="[[if user_params.main_email]]{user_params.main_email}[[endif]]"/></td>
					</tr>
					<tr>
						<td>Статус:</td>
						<td>
							<select name="type" >
								<option value="user" [[if request.type == 'user' or user_params.type == 'user']]selected[[endif]]>Пользователь сайта</option>
								<option value="ekspert" [[if request.type == 'ekspert' or user_params.type == 'ekspert']]selected[[endif]]>Эксперт</option>
							</select>
						</td>
					</tr>
					[[if not (user_params.id_vk or user_params.id_fb )]]
						<tr>
							<td colspan="2"><h3>Смена пароля</h3><br/></td>
						</tr>
						<tr>
							<td>Пароль</td>
							<td><input class="fieldfocus" type="password" name="password" title="Пароль"/></td>
						</tr>
						<tr>
							<td>Повторите пароль</td>
							<td><input class="fieldfocus" type="password" name="password_succed" title="Повторите пароль"/></td>
						</tr>
					[[endif]]
					
					[[if user_params.type == 'ekspert']]
					
					<tr>
						<td colspan="2"><h3>Эксперт</h3><br/></td>
					</tr>
					
					<tr>
						<td>Должность:</td>
						<td><input class="fieldfocus" type="text" name="job" title="Должность" value="[[if user_params.job]]{user_params.job}[[endif]]"/></td>
					</tr>
					
					<tr>
						<td class="name_form">Тема эксперта:</td>
						<td>
							<select class="" name="id_oblast_ekspert">
								[[for item in categories]]
									<option value="{item.id}" [[if user_params.id_oblast_ekspert == item.id]]selected[[endif]]>{item.caption}</option>
									[[for catitem in item.child]]
										<option style="margin-left: 15px;" value="{catitem.id}" [[if user_params.id_oblast_ekspert == catitem.id]]selected[[endif]]>{catitem.caption}</option>
										[[for catitem_item in catitem.child]]
											<option style="margin-left: 30px;" value="{catitem_item.id}" [[if user_params.id_oblast_ekspert == catitem_item.id]]selected[[endif]]>{catitem_item.caption}</option>
										[[endfor]]
									[[endfor]]
								[[endfor]]
							<select>
						</td>
					</tr>
					<tr>
						<td class="name_form">Доп. темы:</td>
						<td>
							<select class="" name="parents_oblast_ekspert[]" multiple="multiple" style="height: 155px;">
								[[for item in categories]]
									<option value="{item.id}" [[if fmakeSiteUserMultiple.isItemParent(item.id,user_params.id_user)]]selected[[endif]]>{item.caption}</option>
									[[for catitem in item.child]]
										<option style="margin-left: 15px;" value="{catitem.id}" [[if fmakeSiteUserMultiple.isItemParent(catitem.id,user_params.id_user)]]selected[[endif]]>{catitem.caption}</option>
										[[for catitem_item in catitem.child]]
											<option style="margin-left: 30px;" value="{catitem_item.id}" [[if fmakeSiteUserMultiple.isItemParent(catitem_item.id,user_params.id_user)]]selected[[endif]]>{catitem_item.caption}</option>
										[[endfor]]
									[[endfor]]
								[[endfor]]
							<select>
						</td>
					</tr>
					[[endif]]
					<tr>
						<td align="right">
							<button class="button" type="submit">
								<span class="button-left">
									<span class="button-right">
										<span class="button-text">
											<span>Сохранить</span>
										</span>
									</span>
								</span>
							</button>
						</td>
					</tr>
				</table>
			</form>
			
			[[if user_params.type == 'ekspert']]
				<br/>
				<h2 class="add_post_expert"><span>Добавить статью</span></h2>
				<br/>
				<a name="form_add_post"></a>
				[[if request.addpost]]
					<h3 style="color: red;">Cтатья добавлена !!!</h3>
				[[endif]]
				[[if error_post]]
					<p class="" style="color: red;">
						[[for er in error_post]]
							{er}<br/>
						[[endfor]]
					</p>
				[[endif]]
				<form method="post" action="#form_add_post" enctype="multipart/form-data" class="form_add_post" [[if not error_post]]style="display:none;"[[endif]]>
					<input type="hidden" name="action" value="add_expert_post" />
					<table>
						<tr>
							<td>Название</td>
							<td><input class="fieldfocus" type="text" name="caption" title="Название" value="{request.caption}"/></td>
						</tr>
						/*<tr>
						<td>Фото</td>
							<td>
								<input type="file" name="image" />
							</td>
						</tr>*/
						<tr>
							<td colspan="2" style="widht: 200px;">
								Текст:<br/>
								<!-- TinyMCE -->
								<script type="text/javascript" src="/admin/includes/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
								[[raw]]
								<script type="text/javascript">
								tinyMCE.init({
									// General options
									editor_selector : "elem_tinymce",
									mode : "specific_textareas",
									theme : "advanced", 
									relative_urls : false,
									//plugins : "imagemanager,filemanager,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
									
									relative_urls : false,
									document_base_url : 'http://engels.bz',
									
									// Theme options
									theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
									theme_advanced_buttons2 : "",
									theme_advanced_buttons3 : "",
									theme_advanced_buttons4 : "",
									theme_advanced_toolbar_location : "top",
									theme_advanced_toolbar_align : "left",
									theme_advanced_statusbar_location : "bottom",
									theme_advanced_resizing : true,

									// Example content CSS (should be your site CSS)
									content_css : "css/content.css",
									// Style formats
									style_formats : [
										{title : 'Bold text', inline : 'b'},
										{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
										{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
										{title : 'Example 1', inline : 'span', classes : 'example1'},
										{title : 'Example 2', inline : 'span', classes : 'example2'},
										{title : 'Table styles'},
										{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
									],

									formats : {
										alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
										aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
										alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
										alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
										//bold : {inline : 'span', 'classes' : 'bold'},
										//italic : {inline : 'span', 'classes' : 'italic'},
										//underline : {inline : 'span', 'classes' : 'underline', exact : true},
										//strikethrough : {inline : 'del'}
									}
								});
								</script>
								[[endraw]]
								<!-- /TinyMCE -->
								
								<textarea class="elem_tinymce" name="text" rows="4" cols="40" style="width: 200px; height: 300px;">{request.text}</textarea>
							</td>
						</tr>
						<tr>
							<td align="right">
								<button class="button" type="submit">
									<span class="button-left">
										<span class="button-right">
											<span class="button-text">
												<span>Добавить статью</span>
											</span>
										</span>
									</span>
								</button>
							</td>
							<td></td>
						</tr>
					</table>
				</form>
				<br/>
				[[if items]]
					<h3>Статьи</h3>
					[[for post in items]]
						<p><a href="{post.full_url}">{post.caption}</a> - [[if post.active]]Опубликована[[else]]На модерации[[endif]]</p>
					[[endfor]]
					<br/>
				[[endif]]
			[[endif]]
			
			
			<br/>
			<h2 class="add_sms_mailer"><span>Добавить SMS рассылку</span></h2>
			<br/>
			<a name="form_add_sms_mailer"></a>
			[[if request.addsmsmailer]]
				<h3 style="color: red;">Рассылка добавлена !!!</h3>
			[[endif]]
			[[if error_sms_mailer]]
				<p class="" style="color: red;">
					[[for er in error_sms_mailer]]
						{er}<br/>
					[[endfor]]
				</p>
			[[endif]]
			<form method="post" action="#form_add_sms_mailer" class="form_add_sms_mailer" [[if not error_sms_mailer]]style="display:none;"[[endif]]>
				<input type="hidden" name="action" value="add_sms_mailer" />
				<table>
					<tr>
						<td>Текст сообщения</td>
						<td><textarea class="fieldfocus" name="text" title="Текст сообщения" style="width: 474px; height: 69px;">[[if request.action == 'add_sms_mailer']]{request.text}[[endif]]</textarea></td>
					</tr>
					<tr>
						<td>Номера</td>
						<td><textarea class="fieldfocus" name="phones" title="Номера телефонов" style="width: 474px; height: 69px;">[[if request.action == 'add_sms_mailer']]{request.phones}[[endif]]</textarea></td>
					</tr>
					<tr>
						<td colspan="2"><em >Перечислите номера телефонов через запятую. Пример ввода номеров: 89666763459,89666763458,89666763457,89666763455</em></td>
					</tr>
					<tr>
						<td align="right">
							<button class="button" type="submit">
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
			<br/>
			[[if sms_mailer_items]]
				<h3>SMS рассылки</h3>
				<table>
					<tr>
						<th>Текст</th>
						<th>Телефоны</th>
						<th>Статус</th>
					</tr>
				[[for it in sms_mailer_items]]
					<tr>
						<td><div style="width: 200px;"><p>{it.text}</p></div></td>
						<td><div style=""><p>{it.phones}</p></div></td>
						<td>[[if post.active]]Рассылка[[else]]На модерации[[endif]]</td>
					</tr>
				[[endfor]]
				</table>
				<br/>
			[[endif]]
			
			[[if baners_user_used]]
				<h3>Рекламная компания на сайте</h3><br/>
				<table>
					<tr>
						<th>Название</th>
						<th>Тип</th>
						<th>Показы</th>
						<th>Деньги</th>
					</tr>
				[[for baner_user in baners_user_used]]
					<tr>
						<td><div style="width: 200px;"><p>{baner_user.caption}</p></div></td>
						<td><div style="width: 50px;"><p>[[if baner_user.type_baner == 1]]статья[[else]]банер[[endif]]</p></div></td>
						<td><div style=""><p>{baner_user.use_view}</p></div></td>
						<td>{baner_user.use_price}</td>
					</tr>
				[[endfor]]
				</table>
				<br/>
			[[endif]]
		</div>
		
		<div class="cl"></div>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]