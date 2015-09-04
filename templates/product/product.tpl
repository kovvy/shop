    <div class="container_s">
        <?php
        foreach($app -> module -> product as $prod) {
        print_r($_POST);
        echo '<div class="inside">
            <div class="tovar_frame items clearfix">
                <div class="description f_r" itemscope="" itemtype="http://schema.org/Product">
                    <div class="block_d-i clearfix">
                        <br>
                        <h1 itemprop="name">' .$prod['title']. '</h1>
                    </div>
                    <div class="clearfix">
                        <div class="f_l">

                            <div class="price-f-s_36 f_l-c_l" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                <span class="grn f_l-c_l " itemprop="price">' .$prod['price_g']. ' грн.</span>
                    <span class="dol f_l-c_l"><span class="cur">' .$prod['price_d']. '</span>
                        <span class="pointer"><span class="d_l_r">$ </span><span class="icon arrow_red"></span></span>
                </span>
                            </div>
                        </div>
                    <form method="POST" action="">
                        <div class="f_r w_410">
                            <div class="f_l">

                                ' .$app -> module -> get_status($prod['status']). '
                                <button class="normal but_buy_b goBuy" type="submit" name="button_buy" value="' .$prod['id']. '"><span>В корзину</span></button>
                                <div>
                                    <button class="kredit but_buy_b goBuy" type="submit" name="button buy_credit" value="' .$prod['id']. '">
                                        <span>Купить в кредит</span>
                                    </button>
                                </div>

                            </div>
                            <div class="f_r">
                                <div class="refer_ajax">
                                    <span class="d_b"><span class="icon ask_que"></span><span id="callback_tov" class="d_l_r f-s_12">Задать вопрос по товару</span></span>

                    <span class="d_b">
                                                    <span class="icon add_to_c"></span>
                            <span data-id="2962" class="add_to_comp d_l_r f-s_12">Добавить к сравнению</span>
                            <a href="" class="d_n_ do_comp"><span class="f-s_12">Сравнить</span></a>
                                            </span>
                                </div>
                            </div>
                        </div>
                            </form>
                    </div>
                    <div class="info_order_wrap">
                        <div class="info_order">
                            <img src="/images/main/info_order.png" class="info_order_corner">
                            <ul>
                                <li>
                                    <span class="title">Заказ по телефонам:</span>
                                    <ul>
                                        <li class="f_l">
                                            <div>(067) 340-71-49</div>
                                            <div>(067) 340-71-45</div>
                                        </li>
                                        <li class="f_l">
                                            <div>(044) 38-38-299</div>
                                            <div>0-800-501-821</div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <ul>
                                        <li>Предоплата</li>
                                        <li>Послеоплата (наложенным платежом)</li>
                                        <li>Покупка в кредит</li>
                                    </ul>
                                </li>
                                <li>
                                    <ul>
                                        <li>Самовывоз</li>
                                        <li>Доставка по Украине</li>
                                        <li>Доставка во Львове</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="f_l tovar_photo">
                    <div class="thumbs_frame f_l">
                        <a rel="gallery" href="/images/product/' .$prod['img']. '_1.jpg" class="fancy active photo_block">
                            <figure>
                                <img style="width:60px" src="/images/product/' .$prod['img']. '_1.jpg">
                            </figure>
                        </a>
                        <a rel="gallery" href="/images/product/' .$prod['img']. '_2.jpg" class="fancy active photo_block">
                            <figure>
                                <img style="width:60px" src="/images/product/' .$prod['img']. '_2.jpg">
                            </figure>
                        </a>
                        <a rel="gallery" href="/images/product/' .$prod['img']. '_3.jpg" class="fancy active photo_block">
                            <figure>
                                <img style="width:60px" src="/images/product/' .$prod['img']. '_3.jpg">
                            </figure>
                        </a>
                    </div>
                    <div class="f_r">
                        <a rel="gallery" href="/images/product/' .$prod['img']. '_main.jpg" class="fancy photo_block">
                            <figure>
                                <img src="/images/product/' .$prod['img']. '_main.jpg">
                            </figure>
                        </a>
                    </div>
                </div>
            </div>

            <div class="container_sm-st">

                <ul class="f_l tabs">

                    <li data-tab="t_1" class="active"><span class="d_l_g">Описание товара</span></li>
                    <li data-tab="t_2"><span class="d_l_g">Характеристики</span></li>
                    <li class="d_n_" data-tab="t_5"><span class="d_l_g">Отзывы (<i id="vid">0</i>)</span></li>

                </ul>
                <div class="leave_coment">
                    <span class="pointer"><span class="d_l_r">Отзывы к ' .$prod['title']. '</span><span class="icon arrow_red"></span></span>
                    <!--Здесь нехуя не работает--><form class="form_comment" method="POST" action="index.php?module=Product/' .$prod['id']. '" novalidate="novalidate">
                        <div class="standart_form">

                            <input type="hidden" name="comment_item_id" value="' .$prod['id']. '">
                            <label>
                                Ваше имя
                                <input class="required" type="text" name="comment_author">
                            </label>
                            <label>
                                Комментарий
                                <textarea class="required" name="comment_text" rows="5"></textarea>
                            </label>
                            <button class="but_buy_m f_l"  type="submit" name="button comment">
                                <span>Оставить отзыв</span>
                            </button>

                        </div>
                         </form>
                </div>
                <div class="tabs_container f_l text" data-tab="t_1" style="display: block;">
                    ' .$prod['description']. '
                </div>
                <div class="tabs_container f_l" data-tab="t_2" style="display: none;">

                    <table class="characteristic">
                        <tbody>
                        ' .$prod['characteristic']. '
                        </tbody>
                    </table>
                </div>
                    ';
                    }
                ?>

                <div class="f_r action_block">
                    <div class="title_h2">Акционные товары</div>
                    <ul class="items items_small">
                        <?php
                            foreach($app -> module -> sale as $sale){
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

                    <div class="why-us">
                        <div class="title_h2">Почему выбирают нас?</div>
                        <ul>
                            <li><span class="icon-w1 f_l"></span><div>Гибкие скидки для
                                    наших клиентов</div></li>
                            <li><span class="icon-w2 f_l"></span><div>Достойная репутация
                                    на рынке</div></li>
                            <li><span class="icon-w3 f_l"></span><div>Высокий уровень
                                    обслуживания</div></li>
                            <li><span class="icon-w4 f_l"></span><div>обслуживания
                                    Минимальные сроки
                                    оформления</div></li>
                            <li><span class="icon-w5 f_l"></span><div>Высокое качество
                                    продукции и широкий ассортимент</div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow_inside"></div>
    </div>

