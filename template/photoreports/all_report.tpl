[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]

	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption}</h1>
		
		[[if categories]]
			<div class="nav">
				<ul>
					[[set id_parent_page = item.parent]]
					[[set id_page = item.id]]
					[[for cat in categories]]
						<li class="[[if id_parent_page == cat.id or id_page == cat.id ]]active[[endif]]"><a href="{site_obj.getLinkPage(cat.id)}"><span><span><span><div class="dotted">{cat.caption}</div></span></span></span></a></li>
					[[endfor]]
				</ul>
			</div>
		[[endif]]
		<div class="cl"></div>
		<br/>
		[[for report in reports]]
			<div class="fotolist [[if loop.index%3==0]]mrg0[[endif]]">
				[[if report.picture]]<a href="{report.full_url}"><img src="/{reports_obj.fileDirectory}{report.id}/232_155_{report.picture}" alt=""></a>[[endif]]
				<div class="fotoinfo">
					<span class="date">{df('date','d.m.Y',report.date)}</span>
					<span class="view">{gallery_obj.getCountPhoto(report.id)}</span>
					<div style="clear:both;"></div>
				</div>
				<a href="{report.full_url}" class="fotolink">{report.caption}</a>
			</div>
		[[endfor]]
		<div style="clear:both;"></div>
		<div class="mbg"></div>
		
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>
	
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "photoreports/right_block_baner.tpl"]]
[[endblock]]