[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ block left_content ]]
	<div id="left">
		[[ include TEMPLATE_PATH ~ "admin/blocks/leftmenu.tpl" ]]
		
		[[if mod.id==125]]
			[[ include TEMPLATE_PATH ~ "admin/blocks/filter_inteview.tpl" ]]
		[[endif]]
	</div>
[[endblock]]

[[block center]]

<h1>{mod.caption}</h1>
[[if not add_hidden]]<button class="fmk-button-admin" onclick="document.location='/admin/?modul={request.modul}[[if hiden_param_seo]]&dop_polya=hide[[endif]][[if request.id_interview]]&id_interview={request.id_interview}[[endif]]&action=new';return false;"><div><div><div>Добавить</div></div></div></button>[[endif]]
[[if config_modul]]<button class="fmk-button-admin" onclick="document.location='{config_modul}';return false;"><div><div><div>Настройки</div></div></div></button>[[endif]]
[[if add_button]]{add_button|raw}[[endif]]
<br /><br />
[[if content]]
		{content}
		<BR><BR>
	[[ endif ]]
	
	[[if pages]]
		<div class="pager" >
		[[for i in 1..pages]]
			<span><a href="/admin/index.php?modul={request.modul}&page={i}" [[if i==page ]]class="active"[[endif]] title="Страница {i}" >{i}</a></span>  
		[[endfor]]
		</div>
	[[endif]]
	
	<table border="0" cellspacing="1" cellpadding="0" class="main-table"  id="main-table">
	<thead>
		<tr class="td-header" >
	[[for fild in filds]]
		<td>{fild}</td>
	[[endfor]]
	
	<td >Управление</td>
	</tr>
	</thead>
	
	<tbody>
		[[for key,item in items]]
			<tr class="td-item">		
				
			[[for key,fild in filds]]
			<td  
				[[if loop.first]]
					style="padding: 0 0 0 {item['level']*20+20}px"
				[[endif]]
				>{item[key]|raw}</td>	
			[[endfor]]
			<td valign="middle" align="center">
				[[ include TEMPLATE_PATH ~ "admin/blocks/actions.tpl" ]]
			</td>
			</tr>
		[[endfor]]	
	</tbody></table>
[[endblock]]	