[[if pages>1]]
	[[set url_page = site_obj.getLinkPage(id_page)]]
	<div class="page">
	<div class="nav">
		<ul>
			<li>Страницы: </li>
			[[if page==1]]
				
			[[else]]
					<li class="m10px"><a href="{url_page}page-1/[[if query_str]]?{query_str}[[endif]]" >Первая</a></li>
					<li class="m10px"><a href="{url_page}page-{page-1}/[[if query_str]]?{query_str}[[endif]]" >Предыдущая</a></li>
			[[endif]]
			[[if pages<=10]]
				[[set k1 = 1]]
				[[set k2 = pages]]
			[[else]]
				[[if page>0 and page<=7]]
					[[set k1 = 1]]
					[[set k2 = 9]]
					[[set k3 = 1]]
				[[elseif page<=pages and page>=pages-7]]
					[[set k1 = pages-9]]
					[[set k2 = pages]]
					[[set k3 = 2]]
				[[else]]
					[[set k1 = page-3]]
					[[set k2 = page+3]]
					[[set k3 = 3]]
				[[endif]]
			[[endif]]
			[[if k3==2 or k3==3]]
					<li><span><span><span><a href="{url_page}page-1/[[if query_str]]?{query_str}[[endif]]">1</a></span></span></span></li>
					<li>...</li>
			[[endif]]
			
			[[for i in k1 .. k2]]
				[[if page==i]]
					<li class="active"><a href="javascript: void(0);" ><span><span><span>{i}</span></span></span></a></li>
				[[else]]
					<li><a href="{url_page}page-{i}/[[if query_str]]?{query_str}[[endif]]"><span><span><span>{i}</span></span></span></a></li>
				[[endif]]
			[[endfor]]

			[[if k3==1 or k3==3]]
					<li>...</li>
					<li><a href="{url_page}page-{pages}/[[if query_str]]?{query_str}[[endif]]"><span><span><span>{pages}</span></span></span></a></li>
			[[endif]] 
			
			[[if page==pages]]
				
			[[else]]
					<li class="m10px"><a href="{url_page}page-{page+1}/[[if query_str]]?{query_str}[[endif]]" class="next">Cледующая</a></li>
					<li class="m10px"><a href="{url_page}page-{pages}/[[if query_str]]?{query_str}[[endif]]" class="last">Последняя</a></li>
			[[endif]]
		</ul>
	</div>
</div>
[[endif]]