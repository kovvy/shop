    <div class="container_s">
    	<div class="inside">
	        <div class="container_sm-st_2">
	            <h1><?=$app -> module -> category?></h1>
	            <ul class="sub_category f_l">
                    <?php

						for($i = 0; $arr = $app -> module -> categories, $i < count($arr[$i]); $i++){
							echo '
									<li>
										<div class="photo">
											<img src="/images/menu/'.$arr[$i]['img'].'"/>
										</div>
										<ul>

											<li><a class="title" href="?module=Category/' .$arr[$i]['title'].'">'.$arr[$i]['title'].'</a></li>
											';
											$id = $arr[$i]['id'];
												for($j = 0; $j < count($arr[$id]); $j++){
													echo '
															<li><a href="?module=Category/' .$arr[$id][$j]['title'].'">'.$arr[$id][$j]['title'].'</a></li>
													';
												}
											echo '
										</ul>
									</li>
							';
						}
					?>
				</ul>

				<div class="right_inside">
                        <a href="?module=Category/Котлы" class="baner_catalog">
                            <figure>
                                <img src="/images/menu/kotel_leb.jpg" alt="banner">
                            </figure>
                        </a>
                    <div class="action_block">
	                    <div class="title_h2">Акционные товары</div>
	                    <ul class="items items_small">
							<?php
								foreach ($app -> module -> sale as $sale){
									echo '
										<li>
											<div class="description f_r">
												<div class="d_t-c">
													<a href="?module=Product/' .$sale['id']. '">' .$sale['title']. '</a>
													<div class="price-f-s_14"><span class="grn">' .$sale['price_g']. ' грн</span><span class="dol">' .$sale['price_d']. ' $</span></div>
												</div>
											</div>
											<a href="?module=Product/' .$sale['id']. '" class="photo_block">
												<figure>
													<img src="/images/product/' .$sale['img']. '_small.jpg">

												</figure>
											</a>
										</li>
									';
								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
        <div class="shadow_inside"></div>
    </div>