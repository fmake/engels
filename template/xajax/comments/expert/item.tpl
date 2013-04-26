<a name="comment{item.id}"></a>
<div class="com">
	[[if item.user_params.picture_social_link]]
		<img src="{item.user_params.picture_social_link}" style="float:left;">
	[[else]]
		[[if item.user_params.picture]]
			<img src="/images/users/{item.user_params.id_user}/50_50_{item.user_params.picture}" style="float:left;">
		[[endif]]
	[[endif]]
	<div [[if item.user_params.picture_social_link or item.user_params.picture]]style="margin-left: 55px;"[[endif]]>
		<div class="date"><span>Дата комментария: {df('date','H:i d.m.Y',item.date)}</span></div>
		<div class="nam">
			[[if item.user_params.post_create]]
				<a href="mailto:{item.user_params.login}@engels.bz">
					[[if item.user_params.name]]
						{item.user_params.name}
					[[else]]
						{item.user_params.login}
					[[endif]]
				</a>
			[[else]]
				[[if item.user_params.name]]
					{item.user_params.name}
				[[else]]
					{item.user_params.name_social}
				[[endif]]
			[[endif]]
		</div>
		<p>
			{item.text|raw}
		</p>
		[[if item.answer]]
			<div class="answer_comment" >
				<p>
					<b>Ответ эксперта:</b> {item.answer|raw}
				</p>
			</div>
		[[else]]
			[[if user.id == id_expert ]]
				<a href="#" class="expert_answer" onclick="return false;">ответить</a>
				<div class="answer_expert" [[if request.comment == item.id and error_answer]][[else]]style="display:none"[[endif]]>
					[[if request.comment == item.id and error_answer]]
						<p style="color: red;">
							[[for er in error_answer]]
								{er}<br/>
							[[endfor]]
						</p>
					[[endif]]
					<form method="post" action="#comment{item.id}">
						<input type="hidden" name="action" value="answer_expert" />
						<input type="hidden" name="comment" value="{item.id}" />
						/*<textarea name="answer">[[if request.comment == item.id and error_answer]]{request.answer}[[endif]]</textarea><br/>
						<input class="submit" type="submit" value="Ответить" />*/
						<div class="textarea">
							<textarea name="answer">[[if request.comment == item.id and error_answer]]{request.answer}[[endif]]</textarea>
							<div class="textareainfo">
								<input class="submit" type="submit" value="Ответить" />
								/*<div class="captcha clf">
									<span>Защита от роботов:</span>
									<img width="60" height="18" src="/getpicture.php" alt="Защита от роботов" title="Защита от роботов" />
									<input type="text" id="faq_captcha" class="text" name="picode" />
								</div>*/
							</div>
						</div>
					</form>
				</div>	
			[[endif]]
		[[endif]] 
	</div>
</div>