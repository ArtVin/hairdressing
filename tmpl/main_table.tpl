<table class="search">
	<tr>
		<td>Дата:</td>
		<td><input type="text" name="search_date"></td>
	</tr>
	<tr>
		<td>Работник:</td>
		<td>%workers%</td>
	</tr>
	<tr>
		<td><input type="submit" class="submit" name="search" value="Поиск"></td>
		<td><input type="submit" class="submit" name="now" value="На сегодня"></td>
	</tr>
</table>

<table id="order">
	<tr id="head">
		<th class="right_border bottom_border" >#</th>
		<th class="right_border bottom_border">Работник</th>
		<th class="right_border bottom_border">Клиент</th>
		<th class="right_border bottom_border">Услуга</th>
		<th class="right_border bottom_border">Длина волос</th>
		<th class="right_border bottom_border">Дата</th>
		<th class="right_border bottom_border">Время</th>
		<th class="right_border bottom_border">Часы</th>
		<th class="thin bottom_border">Стоимость</th>
	</tr>
	%main_table_tr%
</table>
