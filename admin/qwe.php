<?php
$login = 'root';
$password = '';
$host = 'localhost';
$db = 'site';

mysql_connect($host, $login, $password);
mysql_select_db($db);

	  $result = mysql_query("SELECT * FROM categories WHERE parent_id <= 3 and parent_id != 0");

	  $menu = array();
	  if(mysql_num_rows($result) != 0) {
	    
	    for($i = 0; $i < mysql_num_rows($result);$i++) {
	      $row = mysql_fetch_array($result,MYSQL_ASSOC);
	      
	      $menu[$row['parent_id']][] = $row; 
	    }
	    }
	    print_r($menu);
?>