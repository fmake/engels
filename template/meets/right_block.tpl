<div id="right_news">
	<div class="mbh" >
		<a class="big" href="{site_obj.getLinkPage(4)}">Афиша</a>
	</div>
	[[for item in meets_right_block]]
		<div class="altnews">
			[[if item.picture]]<a href="{item.full_url}"><img alt="" src="/{site_obj.fileDirectory}{item.id}/100_80_{item.picture}"></a>[[endif]]
			<div class="date">
				<span>{df('date','d.m.Y H:i',item.date)} [[if item.date_from]]- {df('date','d.m.Y H:i',item.date_from)}[[endif]]</span>
			</div>
			<a href="{item.full_url}">{item.caption}</a>
			<div style="clear:both;"></div>
		</div>
	[[endfor]]
	<div style="clear:both;"></div>
</div>