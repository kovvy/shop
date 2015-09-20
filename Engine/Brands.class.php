<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 15.07.2015
 * Time: 20:42
 */

class Brands extends Module{
    public $module = 'Brands';
    public $brand;
    public $title;
    public $description;
    public $keywords;
    public $products;

    function __construct($id){
        parent::__construct();

        if(empty($id) or !is_numeric($id)){
            parent::page_404();
        }

        if(App::POST('button')){
            $this -> go_toPay(App::POST('button'));
        }

        $this -> brand = $this -> get_brand($id);
        $this -> products = $this -> get_brandProduct($id);
    }

    private function get_brand($id){
        $result = App::$db -> query("
				SELECT * FROM brands WHERE id = '" .$id."'
			");
        if($result -> rowCount() != 0) {
            $result -> setFetchMode(PDO::FETCH_ASSOC);

            while ($brand = $result->fetch()) {
                $brands[] = $brand;
            }
            parent::template('brands');
        }
        /** @var Brands $brands */
        return $brands;
    }

    private function get_brandProduct($id){
        $result = App::$db -> query("
				SELECT * FROM product WHERE id_brand = '" .$id."'
			");
        if($result -> rowCount() != 0) {
            $result -> setFetchMode(PDO::FETCH_ASSOC);

            while ($brand = $result -> fetch()) {
                $product[] = $brand;
            }
            parent::template('brands');
        }
        /** @var Brands $product */
        return $product;
    }

    private function go_toPay($id){
        parent::setCookie($id);
    }
}