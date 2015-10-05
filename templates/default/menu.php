<?php

	function view_cat($arr,$parent_id = 0) {

		if($parent_id == 0) {
			for ($i = 0; $i < count($arr[$parent_id]); $i++) {
				echo '
				<li>
					<a href="#" class="btn btn-menu"><i class="ic-list"></i>Каталог товаров <i class="ic-arrow-down-white"></i></a>
							<ul class="panel-menu arrow" style="display: none;">
								<li class="close-menu"><a href="#">&larr;</a></li>';
					view_dcat($arr, $arr[$parent_id][$i]['id']);
					echo '
								<li><a href="#">Все бренды <i class="ic-arrow-right"></i></a></li>
								<li class="divider"></li>
								<li class="sale"><a href="#"><strong>Распродажа</strong></a></li>
							</ul>
	      		</li>
	      		';
				break;
			}
		}

		$j = 1;
		for($i = 0; $i < count($arr[$parent_id]);$i++) {
			echo '
				<li>
					<span class="sp">' .$arr[$parent_id][$i]['title']. ' <i class="ic-arrow-down-white"></i></span>
							<ul class="panel-menu-' .$j. ' arrow" style="display: none;">
								<li class="close-menu"><a href="#">&larr;</a></li>';
									view_dcat($arr,$arr[$parent_id][$i]['id']);
			echo '
								<li><a href="#">Все бренды <i class="ic-arrow-right"></i></a></li>
								<li class="divider"></li>
								<li class="sale"><a href="#"><strong>Распродажа</strong></a></li>
							</ul>
	      		</li>
	      		';
			$j++;
		}
	}

	function view_dcat($arr,$parent_id = 0) {

	    for($i = 0; $i < count($arr[$parent_id]);$i++) {
	      echo '
							<li class="selected">
                                <a href="?module=Category/' .$arr[$parent_id][$i]['title']. '">' .$arr[$parent_id][$i]['title']. ' <i class="ic-arrow-right"></i></a>
                                ';
	      						view_pcat($arr,$arr[$parent_id][$i]['id']);
	      echo '
							</li>';
	    }
	}

	function view_pcat($arr,$parent_id = 0) {
		if (empty($arr[$parent_id])) return;

		echo '<ul>';
	    for($i = 0; $i < count($arr[$parent_id]);$i++) {
	      echo '
									<li><a href="?module=Category/' .$arr[$parent_id][$i]['title']. '">' .$arr[$parent_id][$i]['title']. ' <i class="ic-arrow-right"></i></a></li>';
	    }
		echo '
				</ul>';
	}
