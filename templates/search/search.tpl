
    <div class="container_s">
        <div class="inside">
            <div class="container_sm-st">
                <div class="catalog_content search_content">
                    <div class="f_l">
                        <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                            <div class="f-s_16">Результаты поиска по запросу <b>"<?=$app -> module -> search?>"</b>:</div>
                        </div>
                        <form method="POST" action="">
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
                                                                <span class="val_sum ">' .$product['price_d']. '</span>
                                                                <span class="pointer"><span class="d_l_r">$</span><span class="icon arrow_red"></span></span>
                                                            </span>
                                                        </div>

                                                        ' .$app -> module -> get_status($product['status']). '
                                                        <button class="but_buy_m f_l goBuy" name="button buy" type="submit" value="' .$product['id']. '">
                                                            <span>В корзину</span>
                                                        </button>

                                                    </div>
                                                    <p>
                                                    </p>
                                                </div>
                                                <a href="?module=Product/' .$product['id']. '" class="photo_block f_l">
                                                    <figure>
                                                        <img src="/images/product/' .$product['img']. '_small.jpg">
                                                    </figure>
                                                </a>
                                            </li>
                                    ';
                                }
                            ?>
                        </ul>
                            </form>
                        <div class="pagination">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow_inside"></div>
    </div>