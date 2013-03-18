<a href="{site_obj.getLinkPage(4)}" class="h1"><h1>Афиша</h1></a>
    <div class="nav">
        <ul>
	[[for item in items_meets_cats]]
		<li><span><span><span><a href="{item.full_url}">{item.caption}</a></span></span></span></li>
	[[endfor]]
        </ul>
</div>

<div class="afisha">				
	
	<div id="foto-menu">
		[[ include TEMPLATE_PATH ~ "meets/meets_main.tpl"]]
	</div>
	<div class="preloader" id="preloader_meets"><img src="/images/pre.gif"></div>

    <div class="menu_day">
	    <div class="news-bar">
	        <div class="rb">
	            <div class="inside">
	                <div class="link">
	                    <a href="javascript:void(0);" class="arrow l"><img src="/images/icons/left_nav_bar.png" alt="туда" /></a>
	                    <div class="js-toolbar">
	                        <div class="hidden_tape">
	                        	<div id="spisok-items-week-date">
	                        	[[for item in calendar_meets]]
	                            	<a href="javascript:void(0)" id="item-week-date{loop.index}" class="[[if loop.first]]active a-bottom[[endif]]" onclick="getMeetsMain({item.date_full},{loop.index});" ><div>{item.day} {item.week}</div></a>
	                            [[endfor]]
	                        	</div>
	                        </div>
	                    </div>
	                    <a href="javascript:void(0);" class="arrow r"><img src="/images/icons/right_nav_bar.png" alt="сюда" /></a>
	                </div>
	            </div>
	        </div>
	    </div>
    <div class="cl"></div>
	</div>
</div>