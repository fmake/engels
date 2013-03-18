[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]] 

[[block center]]
	<div id="item_news">
		<h1>Востановление пароля</h1>
		<div class="form">
			[[if error_autication]]
				<p>Перейдите по ссылке с присланного письма не изменяя ссылку.</p>
			[[else]]
				<p class="error" style="color: red;">
					[[for er in error_getpass_params]]
						{er}<br/>
					[[endfor]]
				</p>
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="action" value="edit_user_getpassword" />
					<table>
						<tr>
							<td><input class="fieldfocus" type="password" name="password" title="Пароль"/></td>
						</tr>
						<tr>
							<td><input class="fieldfocus" type="password" name="password_succed" title="Повторите пароль"/></td>
						</tr>
						<tr>
							<td align="right">
								<button class="button" type="submit">
									<span class="button-left">
										<span class="button-right">
											<span class="button-text">
												<span>Сменить</span>
											</span>
										</span>
									</span>
								</button>
							</td>
						</tr>
					</table>
				</form>
			[[endif]]
		</div>
		
		<div class="cl"></div>
	</div>
[[endblock]]