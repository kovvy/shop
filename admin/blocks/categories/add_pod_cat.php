
	<form action="/admin/blocks/categories/add_form.php" method="post" id="dynamic_selects">
		<!-- Создаем заголовок для списка выбора типов транспорта -->
		<!-- Поле формы помещаем в контейнер с классом row -->
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

			<select name="pod_cat" id="kind" disabled>
				<option value="0">Выберите из списка</option>
			</select>
		</div>
		<hr>

		<div class="row">
			<label for="category">Под категории</label>

			<input type='text' name='name' />
			<p><input type='submit' value="Добавить под категорию" name='add_pod_cat' /></p>
		</div>
	</form>
