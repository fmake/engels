[[for item in items_place_main]]
<div class="caption">
	<a class="h1" href="item.full_url">
		{item.caption}
	</a>
</div>
<div class="cl"></div>
	<a class="h1" href="item.full_url"><img src="/{place_obj.isFile(item.id, 100, 100)}" width="100" height="100" /></a>
<div class="text">{item.anons}</div>
[[endfor]]