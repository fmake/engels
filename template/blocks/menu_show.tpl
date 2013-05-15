[[for item in items_place_main]]
<div class="caption">{item.caption}</div>
<div class="cl"></div>
<img src="/{place_obj.isFile(item.id, 100, 100)}" width="100" height="100" />
<div class="text">{item.text}</div>
[[endfor]]