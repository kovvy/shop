<?php
header("Content-Type: text/html; charset=utf-8");

class App{
public $title;
public $description;
public $keywords;
public static $db;
public static $id;
public $module;
public $menu;
public $cookie;

    function __construct() {
        $login = 'root';
        $password = '';
        $host = 'localhost';
        $db = 'site';

        $this -> search();
        self::$db = $this -> connectDB($login, $password, $host, $db);
        include_once 'Engine/Module.class.php';
    }

    private function connectDB($login, $password, $host, $db) {
        try {
            $DBH = new PDO("mysql:host=$host;dbname=$db", $login, $password);
            $DBH -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch(PDOException $e) {
            file_put_contents('LogsErrors.txt', $e -> getMessage(), FILE_APPEND);
        }
        /** @var App $DBH */
        return $DBH;
    }

/*
 * Метод получает название класса, подключает его и возвращает объект данного класса.
 * Если данного класса не существует - подключается класс Main.class.php
 */
    private function getModule($module, $pref = null){
        $path = 'Engine/' . $module . '.class.php';

        if(!file_exists($path)){
            $module = 'Main';
            $path = 'Engine/' . $module . '.class.php';
        }

        include_once $path;
        return new $module($pref);
    }

/*
 * Метод получает название элемента из глобального массива GET,
 * возвращает её в обработанном виде
 */
    static function GET($variable){
        $get = trim(htmlspecialchars($_GET[$variable]));
        return (!empty($get)) ? $get : 0;
    }
/*
 * Метод получает название элемента из глобального массива POST,
 * возвращает её в обработанном виде
 */
    static function POST($variable){
        $post = trim(htmlspecialchars($_POST[$variable]));
        return (!empty($post)) ? $post : 0;
    }

/*
 * Метод строит страницу в браузере исходя из данных GET-запроса
 */
    /**
     *
     */
    public function makePage() {
        $str = self::GET('module');

        if(!$str) {
            $module = 'Main';
        }

        $str1 = explode("/", $str);
        $module = $str1[0];

        $this -> module = $this -> getModule($module, $str1[1]);
        $this -> menu = $this -> module -> getMenu();
        $this -> cookie .= $this -> module -> get_Cookie();
        $this -> title .= $this -> module -> title;
        $this -> description .= $this -> module -> description;
        $this -> keywords .= $this -> module -> keywords;
    }

    private function search(){
        if(isset($_POST['search'])){
            header('location: index.php?module=Search/' .$_POST['text']);
        }
    }
}

$app = new App;
$app -> makePage();

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?=$app -> title?></title>
    <meta name="keywords" content="<?=$app -> keywords?>">
    <meta name="description" content="<?=$app -> description?>">
    <link rel="stylesheet" type="text/css" href="/css/style.css" media="all">
    <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/js/code.js"></script>

</head>
<body>
    <div class="main_body">
        <div class="header_fon" id="head_fon"></div>
        <header>             
            <div class="container_m header_top">
                <div class="bask_block">
                    <a href="?module=Basket"><span class="icon bask"></span>Корзина <?if($app -> cookie != 0)  echo '(' .$app -> cookie. ')'; ?></a>
                </div>
            </div>
            <div class="container_s-m header_content">
                    <figure class="logo">
                        <span><img src="./images/main/logo.png" alt=""></span>
                    </figure>
                <div class="w_860">
                    <div class="f_l">
                        <figure class="hidd_text">
                            <img src="./images/main/logo_title.png" alt="logo_title.png">
                            Магазин отопительной техники
                            Поставки в розницу и оптом
                        </figure>
                    </div>
                    <div class="f_r currency"></div>
                    <ul class="f-s_0 phones">
                        <li>
                            <div><sup>+38 (067)</sup><span class="d_n">−</span> <span>340-17-49</span></div>
                            <div><sup>+38 (044)</sup><span class="d_n">−</span> <span>38-83-299</span></div>
                        </li>
                        <li>
                            <div><span>0-<span class="d_n">-</span>800-501-821</span> — бесплатно<br>со стационарных телефонов Украины</div>
                            <div>e-mail: <a href="mailto:office@eko.com.ua?subject=Feedback%20from%20eko.com.ua">office@eko.com.ua</a></div>
                                <div>skype: <span style="color:#D92C27;font-size:13px;">eko.com.ua</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="container_b">
        <nav>
            <ul id="nav" class="not-js">
                <?php
                include 'templates/default/menu.php';
                view_cat($app -> menu);
                ?>
            </ul>
                <div class="search_block">
                    <form action="" method="post">
                        <label>
                            <input type="text" name="text" value="">
                        </label>
                        <input type="submit" value="Поиск" name="search">
                        <div class="drop_search d_n_" id="suggestions">
                            </div>
                    </form>
                </div>  
        </nav>
        
        <article>
            <?php
                foreach($app -> module -> templates as $tpl) {
                    if($tpl['is_hidden'] == 0) {
                        include ('/templates/' . $tpl['template']);
                    }
                }
                if(empty($app -> module -> templates)){
                    include ('/templates/404/404.tpl');
                }
            ?>
        </article>

        <div id="preloader" class="b-r_9"></div>
        <div class="hfooter"></div>
    </div>
    <footer>
        <div class="container_b">
            <div class="container_s">
                <div class="f_r phons_foot">
                    <div class="f_l">
    				    <div><sup>+38 (067)</sup><span class="d_n">−</span> <span>340-71-49</span></div>
                    </div>
                    <div class="f_l">
                        <div><sup>+38 (044)</sup><span class="d_n">−</span> <span>38-38-299</span></div>
                        <div><span>0-<span class="d_n">−</span>800-501-821</span></div>
                    </div>
                </div>
                <div class="footer_menu clearfix">
                    <?php
                    view_fmenu($app -> menu);
                    ?>
                    <ul class="copy_r">
                        <li>2015</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>