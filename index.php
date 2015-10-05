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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$app -> title?></title>
    <meta name="keywords" content="<?=$app -> keywords?>">
    <meta name="description" content="<?=$app -> description?>">

    <!-- Bootstrap -->
    <link href="css/bootsrap3/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="css/bootsrap3/sidebar.css" rel="stylesheet">
    <link href="css/bootsrap3/sidebar-bootstrap.css" rel="stylesheet">
    <link href="css/bootsrap3/style3.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <button type="button" class="btn btn-sm btn-danger">button</button>
    <![endif]-->

</head>
<body>
<div id="wrapper">
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="h-panel clearfix">
                    <nav class="h-nav h-nav-tabs">
                        <a href="#" class="active">Интернет-магазин</a>
                        <a href="#">О компании</a>
                    </nav>
                    <nav class="h-nav h-nav-center">
                        <a href="#">Акции</a>
                        <a href="#">Дисконтная система</a>
                        <a href="#">Адреса и контакты</a>
                        <a href="#">Доставка и оплата</a>
                    </nav>
                    <nav class="h-nav pull-right">
                        <a href="#"><i class="ic-time"></i> <span class="hidden-xss">Проверить заказ</span></a>
                        <a href="#"><i class="ic-user"></i> <span class="hidden-xss">Личный кабинет</span></a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-3 col-xs-4 col-xss-6">
                        <div class="logo">
                            <a href="/"><img src="images/bootstrap3/logo.png" height="59" width="238" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 col-xss-3">
                        <form action="#" id="h-search">
                            <input type="text" value="Поиск по сайту"/>
                            <input type="submit" value="" />
                            <a href="#" class="h-search_close">x</a>
                        </form>
                        <a href="#" class="h-search__link">&nbsp;</a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-2 col-xss-3">
                        <div class="dropdown h-phone">
                            <a data-toggle="dropdown" href="#">
                                <small>Бесплатно по всей России</small>
                                <span>8 800 123-45-67 <i class="ic-arrow-down"></i></span>
                            </a>
                            <ul class="dropdown-menu arrow" role="menu" aria-labelledby="dLabel">
                                <li><a href="#">Заказать обратный звонок</a></li>
                                <li><a href="#">Форма обратной связи</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="panel">
        <div class="container">
            <div class="row">
                <ul class="panel-menu-wrap clearfix">

                        <?php
                        include 'templates/default/menu.php';
                        view_cat($app -> menu);
                        ?>

                </ul>

                <a href="#" class="btn btn-basket pull-right"><i class="ic-basket"></i> <span class="hidden-xss">Корзина</span></a>
            </div>
        </div>
    </div>



    <footer id="footer">
        <div class="subscription">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-6">
                        <h4 class="subscription__title clearfix"><i class="gift"></i> Подпишитесь на новинки, скидки, предложения!</h4>
                    </div>
                    <div class="col-md-5 col-sm-6">
                        <form action="#" class="clearfix">
                            <input type="text" placeholder="Адрес электронной почты">
                            <input type="submit" value="Подписаться">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xss-12">
                        <h4 class="footer__title"><a href="#">корпоративный сайт  &#8250;</a></h4>
                        <nav class="footer__nav">
                            <ul class="list-unstyled">
                                <li><a href="#">О компании</a></li>
                                <li><a href="#">Новости и анонсы</a></li>
                                <li><a href="#">Контакты</a></li>
                                <li><a href="#">Партнерам</a></li>
                                <li><a href="#">Вакансии</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xss-12">
                        <h4 class="footer__title"><a href="#">Интернет-магазин  &#8250;</a></h4>
                        <nav class="footer__nav">
                            <ul class="list-unstyled">
                                <li><a href="#">Каталог</a></li>
                                <li><a href="#">Доставка и оплата</a></li>
                                <li><a href="#">Гарантия и возврат</a></li>
                                <li><a href="#">Часто задаваемые вопросы</a></li>
                                <li><a href="#">Акции</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xss-12">
                        <h4 class="footer__title"><a href="#">Личный кабинет  &#8250;</a></h4>
                        <nav class="footer__nav">
                            <ul  class="list-unstyled">
                                <li><a href="#">Индивидуальные новости и акции</a></li>
                                <li><a href="#">История заказов</a></li>
                                <li><a href="#">Lorem ipsum dolor.</a></li>
                                <li><a href="#">Личные данные и адрес доставки</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xss-12">
                        <h4 class="footer__title">Остались вопросы?</h4>
                        <p class="footer__phone">8 800 123-45-67</p>
                        <nav class="footer__nav">
                            <ul class="list-unstyled">
                                <li><a href="#">Обратный звонок</a></li>
                                <li><a href="#">Форма обратной связи</a></li>
                            </ul>
                        </nav>

                        <h5 class="footer__title mt-lg">Мы в социальных сетях</h5>
                        <div class="social">
                            <a href="#" class="social__link social__link_fb">&nbsp;</a>
                            <a href="#" class="social__link social__link_google">&nbsp;</a>
                            <a href="#" class="social__link social__link_tw">&nbsp;</a>
                            <a href="#" class="social__link social__link_vk">&nbsp;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="copy">
            <div class="container">
                <p class="copy text-center">&copy; Компания «Маркетстом» 2015. Все цены указаны в рублях и являются актуальными</p>
            </div>
        </div>
    </footer>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/hammer.js/1.1.3/hammer.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="js/bootsrap3/sidebar.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootsrap3/bootstrap.min.js"></script>
<!--  Стилизованый селект -->
<script type="text/javascript" src="js/bootsrap3/cusel-min-2.5.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        /* select style */
        var params = {
            changedEl: "select",
            visRows: 5,
            scrollArrows: true
        }
        cuSel(params);


        $('.close-menu').click(function(event) {
            $('.panel-menu').slideToggle(400);
        });

        $('.h-search__link').click(function(event) {
            $('#h-search').animate({
                top: '20px'
            },400);
        });

        $('.h-search_close').click(function(event) {
            $('#h-search').animate({
                top: '-90px'
            },400);
        });



    });
</script>

<script type="text/javascript" src="js/bootsrap3/my.js"></script>
</body>
</html>