<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 07.07.2015
 * Time: 14:52
 */

class Search extends Module{
    public $module = "Search";
    public $description;
    public $keywords;
    public $search;
    public $product;

    function __construct($str){
        parent::__construct();

        if(App::POST('button_buy')){
            $this -> go_toPay(App::POST('button_buy'));
        }

        $this -> search = $str;
        $this -> product = $this -> get_product($str);
        parent::template('search');
    }

    /**
     * @param $str
     * @return array
     */
    private function get_product($str){
        $result = App::$db -> query("
                                    SELECT *
                                    FROM product
                                    WHERE title LIKE '%" .$str. "%'
                                    ");

        $result -> setFetchMode(PDO::FETCH_ASSOC);

        while($category = $result->fetch()) {
            $product[] = $category;
        }
        /** @var Search $product */
        return $product;
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
        /** @var Search $a */
        return $a;
    }

    private function go_toPay($id){
        parent::setCookie($id);
    }
}