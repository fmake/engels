[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
		
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<div id="votes">
				<h1>Архив голосование</h1>
				<a name="golosovanie"></a>
				[[for key,interv_item in interview]]
					<div class="vote">
						<div class="title">{interv_item.caption}</div>
					[[if vopros[key] ]]
						<form action="#questionform" method="post" id="QuestionFormRight{interv_item.id}" onsubmit="SubmitFormVote({interv_item.id}); return false;" style="position: relative;"> 
							<img src="/images/pre.gif" style="display: none; position: absolute; left: 95px; top: 21px;" alt="" /> 
							[[set Quest = vopros[key] ]]
							[[set Cook = true ]]
							[[set interview_id = interv_item.id ]]
							[[set Do = 1]]
							[[ include TEMPLATE_PATH ~ "xajax/vote_main.tpl"]]
						</form>
					[[endif]]
					</div>
					[[if loop.index%3 == 0]]
						<div class="cl padding10px"></div>
					[[endif]]
				[[endfor]]
			<div class="cl"></div>
		</div>
	</div>
[[endblock]]

[[block right]]
	
	[[ include TEMPLATE_PATH ~ "vote/right_block_baner.tpl"]]
	
[[endblock]]