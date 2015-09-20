<script type="text/javascript" src="/js/imagecms.filter.js"></script>
<script type="text/javascript" src="/js/jquery.ui-slider.js"></script>


    <div class="container_s">
        <div class="inside">
            <div class="container_sm-st">
                <div class="catalog_content">
                    <div class="f_l">
                        <div id="fon"></div>
                        <div id="load"></div>
                        <div class="block_d-i" id="<?=$app -> module -> id?>">
                            <h1><?=$app -> module -> category?></h1>
                        </div>

                            <div class="f_l f-s_12em sort">
                                <input class="helper">
                                <span>Сортировать:</span>
                                <span class="pointer"><span class="d_l_r">По цене</span><span class="icon arrow_red"></span></span>
                                    <span class="drop sort_current">
                                        <span id="pricea">Сначала дешевые</span>
                                        <span id="priced">Сначала дорогие</span>
                                    </span>
                            </div>

                        <form name="product" method="POST" action="">
                            <ul class="items items_middle">
                                <?php
                                    foreach ($app -> module -> product as $product){
                                        echo '
                                                <li>
                                                    <div class="description f_r">
                                                        <a href="?module=Product/' .$product['id']. '">' .$product['title']. '</a>
                                                        <div class="f_l">
                                                            <div class="price-f-s_24 clearfix">
                                                                <span class="grn">' .$product['price_g']. ' грн.</span><br>
                                                                    <span class="dol">
                                                                        <span class="val_sum ">' .$product['price_g']. '</span>
                                                                        <span class="pointer"><span class="d_l_r">$</span><span class="icon arrow_red"></span></span>
                                                                        <span class="drop">
                                                                            <span class="USD">$</span>
                                                                            <span class="RUR">руб</span>
                                                                            <span class="EUR">€</span>
                                                                        </span>
                                                                </span>
                                                            </div>
                                                            ' .$app -> module -> get_status($product['status']). '

                                                            <button class="but_buy_m f_l goBuy" type="submit" name="button" value="' .$product['id']. '">
                                                                <span>В корзину</span>
                                                            </button>

                                                            <button class="but_order_b f_l goCart d_n_">
                                                                <span>
                                                                  <span>Оформить заказ</span>
                                                                  <span>товар уже в корзине</span>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <p>
                                                        </p>
                                                    </div>

                                                    <a href="?module=Product/' .$product['id']. '" class="photo_block f_l">
                                                        <figure>
                                                            <img src="/images/product/' .$product['img']. '_small.jpg" alt="' .$product['title']. '">
                                                        </figure>
                                                    </a>
                                                </li>
                                            ';
                                    }
                                ?>
                            </ul>
                        </form>
                        <div class="shadow_catalog"></div>
                    </div>
                    <div class="right_inside">
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

                <div class="left_inside">

                    <div class="block_filter p_0">
                        <div class="title title_first">Тип</div>
                        <div class="padding_filter">
                            <div id="typecat">
                                <?php
                                    foreach($app -> module -> categories as $cat){
                                        echo '
                                            <a class="t-d_n d_i-b" href="?module=Category/' .$cat['title'].'"><span>'.$cat['title'].'</span></a>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>


                    <form name="sortPrice" method="POST" action="">

                        <div class="block_filter">
                            <div class="title">Цена</div>
                            <div class="sliderCont">
                                <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                    <a class="ui-slider-handle ui-state-default ui-corner-all" id="left_slider" style="left: 0%;"></a>
                                    <a class="ui-slider-handle ui-state-default ui-corner-all" id="right_slider" style="left: 50%;"></a>
                                    <div class="ui-slider-range ui-widget-header" style="left: 0%; width: 80%;"></div></div>
                            </div>
                            <?php
                            foreach($app -> module -> price as $sort) {
                            echo '
                            <div class="formCost">
                                <label class="f_l">
                                    от
                                    <input type="text" id="minCost" value="' .$sort['pricemin']. '" name="pricemin">
                                </label>
                                <label class="f_r">
                                    до
                                    <input type="text" id="maxCost" value="' .$sort['pricemax']. '" name="pricemax">
                                </label>
                                <button type="submit" ><span>Поиск</span></button>
                            </div>
                            ';
                            }
                            print_r($_POST);
                            ?>
                        </div>
                    </form>


                    <div class="block_filter filter_ajax_checks">
                        <form name="sortBrand" method="POST" action="">
                            <div class="padding_filter check_frame">
                                <div class="title">Бренды</div>
                                <?php
                                    foreach($app -> module -> brands as $brand){
                                        echo '
                                                <span class="frame_label">
                                                    <span>
                                                        <span class="niceCheck" style="background-position: -196px -21px;"><input name="brand[]" value="' .$brand['id']. '" type="checkbox"></span>
                                                        <span class="name">' .$brand['title']. '</span>
                                                    </span>
                                                </span>
                                        ';
                                    }
                                ?>
                                <button type="submit"><span>Поиск</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow_inside"></div>