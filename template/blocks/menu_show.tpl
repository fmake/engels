[[for item in items_place_main]]
<div class="caption">
	<div onClick="window.location='{item.full_url}'" style="cursor: pointer;">
		{item.caption}
	</div>
</div>
<div class="cl"></div>
<img src="/{place_obj.isFile(item.id, 100, 100)}" width="100" height="100" style="cursor: pointer;" onClick="window.location='{item.full_url}'" />
<div class="text">{item.anons}</div>
[[endfor]]