<?php
if($_POST['add_cat']) {

	$id_categori = $_POST['cat'];
	$id_pod_categori = $_POST['pod_cat'];
	$id_pod_pod_categori = $_POST['pod_pod_cat'];
	$name = $_POST['name'];


	mysql_query("INSERT INTO goods (id_category, id_pod_category, id_pod_pod_category, name) VALUES ('$id_categori', '$id_pod_categori', '$id_pod_pod_categori', '$name')");
}
?>

<form enctype="multipart/form-data" method='POST'>
	<br>
	<p>Название под категории<select name='pod_cat'>
		<?php
			$result = mysql_query("SELECT * FROM category_podcategory");
			//$result = mysql_query("SELECT * FROM pod_category WHERE id_categori = '".$id."'");
			$cats = mysql_fetch_array($result);
			do {
				echo "<option value='".$cats['id']."'>" . $cats['name'] . "</option>";
			} while($cats = mysql_fetch_array($result));
		?>
	<p>Название под-под категории:<br/><input type='text' name='name' /></p>
	<p><input type='submit' value="Добавить тавар" name='add_cat' /></p>
</form>