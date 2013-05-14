<ul>
	[[for item in menu]]
		<li class="[[if loop.last]]lc[[endif]]"><a href="/[[if not item.index]]{item.redir}/[[endif]]" class="[[if item.status]]active[[endif]]">{item.id}</a></li>
	[[endfor]]
</ul>