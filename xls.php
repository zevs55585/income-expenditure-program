<?php
// Подключение к базе данных
require_once 'db.php';

// Запрос на получение данных
$sql = "SELECT * FROM expenses_and_incomes";
$result = mysqli_query($link, $sql);

// Создание Excel файла
header('Content-Type: application/vnd.ms-excel; charset=cp1251');
header('Content-Disposition: attachment;filename="tasks.xls"');
header('Cache-Control: max-age=0');

// Вывод заголовков столбцов
echo "ID\tДата\tТип\tКатегория\tСумма\tОписание\n";

// Вывод данных
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['id'] . "\t";
    echo $row['date'] . "\t";
    echo $row['type'] . "\t";
    echo $row['category_id'] . "\t";
    echo $row['amount'] . "\t";
    echo $row['description'] . "\n";
}

// Завершение работы скрипта
exit;
?>