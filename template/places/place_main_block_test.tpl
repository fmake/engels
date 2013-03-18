<table style="margin-bottom: 10px;">
	<tr>
	[[for item in items_place_main]]
		<td style="width: 140px;padding: 10px;">
			[[if item.picture]]
				<a href="{item.full_url}"><img alt="{item.title}" src="/{site_obj.fileDirectory}{item.id}/80_80_{item.picture}" width="140" height="100" style="border-radius: 4px 4px 4px 4px;box-shadow: 0 0 4px rgba(0,0,0,0.5);"></a>
			[[endif]]
			<p style="padding-top: 3px;"><a href="{item.full_url}">{item.caption}</a></p>
		</td>
		[[if loop.index%3 == 0]]
			</tr><tr>
		[[endif]]
	[[endfor]]
	</tr>
</table>