<form action="{site_obj.getLinkPage(1291)}" method="get" id="search">
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

	<div class="name_filter">Поиск</div>
	<div class="filters">
		<input type="hidden" name="action" value="search" />
		<select name="filter[type]" onchange="">
			<option value="">Выберите тип</option>
			[[for item in immovablesTypes]]
				<option value="{item.name}" [[if item.name == filters.type]]selected="selected"[[endif]]>{item.name}</option>
			[[endfor]]
		</select>
		<span >
			<span >Комнат: </span> 
			1 <input [[if filters.count_room_tmp.1]]checked="checked"[[endif]] type="checkbox" name="filter[count_room][]" value="1" /> 
			2 <input [[if filters.count_room_tmp.2]]checked="checked"[[endif]] type="checkbox" name="filter[count_room][]" value="2" /> 
			3 <input [[if filters.count_room_tmp.3]]checked="checked"[[endif]] type="checkbox" name="filter[count_room][]" value="3" />
			4+ <input [[if filters.count_room_tmp.4]]checked="checked"[[endif]] type="checkbox" name="filter[count_room][]" value="4" />
		</span>
		<span style="padding-left: 25px;">Стоимость: </span> 
		<input type="text" name="filter[price][to]" class="width80 fieldfocus" title="от" value="[[if filters.price.to]]{filters.price.to}[[endif]]" />&nbsp;-&nbsp;<input type="text" name="filter[price][from]" class="width80 fieldfocus" title="до" value="[[if filters.price.from]]{filters.price.from}[[endif]]" />
		<button class="button" type="submit" style="margin-top: -8px;">
			<span class="button-left">
				<span class="button-right">
					<span class="button-text">
						<span>Найти</span>
					</span>
				</span>
			</span>
		</button>
		<br/>
	</div>
</form>