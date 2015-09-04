<?php
/**
 * @author Evgeni Lezhenkin evgeni@lezhenkin.ru http://lezhenkin.ru
 * 
 * Скрипт, обрабатывающий POST-запросы от JavaScript-сценариев
 * Скрипт получает строку запроса, а в ответ отправляет массив с данными
 */
// Непосредственно для этого скрипта мы создадим здесь массивы, в которых будут храниться
// значения, запрашиваемые JavaScript-сценарием. В ваших сценариях этих массивов, скорее всего,
// не будет. Информация, подобная этой, будет в вашей базе данных, и вам её придется оттуда 
// извлечь. Как вы это сделаете, это уже ваши предпочтения
$login = 'root';
$password = '';
$host = 'localhost';
$db = 'site';

mysql_connect($host, $login, $password);
mysql_select_db($db);

	$result = mysql_query("SELECT * FROM categories WHERE parent_id <= 3 and parent_id != 0");

	$types = array();
	if(mysql_num_rows($result) != 0) {
	    
		for($i = 0; $i < mysql_num_rows($result);$i++) {
		$row = mysql_fetch_array($result,MYSQL_ASSOC);     
		   $types[$row['parent_id']][] = $row; 
		}
	}

// Проверяем наличие переменной, которая укажет данному сценарию какие именно данные нужны
if (!isset($_POST['query']) || !$_POST['query']) {
	exit("Нет данных определяющих тип запроса");
}
else {
	// Сохраняем строку запроса данных в отдельной переменной
	$query = trim($_POST['query']); // Очищаем от лишних пробелов
	
	// Определяем тип запроса
	switch($query) {
	case 'getKinds':	// Запрос на получение видов транспорта
		// Сохраним в переменную значение выбранного типа транспорта
		$type_id = trim($_POST['type_id']); // Очистим его от лишних пробелов
		// Формируем массив с ответом
		$result = NULL;
		$i = 0;
		foreach ($types[$type_id] as $kind_id => $kind) {
			$result[$i]['kind_id'] = $kind_id;
			$result[$i]['kind'] = $kind;
			$i++;
		}
	break;
	case 'getCategories':	// Запрос на получение видов транспорта
		// Сохраним в переменные значения выбранных типа транспорта и вида транспорта
		$type_id = trim($_POST['type_id']); // Очистим их от лишних пробелов
		$kind_id = trim($_POST['kind_id']);
		// Формируем массив с ответом
		$result = NULL;
		$i = 0;
		foreach ($kinds[$type_id][$kind_id] as $category_id => $category) {
			$result[$i]['category_id'] = $category_id;
			$result[$i]['category'] = $category;
			$i++;
		}
	break;
	default:
		// Если данные не определены
		$result = NULL;
	break;
	}
}

// Преобразуем данные в формат json, чтобы их смог обработать JavaScript-сценарий, приславший запрос
echo json_encode($result);

/**
 * Данный код не идеален. Сама идея представления исходных данных о транспорте в виде массива очень
 * далека от идеала. И вы должны понимать почему. Данные должны храниться в реляционной базе данных, 
 * а представленный вариант написания сценария является лишь простейшим примером, который не стоит 
 * в таком виде применять на практике. Вы здесь должны лишь понять принципы работы языка и взаимодействия
 * между языками программирования
 */
?>