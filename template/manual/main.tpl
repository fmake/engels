[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	<script>
		{place_script|raw}
	</script>
    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]

	<div id="item_news">
		
		<h1>{modul.caption}</h1>
		<div class="add_advert_button">
			<a href="{advert_obj.getLinkPage(modul.id)}?form=add_manual">
				<button type="submit" class="button">
					<span class="button-left">
						<span class="button-right">
							<span class="button-text">
								<span><b>Добавить компанию</b></span>
							</span>
						</span>
					</span>
				</button>
			</a>
		</div>
		<table style="width:100%; margin-bottom:20px;">
			<tr>
				<td style="width:50%;padding-right:10px;">
				[[for cat in categories]]
					[[if loop.index%7 == 0]]
						</td>
						<td style="width:50%;padding-left:10px;">
					[[endif]]
					
					<div style="padding-top: 7px;"><a class="h3" href="{cat.full_url}">{cat.caption}</a>[[if cat.count]] ( {cat.count} )[[endif]]</div>
					[[if cat.child]]
						<p>
						[[for _cat in cat.child]]
							[[if loop.first]]
								<a href="{_cat.full_url}">{_cat.caption}</a>
							[[else]]
								&nbsp;/&nbsp;<a href="{_cat.full_url}">{_cat.caption}</a>
							[[endif]]
						[[endfor]]
						</p>
					[[endif]]
				[[endfor]]
				</td>
			</tr>
		</table>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "manual/right_block_baner.tpl"]]
[[endblock]]