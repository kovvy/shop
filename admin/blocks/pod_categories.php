<?php
if($_POST['add_cat']) {

	mysql_query("INSERT INTO category_podcategory (id_category_title, name) VALUES ('".$_POST['cat']."', '".$_POST['name']."')");
}
?>

<form enctype="multipart/form-data" method='POST'>

	<br>
	<p><select name='cat'>
		<?php
			$result = mysql_query("SELECT * FROM categories");
			$cats = mysql_fetch_array($result);
			do {
				echo "<option value='".$cats['id']."'>" . $cats['title'] . "</option>";
			} while($cats = mysql_fetch_array($result));
		?>

	</select></p>
	<p>Название под категории:<br/><input type='text' name='name' /></p>
	<p><input type='submit' value="Добавить категорию" name='add_cat' /></p>

</form>