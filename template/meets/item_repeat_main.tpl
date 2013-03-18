<div class="item [[if loop.index%3 == 0]]ls[[endif]]">
    [[if item.picture]]
    	<a href="{item.full_url}">
    		<img alt="{item.title}" src="/{meets_obj.fileDirectory}{item.id}/140_100_{item.picture}" width="140" height="100" />
    	</a>
    [[endif]]
        <a href="{item.full_url}" class="h30px">{item.caption}</a>
</div>