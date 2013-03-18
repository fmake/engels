<div class="filters">
	Фильтр
	<form method="get">
		<input type="hidden" name="modul" value="{request.modul}" />
		<ul class="filter-list" >
			<li>
				<select name="id_interview">
					<option value="0">Выберите вопрос</option>
					[[for item in categories]]
						<option value="{item.id}" [[if request.id_interview == item.id]]selected[[endif]]>{item.caption}</option>
					[[endfor]]
				<select>
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