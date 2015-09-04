
    <div class="container_s">
        <?php
        foreach($app -> module -> brand as $brands) {
            echo '
        <div class="inside">
            <div class="container_sm-st">
                <div class="catalog_content search_content">
                    <div class="f_l">
                        <div class="seo_text text block_brand clearfix">
                            <figure class="f_l">
                                <img src="/images/slider/brands/' .$brands['img']. '" alt="' .$brands['title']. '">
                            </figure>
                            ' .$brands['text']. '

                        </div>

                        <div class="f_l block_d-i">
                            <h2>' .$brands['title']. '</h2><i></i>
                        </div>
                        ';
                        }
                        ?>
                        <form method="POST" action="">
                            <ul class="items items_middle">
                                <?php
                                    foreach($app -> module -> products as $product){
                                        echo '
                                                <li>
                                                    <div class="description f_r">
                                                        <a href="?module=Product/' .$product['id']. '">' .$product['title']. '</a>
                                                        <div class="f_l">
                                                            <div class="price-f-s_24 clearfix">
                                                                <span class="grn">' .$product['price_g']. ' грн.</span><br>
                                                                            <span class="dol">
                                                                                <span class="val_sum ">' .$product['price_d']. '</span>
                                                                                <span class="pointer"><span class="d_l_r">$</span><span class="icon arrow_red"></span></span>
                                                                        </span>
                                                            </div>
                                                            <button class="but_buy_m f_l goBuy" type="submit" name="button" value="' .$product['id']. '"><span>В корзину</span></button>
                                                            <button class="but_order_b f_l goCart d_n_">
                                                                <span><span>Оформить заказ</span><span>товар уже в корзине</span></span>
                                                            </button>
                                                            <span class="pointer f_l-c_l toCompare" data-prodid="' .$product['id']. '"><span class="icon add_to_c"></span><span class="d_l_r f-s_11em">Добавить к сравнению</span></span>
                                                            <a href="?module=Compare/' .$product['id']. '" class="f_l-c_l compare_this d_n_ f-s_10"><span class="icon add_to_c"></span><span class="f-s_11">Сравнить</span></a>
                                                        </div>
                                                    </div>

                                                    <a href="?module=Product/' .$product['id']. '" class="photo_block f_l">
                                                        <figure>
                                                            <img src="/images/product/' .$product['price_d']. '_small.jpg" alt="' .$product['title']. '">
                                                        </figure>

                                                    </a>
                                                </li>
                                        ';
                                    }
                                ?>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow_inside"></div>
    </div>