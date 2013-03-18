<a href="{site_obj.getLinkPage(5)}" class="h1">
    <h1>Места</h1>
</a>
<div class="nav">
    <ul>
    	[[for item in items_place_cats]]
    	[[if loop.index < 8]]
        <li><span><span><span><a href="{item.full_url}">{item.caption}</a></span></span></span></li>
        [[endif]]
        [[if loop.index%7 == 0]]
        	<li id="show_all"><span><span><span><a href="javascript:void(0);">Ещё</a></span></span></span>
        		<div class="hidden_show_all">
                	<div class="top_im"></div>
        [[endif]]
        [[if loop.index > 7]]
            [[if loop.index%2 == 0]]
                                <div class="all_item">
            [[endif]]
                                   <div class="item [[if loop.index%2 !=0 or loop.last]]laster[[else]]nower[[endif]]" >
                                        <a href="{item.full_url}">
                                            {item.caption}
                                        </a>
                                    </div>
                                    [[if loop.index%2 !=0 or loop.last]]
                                                                    <div class="cl"></div>
                                </div>
                                [[endif]]
        [[endif]]
        [[if loop.last and loop.index >7 ]]   
        		</div>
    		</li>
        [[endif]] 
        [[endfor]]
    </ul>
</div>
<div class="foto-menu">
	[[for item in items_place_main]]
    <div class="item [[if loop.index%3 == 0]]ls[[endif]]">
    	[[if item.picture]]
        <a href="{item.full_url}">
        	<img src="/{site_obj.fileDirectory}{item.id}/140_100_{item.picture}" width="140" height="100" alt="{item.title}"/>
        </a>
        [[endif]]
       <a href="{item.full_url}"class="h30px">{item.caption}</a>
    </div>
    [[endfor]]
</div>	
