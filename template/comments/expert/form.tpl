[[if user.id]]
	[[if error.comment]]
		<div class="error">
			Ошибки:
			[[for er in error.comment]]
				{er}<br/>
			[[endfor]]
		</div>
	[[endif]]
	[[if user_params.picture_social_link]]
		<img src="{user_params.picture_social_link}" style="float:left;" />
	[[else]]
		/*[[if user_params.picture]]
			<img src="/images/users/{user_params.id_user}/50_50_{user_params.picture}" style="float:left;" />
		[[endif]]*/
	[[endif]]
	/*<br/>*/
	/*<span style="margin-left: 5px;">
		[[if user_params.post_create]]
			<a href="mailto:{user_params.login}@engels.bz">
				[[if user_params.name]]
					{user_params.name}
				[[else]]
					{user_params.login}
				[[endif]]
			</a>
		[[else]]
			[[if user_params.name]]
				{user_params.name}
			[[else]]
				{user_params.name_social}
			[[endif]]
		[[endif]]
	</span>*/
	<div style="clear:both;"></div>
	/*
	<form method="post" action="#form_comments" onsubmit="javascript: document.form_comments.submit(); return false;" name="form_comments">
		<input type="hidden" name="action" value="comments" />

		<div class="textarea">
			<textarea name="text">{request.text}</textarea>
			<div class="textareainfo">
				<input class="submit" type="submit" value="Задать вопрос" />
				<div class="captcha clf">
					<span>Защита от роботов:</span>
					<img width="60" height="18" src="/getpicture.php" alt="Защита от роботов" title="Защита от роботов" />
					<input type="text" id="faq_captcha" class="text" name="picode" />
				</div>
			</div>
		</div>
	</form>
	*/
	<form method="post" action="#form_comments" onsubmit="javascript: document.form_comments.submit(); return false;" name="form_comments">
		<input type="hidden" name="action" value="comments">
		<div class="i-n">
			<input type="text" name="name_comment" class="fieldfocus" title="Имя"/>
		</div>
		<div class="i-t">
			<textarea name="text" class="fieldfocus" title="Комментарий">{request.text}</textarea>
		</div>
		/*
		<div class="public">
			<span>Опубликовать в социальных сетях</span>
			<img src="/images/icons/vkontaktike.png" alt="" />
			<input type="checkbox" name="vk">
			<img src="/images/icons/faceboock.png" alt="" />
			<input type="checkbox" name="facebook"/>
		</div>
		*/
		<div class="public">
			<span>Защита от роботов:</span>
			<img width="60" height="18" src="/getpicture.php" alt="Защита от роботов" title="Защита от роботов" />
			<input type="text" id="faq_captcha" class="text" name="picode" style="width: 55px;" />
		</div>
		<button class="float-right">
			<span>
				<span>
					<span>Задать вопрос</span>
				</span>
			</span>
		</button>
	</form>
[[else]]
	<div class="textarea">
		<center>Для возможности задавать вопросы эксперту <a href="#">войдите</a> или <a href="/registracija/">зарегистрируйтесь</a>.</center><br/>
	</div>
[[endif]]