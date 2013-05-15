<ul>
	[[for item in menu]]
		<li class="[[if loop.last]]lc[[endif]]">
			[[if item.id == 5]]
				<div id="mest5show">
				</div>
			[[endif]]
			<a href="/[[if not item.index]]{item.redir}/[[endif]]" [[if item.id == 5 ]]id="mest5"[[endif]] class="[[if item.status]]active[[endif]]">{item.caption}</a>
		</li>
	[[endfor]]
</ul>