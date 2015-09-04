	<form action="/admin/blocks/categories/add_form.php" method="post" id="dynamic_selects">

		<div class="row">
			<label for="type">Главные категории:</label>

			<select name="cat" id="type">
				<option value="0">Выберите из списка</option>
				<option value="1">Отопление</option>
				<option value="2">Водоснобжение</option>
				<option value="3">Инструменты</option>
			</select>
		</div>
		<hr>

		<div class="row">
			<label for="kind">Категории:</label>

			<input type='text' name='name' />
			<input type='submit' value="Добавить категорию" name='add_cat' />
		</div>
	</form>