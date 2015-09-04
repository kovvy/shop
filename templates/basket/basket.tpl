
    <div class="container_s">
        <div class="inside">
            <div class="container_sm-st_2">
                <h1>Оформление заказa</h1>
                <form method="post" action="">
                    <div class="clearfix cart-out">
                        <div class="right-cart">
                            <div class="order_frame">
                                <div class="f_l p_r">
                                    <div class="cart-new-table" id="cart_container">
                                        <table cellpadding="0">
                                            <colgroup>
                                                <col span="1" width="255">
                                                <col span="1" width="235">
                                                <col span="1" width="195">
                                            </colgroup>
                                            <tbody>
                                                <?php
                                                    foreach($app -> module -> product as $product){
                                                        echo '
                                                                <tr>
                                                                    <td>
                                                                        <ul class="items items_small">
                                                                            <li>
                                                                                <div class="description f_r">
                                                                                    <div class="d_t-c">
                                                                                        <a href="?module=Product/' .$product['id']. '">' .$product['title']. '</a>
                                                                                        <div class="price-f-s_14"><span class="grn">' .$product['price_g']. ' грн.</span><span class="dol">' .$product['price_d']. ' $</span></div>
                                                                                    </div>
                                                                                </div>
                                                                                <a href="?module=Product/' .$product['id']. '" class="photo_block">
                                                                                    <figure>
                                                                                        <img src="/images/product/' .$product['img']. '_small.jpg" alt="">
                                                                                    </figure>
                                                                                </a>
                                                                                <a href="?module=Basket/' .$product['id']. '" class="icon delete"></a>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td class="t-a_c">
                                                                        <span class="d_i-b count">
                                                                            <input onchange="total_score()" name="quantity[]" type="text" value="1"><span>шт.</span>
                                                                            <input type="hidden" name="idProduct[]" value="' .$product['id']. '">
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="price-f-s_30"><span class="grn">' .$product['price_g']. ' грн.</span><br><span class="dol">' .$product['price_d']. ' $</span></div>
                                                                    </td>
                                                                </tr>
                                                        ';
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="gen_sum_cleaner"></div>
                                        <div class="price-f-s_36">
                                            <span class="grn d_b">
                                                <span class="f-w_b" style="font-size:26px;color:#666666;">К оплате:</span>
                                                <span class="total_score"><?php $app -> module -> view_priceProduct($app -> module -> product); ?></span> грн.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-cart">
                            <div class="cart-user-info">
                                <div class="title_h2 off_f-s">Данные получателя</div>
                                <div class="standart_form address_recip new_cart">
                                    <div class="">
                                        <label class="clearfix">
                                            <span class="title">Ваше имя<span class="must">*</span></span>
                                            <span class="frame_title"><input class="required" type="text" name="fullName" value=""></span>
                                        </label>
                                        <label class="clearfix">
                                            <span class="title">Телефон<span class="must">*</span></span>
                                            <span class="frame_title"><input class="required" type="text" name="phone" value=""></span>
                                        </label>
                                    </div>
                                    <div class="">
                                        <label class="clearfix">
                                            <span class="title">E-mail<span class="must">&nbsp;</span></span>
                                            <span class="frame_title"><input class="email required" type="text" name="email" value=""></span>
                                        </label>
                                        <label class="clearfix">
                                            <span class="title">Адрес<span class="must">&nbsp;</span></span>
                                            <span class="frame_title"><input type="text" name="addres" value=""></span>
                                        </label>
                                    </div>
                                    <div class="">
                                        <label class="clearfix">
                                            <span class="title">Комментарий<span class="must">&nbsp;</span></span>
                                            <span class="frame_title"><textarea name="commentText"></textarea></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="other_methods clearfix">
                                <div class="title_h2 off_f-s">Выберите способ доставки</div>
                                <ul>
                                    <li>
                                        <dl class="frame_label active">
                                            <dt>
                                        <span class="niceCheck radio_nice" style="background-position: -268px 0px;">
                                            <input type="radio" checked="checked" name="deliveryMethodId" value="1">
                                        </span>
                                                <span class="name">Самовывоз</span>
                                            </dt>
                                            <dd><p>Покупатель забирает товар со склада</p></dd>
                                        </dl>
                                    </li>
                                    <li>
                                        <dl class="frame_label">
                                            <dt>
                                        <span class="niceCheck radio_nice" style="background-position: -255px 0px;">
                                            <input type="radio" name="deliveryMethodId" value="2">
                                        </span>
                                                <span class="name">Доставка во Львове</span>
                                            </dt>
                                            <dd><p>Бесплатно при покупке на сумму от 5000 грн.</p>
                                                <p>Доставка товаров свыше 100кг и крупногабаритных товаров - по договоренности.</p></dd>
                                        </dl>
                                    </li>
                                    <li>
                                        <dl class="frame_label">
                                            <dt>
                                        <span class="niceCheck radio_nice" style="background-position: -255px 0px;">
                                            <input type="radio" name="deliveryMethodId" value="3">
                                        </span>
                                                <span class="name">Доставка по Украине</span>
                                            </dt>
                                            <dd><p>Доставка по Украине осуществляется в любой населенный пункт курьерскими службами: "Новая Почта", "Ин-Тайм"</p></dd>
                                        </dl>
                                    </li>
                                </ul>
                            </div>



                            <div class="other_methods clearfix paymethods">

                                <div class="title_h2 off_f-s">Выберите способ оплаты</div>
                                <ul>
                                    <li>
                                        <dl class="frame_label active">
                                            <dt>
                                        <span class="niceCheck radio_nice" style="background-position: -268px 0px;">
                                            <input type="radio" checked="checked" name="paymentMethodId" value="2">
                                        </span>
                                                <span class="name">Послеоплата (наложенным платежом)</span>
                                            </dt>
                                            <dd><p>На склад "Новой Почты" или "Ин-Тайм" при получении товара.</p></dd>
                                        </dl>
                                    </li>
                                    <li>
                                        <dl class="frame_label">
                                            <dt>
                                        <span class="niceCheck radio_nice" style="background-position: -255px 0px;">
                                            <input type="radio" name="paymentMethodId" value="1">
                                        </span>
                                                <span class="name">Предоплата</span>
                                            </dt>
                                            <dd><p>Зачисление денег осуществляется через пополнение карточного счета.</p></dd>
                                        </dl>
                                    </li>
                                </ul>
                            </div>

                            <div class="footer_order">
                                <button class="but_order_bb f_l" name="goToPay" type="submit"><span>Оформить заказ</span></button>
                            </div>

                        </div>

                    </div>

                    </form>
            </div>
        </div>
        <div class="shadow_inside"></div>
    </div>