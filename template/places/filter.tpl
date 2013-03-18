<div class="filters place">
	<form action="{site_obj.getLinkPage(5)}" method="get" id="search">
	    <input type="hidden" name="filter[action]" value="search" />
	    <input type="hidden" name="filter[check]" value="true" />
		<input type="text" name="filter[search_string]" value="{search_string}" title="Введите название" class="fieldfocus"/>
		<select name="filter[event_category]" onchange="">
			<option value="">Выберите категорию</option>
			[[for item in categories]]
				<option value="{item.id}" [[if item.id == event_category]]selected="selected"[[endif]]>{item.caption}</option>
			[[endfor]]
		</select>
		
		<button class="button" type="submit">
			<span class="button-left">
				<span class="button-right">
					<span class="button-text">
						<span>Найти</span>
					</span>
				</span>
			</span>
		</button>
	</form>
</div>