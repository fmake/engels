<div class="filters">
	Фильтр
	<form method="get">
		<input type="hidden" name="modul" value="{request.modul}" />
		<ul class="filter-list" >
			<li>Редакторы <br/>
				<select name="filter[create_user]">
					<option value="0">Выберите редактора</option>
					[[for item in all_users]]
						<option value="{item.id}" [[if filters.create_user == item.id]]selected[[endif]]>{item.name} ({item.login})</option>
					[[endfor]]
				<select>
			</li>
			<li>Дата<br/>
				с
				<input id="filter-date1" type="text" name="filter[date][to]" value="{filters['date']['to']}"><img src="/images/vcard_delete.png" onclick="$('#filter-date1').val('');"  />
				по
				<input id="filter-date2" type="text" name="filter[date][from]" value="{filters['date']['from']}"><img src="/images/vcard_delete.png" onclick="$('#filter-date2').val('');"  />
				
				<link rel="stylesheet" type="text/css" href="/styles/admin/datepicker.css" />
				<script type="text/javascript" src="/js/admin/datepicker.js"></script>
				[[raw]]
				<script type="text/javascript" >
				$(document).ready(function(){

					$('#filter-date1').DatePicker({
						format:'d.m.Y',
						date: '',
						current: '',
						starts: 1,
						onShow:function() {
							return false;
						},
						onChange:function(dateText) {
						   document.getElementById('filter-date1').value = dateText;
						   $('#filter-date1').DatePickerHide();
						}
					});
					$('#filter-date2').DatePicker({
						format:'d.m.Y',
						date: '',
						current: '',
						starts: 1,
						onShow:function() {
							return false;
						},
						onChange:function(dateText) {
						   document.getElementById('filter-date2').value = dateText;
						   $('#filter-date2').DatePickerHide();
						}
					});
					
				});
				</script>
				[[endraw]]
				
			</li>
			<li style="text-align:right;">
				<br/>
				<button onclick="" class="fmk-button-admin f10">
					<div><div><div>Применить</div></div></div>
				</button>
			</li>
		</ul>
	</form>
</div>