<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 27.06.2015
 * Time: 10:52
 */

class Product extends Module{
    public $module = "Product";
    public $title;
    public $description;
    public $keywords;
    public $product;
    public $sale;
    public $id;

    function __construct($str){
        parent::__construct();

        if(empty($str) or !is_numeric($str)){
            parent::page_404();
        }

        if(App::POST('button_buy')){
            $this -> go_toPay(App::POST('button_buy'));
        }

        if(App::POST('button buy_credit')){
            $this -> go_toPay(App::POST('button buy_credit'));
        }


        $this -> sendMessage(
                App::POST('comment_item_id'), App::POST('comment_author'), App::POST('comment_text')
        );

        $this -> product = $this -> get_product($str);
        $this -> sale = $this -> get_sale();
        parent::template('product');
    }

    function get_product($id) {
        try {
            $result = App::$db->query("
                                        SELECT *
                                        FROM product
                                        WHERE id = '" . $id . "'");

            $result->setFetchMode(PDO::FETCH_ASSOC);


            while ($category = $result->fetch()) {
                $product[] = $category;
            }
            if(empty($product)){
                parent::page_404();
                exit;
            }
        }catch(PDOException $e) {
            parent::page_404();
            exit;
        }
        return $product;

    }

    private function get_sale(){
        $result = App::$db -> query("
                                      SELECT id, title, price_g, price_d, img
                                      FROM product
                                      WHERE sale = 1");

        $result -> setFetchMode(PDO::FETCH_ASSOC);

        if($result -> rowCount() != 0) {
            while ($category = $result->fetch()) {
                $sale[] = $category;
            }
        }
        return $sale;
    }

    function get_status($status){
        switch ($status){
            case 'Есть в наличии':
                $a = '<div class="product_status_4">' .$status. '</div>'; break;
            case 'Нет в наличии':
                $a = '<div class="product_status_3">' .$status. '</div>'; break;
            case 'Наличие уточняйте':
                $a = '<div class="product_status_1">' .$status. '</div>'; break;
        }
        return $a;
    }


    private function go_toPay ($id){
        parent::setCookie($id);
        header("location: index.php?module=Product/$id");
    }

    private function sendMessage($id, $username, $text){
        if(isset($_POST['button comment'])) {
            $datetime = date("Y-m-d H:i:s");
            $errors = array();

            if (empty($username)) {
                $errors[] = 'имя';
            }
            if (empty($text)) {
                $errors[] = 'текст';
            }
            if (count($errors) > 0) {
                parent::showErrors($errors, 'Заполните ');
            } else {
                $result = App::$db->query("
                                        INSERT INTO comment (id_product, author, text, datetime)
                                        VALUES ('$id', '$username', '$text', '$username', '$datetime')
                                        ");

                $text_mail = "Имя: $username \nПродукт: $id \n\nТекст сообщения:\n$text";
                mail("humer355@gmail.com", "SeaTuning", $text_mail);

                if ($result) {
                    header("location: index.php?module=Product/$id");
                }
            }
        }
    }
}