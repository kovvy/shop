<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 27.05.2015
 * Time: 12:12
 */

abstract class Module{
public $title;
public $module;
public $description;
public $keywords;
public $templates = array();

    function __construct() {

        $pageinfo = $this -> getPageInfo();
        $this -> title = $pageinfo['title'];
        $this -> text = $pageinfo['text'];
        $this -> keywords = $pageinfo['meta_k'];
        $this -> description = $pageinfo['meta_d'];
    }

/*
 * Метод строит навигацию сайта
 */
    public function getMenu () {

        $result = App::$db -> query("SELECT * FROM categories");
        $result -> setFetchMode(PDO::FETCH_ASSOC);

          $menu = array();
          if($result -> rowCount() != 0) {

            for($i = 0; $i < $result -> rowCount();$i++) {
              $row = $result->fetch();

              if(empty($menu[$row['parent_id']])) {
                $menu[$row['parent_id']] = array();
              }
              $menu[$row['parent_id']][] = $row;
            }
          }
        return $menu;
    }


    public function getPageInfo() {
        $result = App::$db -> query("
                SELECT * FROM page WHERE category='" . $this -> module . "'
                ");
        $result -> setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public function get_Cookie(){
        if(!empty($_COOKIE['Cookie'])){
            $result = count($_COOKIE['Cookie']);
            return $result;
        }else{
            return 0;
        }
     }

    /**
     * @param $id
     */
    public function setCookie($id){
        setcookie("Cookie[$id]", $id, time() + 60 * 60 * 24 * 30);
    }


    /**
     * @param $name
     * @param null $name1
     * @param null $name2
     * @param null $name3
     */
    protected function template($name, $name1 = NULL, $name2 = NULL, $name3 = NULL){
        $str = explode("_", $name);
        if(empty($str[1])) $str[1] = $name;

        $str1 = explode("_", $name1);
        if(empty($str1[1])) $str1[1] = $name1;

        $str2 = explode("_", $name2);
        if(empty($str2[1])) $str2[1] = $name2;

        $str3 = explode("_", $name2);
        if(empty($str3[1])) $str3[1] = $name3;

        $this -> templates = array(
            $name => array(
                'template' => $str[1]. '/' .$name. '.tpl',
                'is_hidden' => 0
            ),
            $name1 => array(
                'template' => $str1[1]. '/' .$name1. '.tpl',
                'is_hidden' => !empty($name1) ? 0 : 1
            ),
            $name2 => array(
                'template' => $str2[1]. '/' .$name2. '.tpl',
                'is_hidden' => !empty($name2) ? 0 : 1
            ),
            $name3 => array(
                'template' => $str2[1]. '/' .$name3. '.tpl',
                'is_hidden' => !empty($name3) ? 0 : 1
            )
        );
    }

    protected function page_404(){
        $this -> template('404');
    }

    /**
     * @param $errors
     * @param $text
     */
    protected function showErrors($errors, $text) {
        echo "<script>alert('";
        echo $text;
        for($i = 0; $i < count($errors); $i++) {
            echo $errors[$i];
            if($i == (count($errors)-1)) {
                echo ".";
            } else {
                echo ", ";
            }
        }
        echo "');</script>";
    }
}