<?
session_start();
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}
//echo 'Успешно соединились';

// выбираем foo в качестве текущей базы данных
$db_selected = mysqli_select_db($link,'ychet' );
if (!$db_selected) {
    die ('Не удалось выбрать базу my_bd_book: ' . mysqli_error($link));
}

?>