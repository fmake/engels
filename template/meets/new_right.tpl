<div id="right_news">
	/*БАНЕР new*/
		[[set baner_right_7 = baner_obj.showBanerType(7,request_uri)]]
		[[if baner_right_7]]
			<div>
				<br/>
				<p>
					{baner_right_7|raw}
				</p>
			</div>
		[[endif]]
	/*БАНЕР new*/
	/*БАНЕР new*/
		[[set baner_right_8 = baner_obj.showBanerType(8,request_uri)]]
		[[if baner_right_8]]
			<div>
				<br/>
				<p>
					{baner_right_8|raw}
				</p>
			</div>
		[[endif]]
	/*БАНЕР new*/
	/*БАНЕР new*/
		[[set baner_right_9 = baner_obj.showBanerType(9,request_uri)]]
		[[if baner_right_9]]
			<div>
				<br/>
				<p>
					{baner_right_9|raw}
				</p>
			</div>
		[[endif]]
	/*БАНЕР new*/

	<div class="right_item_news">
	<!-- ГОЛОСОВАНИЕ START -->
		<div id="votes">
			<a href = "{site_obj.getLinkPage(7030)}" class = "h1">
				<h1>Голосование</h1>
			</a>
			<a name="golosovanie"></a>
			[[for key,interv_item in interview]]
				<div class="vote">
					<div class="title">{interv_item.caption}</div>
					[[if vopros[key] ]]
						<form action="#questionform" method="post" id="QuestionFormRight{interv_item.id}" onsubmit="SubmitFormVote({interv_item.id}); return false;" style="position: relative;"> 
							<img src="/images/pre.gif" style="display: none; position: absolute; left: 95px; top: 21px;" alt="" /> 
							[[set Quest = vopros[key] ]]
							[[set Cook = iscookie[key] ]]
							[[set interview_id = interv_item.id ]]
							[[set Do = 0]]
							[[ include TEMPLATE_PATH ~ "xajax/vote_main.tpl"]]
						</form>
					[[else]]
						нет вопросов
					[[endif]]
				</div>
			[[endfor]]
			<div class="cl"></div>
		</div>
	<!-- ГОЛОСОВАНИЕ END -->
	</div>
</div>