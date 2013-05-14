<ul>
	[[for item in menu]]
		<li class="[[if loop.last]]lc[[endif]]">
			[[if item.id == 5]]
				<div id="mest5show">
					<div class="caption">Пропал Парк Джи СУнг</div>
					<div class="cl"></div>
					<img src="/images/tmp/1.gif" width="100" height="100" />
					<div class="text">км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя км, тем не менее, интерес к нему не ослабевает.Сообщается, что Люди со всей планеты в ожидании потрясающего события. На Землю летит 45-метровый астероид весом в 130 тысяч тонн. И хотя </div>
				</div>
			[[endif]]
			<a href="/[[if not item.index]]{item.redir}/[[endif]]" [[if item.id == 5 ]]id="mest5"[[endif]] class="[[if item.status]]active[[endif]]">{item.caption}</a>
		</li>
	[[endfor]]
</ul>