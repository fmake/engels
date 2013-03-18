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
						<li class="[[if id_parent_page == cat.id or id_page == cat.id ]]active[[endif]]"><span><span><span><a href="{site_obj.getLinkPage(cat.id)}">{cat.caption}</a></span></span></span></li>
					[[endfor]]
				</ul>
			</div>
		[[endif]]
		<div class="cl"></div>
			
		<div style="padding-top: 30px;">

				<table style="width: 100%;" class="table_manual">
					[[for item in manuals]]
						<tr class="[[if loop.index%2==0]]zebr[[endif]]">
							<td>
								<a class="name_manual" href="{item.full_url}">{item.caption}</a>
								<p style="margin: 5px 0; padding: 5px 0; border-top: 1px #ccc dashed">
									<strong>Раздел</strong>: <a class="name_manual_categor" href="{site_obj.getLinkPage(item.parent)}">{item.name_category}</a>
								</p>
							</td>
							<td>
								{item.addres}
							</td>
							<td>
								{item.phone}
							</td>
						</tr>
					[[endfor]]
				</table>

		
			[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
		</div>                            
		{item.text|raw}
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "manual/right_block_baner.tpl"]]
[[endblock]]
