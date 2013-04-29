[[if user.id]]
	[[if error.comment]]
		<div class="error">
			Ошибки:
			[[for er in error.comment]]
				{er}<br/>
			[[endfor]]
		</div>
	[[endif]]
	
	<form method="post" onsubmit="return false;" id="form_foto_for_comments">
		<input type="hidden" name="action" value="comments">
		<div class="error"></div>
		<div class="i-n">
			<input type="text" name="name_comment" class="fieldfocus name" title="Имя" placeholder="Имя"/>
		</div>
		<div class="i-t">
			<textarea name="text" class="fieldfocus textarea" title="Комментарий" placeholder="Комментарий"></textarea>
		</div>
		<div class="public">
			<span>Защита от роботов:</span>
			<img id="c_n" width="60" height="18" src="/getpicture_foto.php" alt="Защита от роботов" title="Защита от роботов" />
			<input type="text" id="faq_captcha" class="captcha" name="picode" style="width: 55px;" />
		</div>
		<button class="float-right" id="button_for_form_foto_for_comments" idfoto="{id_foto}">
			<span>
				<span>
					<span>Отправить</span>
				</span>
			</span>
		</button>
		<div class="cl"></div>
		<div class="sucless" style="color: green;"></div>
	</form>
[[else]]
	<div class="textarea">
		<center>Для возможности отправки коментариев <a href="/vhod-na-sajt/">войдите</a> или <a href="/registracija/">зарегистрируйтесь</a>.</center><br/>
	</div>
[[endif]]