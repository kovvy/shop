<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 03.07.2015
 * Time: 1:12
 */

class Basket extends Module {
    public $module = "Basket";
    public $title;
    public $description;
    public $keywords;
    public $product;


    function __construct($id = NULL){
        parent::__construct();

        if(empty($id) or !is_numeric($id)){
            parent::page_404();
        }


        $this -> product = $this -> get_Product();


        $this -> checkout(
                $_POST['quantity'], $_POST['idProduct'], App::POST('fullName'), App::POST('phone'), App::POST('email'), App::POST('addres'), App::POST('commentText'), App::POST('deliveryMethodId'), App::POST('paymentMethodId')
            );


        if(App::GET('thank')) {
            echo "<script>alert('Спасибо, заказ принят')</script>";
        }

        if(isset($id)){
            $this -> dell_Product($id);
        }
    }


    /**
     * @return array
     */
    private function get_Product(){
        if(!empty($_COOKIE['Cookie'])) {
            foreach ($_COOKIE['Cookie'] AS $name => $value) {
                $value = htmlspecialchars($value);

                $sql = App::$db -> query("
                                          SELECT id, title, price_g, price_d, img
                                          FROM product
                                          WHERE id = '" . $value . "'
                                          ");

                $sql -> setFetchMode(PDO::FETCH_ASSOC);

                if ($sql -> rowCount() != 0) {
                    for ($i = 0; $i < $sql -> rowCount(); $i++) {
                        $row = $sql -> fetch();
                        $product[] = $row;
                    }
                }
            }
            parent::template('basket');
        }else{
            parent::template('no_basket');
        }
        return $product;
    }

    public function view_priceProduct($arr){
        for($i = 0; $i < count($arr);$i++) {
            $grn += $arr[$i]['price_g'];
        }
        echo $grn;
    }

    /**
     * @param $id
     */
    private function dell_Product($id){
        setcookie ("Cookie[$id]", "", time() - 3600);
        header('location: index.php?module=Basket');
        return;
    }


    /**
     * @param $quantity
     * @param $idProduct
     * @param $fullName
     * @param $phone
     * @param $email
     * @param $addres
     * @param $commentText
     * @param $deliveryMethodId
     * @param $paymentMethodId
     */
    private function checkout($quantity, $idProduct, $fullName, $phone, $email, $addres, $commentText, $deliveryMethodId, $paymentMethodId){
        if(isset($_POST['goToPay'])) {
            $datetime = date("Y-m-d H:i:s");
            $errors = array();

            if (empty($fullName)) {
                $errors[] = 'имя';
            }
            if (empty($phone)) {
                $errors[] = 'телефон';
            }


            if (count($errors) > 0) {
                parent::showErrors($errors, 'Заполните ');

            } else {

                $sql = App::$db -> query("
                                INSERT INTO order_client (name, telephone, email, adr, comment, export_method, payment_method, datetime)
			                    VALUES ('$fullName', '$phone', '$email', '$addres', '$commentText', '$deliveryMethodId', '$paymentMethodId', '$datetime')
			                    ");

                $arr = array_combine($quantity, $idProduct);
                foreach($arr as $quantity => $idProduct) {
                    $sql = App::$db -> query("
                                            INSERT INTO orders (order_id, quantity, product_id)
                                            VALUES ((SELECT id FROM order_client ORDER BY id DESC LIMIT 1), '$quantity', '$idProduct')
                                            ");
                }

                if ($sql) {
                    setcookie ("Cookie", "", time() - 3600);
                    header('location: index.php?module=Basket&thank=1');
                }
            }
        }
    }
}