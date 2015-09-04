<?php

	function view_cat($arr,$parent_id = 0) {

	    if(empty($arr[$parent_id])) {
	      return;
	    }

	    for($i = 0; $i < count($arr[$parent_id]);$i++) {
	      echo '
	      		<li><a href="?module=Category/' .$arr[$parent_id][$i]['title'].'"><span class="icon heat_air"></span>'
	            .$arr[$parent_id][$i]['title'].'</a>';
	      view_dcat($arr,$arr[$parent_id][$i]['id']);
	      echo '
	      		</li>';
	    }
	}

	function view_dcat($arr,$parent_id = 0) {

	    if(empty($arr[$parent_id])) {
	      return;
	    }
	    echo '
	    		<div class="drop_menu">
	            	<div class="f_l">                
	              		<ul>';
	    for($i = 0; $i < count($arr[$parent_id]);$i++) {
	      echo '
	      					<li><a href="?module=Category/' .$arr[$parent_id][$i]['title'].'" class="title">'
	            .$arr[$parent_id][$i]['title'].'</a>';
	      view_pcat($arr,$arr[$parent_id][$i]['id']);
	      echo '
	      					</li>';
	    }
	    echo '
	    				</ul>';
	}

	function view_pcat($arr,$parent_id = 0) {

	    if(empty($arr[$parent_id])) {
	      return;
	    }

	    for($i = 0; $i < count($arr[$parent_id]);$i++) {
	      echo '
	      						<li><a href="?module=Category/' .$arr[$parent_id][$i]['title'].'">'
	            .$arr[$parent_id][$i]['title'].'</a>';
	      view_cat($arr,$arr[$parent_id][$i]['id']);
	      echo '
	      						</li>';
	    }
	}

  	function view_fmenu($arr,$parent_id = 0) {

	    if(empty($arr[$parent_id])) {
	      return;
	    }

	    for($i = 0; $i < count($arr[$parent_id]);$i++) {
	      echo '
	      							<ul>';
	      echo '<li class="title"><a href="?module=Category/' .$arr[$parent_id][$i]['title'].'">'
	            .$arr[$parent_id][$i]['title'].'</a>';
	      echo '
	      							</ul>';
	    }
	}
?>