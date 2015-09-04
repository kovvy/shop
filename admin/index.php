<?php

$login = 'root';
$password = '';
$host = 'localhost';
$db = 'site';

mysql_connect($host, $login, $password);
mysql_select_db($db);

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Админка</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/my.script.js"></script>
	<script src="js/menu.js"></script>
</head>
	<body>
		<table>
		<tr>
			<td width=250>
				<ul class="menu">
				 
				<li>
				  Категории
				  <ul class="element_menu">
					  <li><a href="index.php?do=categories/add_cat">Добавить категорию</a></li>
					  <li><a href="index.php?do=categories/add_pod_cat">Добавить под категорию</a></li>
				  </ul>
				 </li>
				  
				 <li>
				  Товары
				  <ul class="element_menu">
					  <li><a href="index.php?do=">Все товары</a></li>
					  <li><a href="index.php?do=">Добавить товар</a></li>
				  </ul>
				</li>
				 
				</ul>
			</td>
			<td>
				<?php
				if (!empty($_GET['do'])){
					$str = explode("/", $_GET['do']);
						include 'blocks/'.$str[0].'/'.$str[1].'.php';
				}
				?>
			</td>
		</tr>
		</table>
	</body>
</html>