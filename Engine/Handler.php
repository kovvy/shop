<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 10.09.2015
 * Time: 20:22
 */
$db = connectDB();

if($_GET['sort_id']){
    $str = explode("/", $_GET['sort_id']);
    $goods = get_goods($db, $str[0], $str[1]);

    foreach($goods as $item) {
        echo '
               <li>
                                                    <div class="description f_r">
                                                        <a href="?module=Product/' .$item['id']. '">' .$item['title']. '</a>
                                                        <div class="f_l">
                                                            <div class="price-f-s_24 clearfix">
                                                                <span class="grn">' .$item['price_g']. ' грн.</span><br>
                                                                    <span class="dol">
                                                                        <span class="val_sum ">' .$item['price_g']. '</span>
                                                                        <span class="pointer"><span class="d_l_r">$</span><span class="icon arrow_red"></span></span>
                                                                        <span class="drop">
                                                                            <span class="USD">$</span>
                                                                            <span class="RUR">руб</span>
                                                                            <span class="EUR">€</span>
                                                                        </span>
                                                                </span>
                                                            </div>


                                                            <button class="but_buy_m f_l goBuy" type="submit" name="button" value="' .$item['id']. '">
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

                                                    <a href="?module=Product/' .$item['id']. '" class="photo_block f_l">
                                                        <figure>
                                                            <img src="/images/product/' .$item['img']. '_small.jpg" alt="' .$item['title']. '">
                                                        </figure>
                                                    </a>
               </li>
                ';
    }
    exit();
}

function connectDB(){
    $db = mysqli_connect('localhost','root','','site');
    if(!$db) {
        exit('Error'.mysqli_error());
    }

    mysqli_query($db,"SET NAMES utf-8");

    return $db;
}

function get_goods($db, $id_sort, $id){

    $query = "
                  SELECT product.*
                  FROM product
                  LEFT JOIN categories ON product.id_category = categories.id
                  WHERE categories.parent_id = '" . $id . "' OR categories.id = '" . $id . "'
                            ";

    if($id_sort) {
        if($id_sort == 'pricea') {
            $query .= ' ORDER BY price_g ASC';
        }
        else if ($id_sort == 'priced') {
            $query .= ' ORDER BY price_g DESC';
        }
    }


    $result = mysqli_query($db,$query);
    for($i = 0;$i < mysqli_num_rows($result); $i++) {
        $goods[] = mysqli_fetch_array($result);
    }

    /** @var $goods $goods */
    return $goods;
}