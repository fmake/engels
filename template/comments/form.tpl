[[if error.comment]]
		<div class="error">
			Ошибки:
			[[for er in error.comment]]
				{er}<br/>
			[[endfor]]
		</div>
	[[endif]]
	
	<form method="post" action="#form_comments" onsubmit="javascript: document.form_comments.submit(); return false;" name="form_comments">
		<input type="hidden" name="action" value="comments">
		<div class="i-n">
			<input type="text" name="name_comment" class="fieldfocus" title="Имя" [[if go_name]]value="{go_name}"[[endif]] />
		</div>
		<div class="i-t">
			<textarea name="text" class="fieldfocus" title="Комментарий" [[if go_text]]value="{go_name}"[[endif]]>{request.text}</textarea>
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
					<span>Отправить</span>
				</span>
			</span>
		</button>
	</form>