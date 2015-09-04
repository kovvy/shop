<?php

$login = 'root';
$password = '';
$host = 'localhost';
$db = 'site';

mysql_connect($host, $login, $password);
mysql_select_db($db);

if (isset($_POST['add_cat'])) {

	mysql_query("INSERT INTO categories (parent_id, title) VALUES ('".$_POST['cat']."', '".$_POST['name']."')");
	return;
}

if (isset($_POST['add_pod_cat'])) {

	mysql_query("INSERT INTO categories (title, parent_id) VALUES ('".$_POST['name']."', '".$_POST['pod_cat']."')");
	return;
}



?>