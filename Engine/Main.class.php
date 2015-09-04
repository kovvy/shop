<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 15.06.2015
 * Time: 15:12
 */

class Main extends Module{
    public $module = "Main";
    public $catalog;
    public $brand;
    public $title;
    public $description;
    public $keywords;

    function __construct(){
        parent::__construct();

        $this -> catalog = $this -> get_catalog();
        $this -> brand = $this -> get_brands();
        parent::template('sliders_main');
    }

    private function get_catalog(){
        $result = App::$db -> query("
                                    SELECT id, title, parent_id
                                    FROM categories
                                    ");

        $result -> setFetchMode(PDO::FETCH_ASSOC);

        $categories = array();
        if($result -> rowCount() != 0) {

            for($i = 0; $i < $result -> rowCount();$i++) {
                $row = $result->fetch();

                if(empty($categories[$row['parent_id']])) {
                    $categories[$row['parent_id']] = array();
                }
                $categories[$row['parent_id']][] = $row;
            }
        }
        return $categories;
    }

    private function get_brands(){
        $result = App::$db -> query("
				                    SELECT *
				                    FROM brands
			                      ");

        $result -> setFetchMode(PDO::FETCH_ASSOC);

        while($brand = $result->fetch()) {
            $brands[] = $brand;
        }
        return $brands;
    }


    public function view_catalog($arr,$parent_id = 0){
        for($i = 0; $i < count($arr);$i++) {
            if(empty($arr[$parent_id][$i])){
                break;
            }

            echo '
	      		<li>
	      		    <div>
                        <a class="heat_air_b cat_img" href="?module=Category/' .$arr[$parent_id][$i]['title'].'">
                            <span>' .$arr[$parent_id][$i]['title'].'</span>
                        </a>';

                        $this -> view_dcatalog($arr,$arr[$parent_id][$i]['id']);
                        echo '
                        <a href="index.php/#" class="all_show t-d_n"><span class="d_l_g">Все категории</span></a>        </div>
	      		</li>';
        }
    }

    private function view_dcatalog($arr,$parent_id = 0){
        echo '<ul>';
        for($i = 0; $i < count($arr);$i++) {
            if(empty($arr[$parent_id][$i])){
                break;
            }

            echo '
                    <li><a href="?module=Category/' .$arr[$parent_id][$i]['title'].'">' .$arr[$parent_id][$i]['title'].'</a></li>
                ';
            $this -> view_pcatalog($arr,$arr[$parent_id][$i]['id']);
        }
        echo '</ul>';
    }

    private function view_pcatalog($arr,$parent_id = 0){
        for($i = 0; $i < count($arr);$i++) {
            if(empty($arr[$parent_id][$i])){
                break;
            }
            if($i == 1){
                echo '</ul><ul class="not_v">';
            }

            echo '
                    <li><a href="?module=Category/' .$arr[$parent_id][$i]['title'].'">' .$arr[$parent_id][$i]['title'].'</a></li>
                ';
        }
    }

}