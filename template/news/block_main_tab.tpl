[[ set counter = 0 ]]
[[for item in items_news]]
	[[if loop.index == 1]]
		[[if item.picture]]
		<div class="img">
			<a href="{item.full_url}">
			    <img src="/{news_obj.fileDirectory}{item.id}/200_160_{item.picture}" alt="{item.title}" title="{item.title}" width="150	px" height=" 127px"/>
			</a>
		[[endif]]
			<div class="text">
				[[if not no_parent_show]]
			    	<div class="title">
			    		<a href="{news_obj.getLinkPage(item.parent)}">
			    			{item.name_category}
			    		</a>
			    	</div>
			    [[endif]]
			    	<div class="time" style="[[if no_parent_show]]float: left;[[endif]]">{df('date','H:i d.m.Y',item.date)}</div>
			    	<div class="caption">
				    	<a href="{item.full_url}">
				    		{item.caption}
				    	</a>
			    	</div>
			    </div>
		</div>
	[[else]]
		[[if counter == 0]]
			<div class="item">
				<ul>
		[[endif]]
		[[ set counter = counter+1 ]]
        <li>
        	<span class="time">{df('date','H:i',item.date)}</span>
        	<a href="{item.full_url}">
        		<span class="text">{item.caption}</span>
        	</a>
        </li>
        [[if loop.last]]
				</ul>
			</div>
			<div class="cl"></div>
		[[endif]]
	[[endif]]
[[endfor]]