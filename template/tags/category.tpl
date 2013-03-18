[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	
	[[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]
	<div id="item_news">
		<h1>{item.caption} [[if info_tag]]({info_tag.name})[[endif]]</h1>
		[[for tag in tags]]
			<div class="shortnews">
				[[if tag.picture]]<a href="{tag.full_url}"><img alt="" src="/{site_obj.fileDirectory}{tag.id}/100_80_{tag.picture}" align="left"class="shortnewsimg"></a>[[endif]]
				/*<div class="date"><span>{df('date','d.m.Y',tag.date)}</span></div>*/
				<a href="{tag.full_url}">{tag.caption}</a>
				<p>	
					{tag.anons|raw}
				</p>
				[[set tags = tag.tags]]
				[[ include TEMPLATE_PATH ~ "blocks/tags.tpl"]]
			</div>
		[[endfor]]
		
		[[ include TEMPLATE_PATH ~ "pager/pager.tpl"]]
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endblock]]