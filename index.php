<?php
require("db.php");

//print_r($_GET);
$sortSQL = "";   // сортировка 0
if (isset($_GET["sort"]) && $_GET["sort"]=="category") {  //сортировка по возрастанию
  $sortSQL="ORDER BY  a.name ASC";
} elseif(isset($_GET["sort"]) && $_GET["sort"]=="categoryDESC") {
  $sortSQL="ORDER BY  a.name DESC";
}

function allYchetByUser($link, $user_id) {
    $result = mysqli_query($link, "SELECT e.*, c.name category_name FROM `expenses_and_incomes` e INNER JOIN category c on c.id = e.category_id WHERE user_id = '$user_id' ORDER BY date DESC".$sortSQL);

    //$result = mysqli_query($link, "SELECT * FROM expenses_and_incomes WHERE user_id = '$user_id' ORDER BY date DESC");
    //SELECT e.*, c.name category_name FROM `expenses_and_incomes` e INNER JOIN category c on c.id = e.category_id;
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error($link));
    }

    $res = [];
    while ($u = mysqli_fetch_assoc($result)){   //$r  переменная
        $res[] = $u;
    }
    return $res;
}
$r = $_SESSION["user"]
    //$result = mysqli_query($link, 'SELECT * FROM expenses_and_incomes
    //WHERE c.user_id ='.$user_id);// . $_GET["id"]);

//$result = mysqli_query($link, "SELECT * FROM expenses_and_incomes ORDER BY date DESC");

//if (!$result) {
 //   die('Неверный запрос: ' . mysqli_error($link));
//}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Учет расходов и доходов</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
  <div style="position:absolute; right:10px;top:10px;">
    <?
    if (!$_SESSION["user"]){
      ?>
      <a href="auth.php">Вход или регистрация</a>
      <!-- <a href="registration.php">Зарегистрироваться</a> -->
      <?
    } else{
      ?>
      <a href="logout.php">Выход</a>
      <a href="user.php"><?=$_SESSION["user"]["name"]?></a>
      <?

    }
    ?>
  </div>
  <h1>Учет расходов и доходов</h1>
<?
    if (isset($_SESSION["user"]) )
  {
    echo "<a href=add.php>Добавить новую операцию</a><br>";
    echo "<a href=chart_day_by_type.php>Вывести диаграмму расходов, дохов </a><br>";
    echo "<a href=xls.php>экспорт данных</a>";
    }

    ?>

  <!-- <a href="add.php">Добавить новую операцию</a><br> -->
  <!-- <a href="chart_day_by_type.php">Вывести диаграмму расходов, дохов </a><br> -->
  <!-- <a href="xls.php">экспорт данных</a> -->
  <?
$ychet = allYchetByUser($link, $_SESSION['user']['id']);

if (count($ychet) == 0) {
  echo "<br/>список операций пуст";
} else {
  echo "<br/>список операций:";

?>

<br/>
<table border=1>
  <tr>
      <th>Дата</th>
      <th>Тип</th>
      <th>
        <? if(isset($_GET["sort"]) && $_GET["sort"] =="category"){ ?>
          <a href ="?sort=categoryDESC">Категория</a>
        <? } else { ?>
          <a href ="?sort=category">Категория</a>
        <? } ?>
      </th>
      <th>Сумма</th>
      <th>Описание</th>
      <th>Редактирование</th>
    </tr>

<?

$typeNames = ["income"=>"Доход", "expense"=>"Расход"];


$dohod = 0;
$rashod = 0;
foreach ($ychet as $key => $u) {
  // code...
 //} ($u = mysqli_fetch_assoc($result)){   //$r  переменная
  echo "<tr>"; // определяет строку в таблице.
  echo "<td>".$u["date"]."</td>";//первый столбец  // определяет ячейку в таблице
  echo "<td>".$typeNames[$u["type"]]."</a></td>"; //второй столбец  //адрес документа на который ведет ссылка
  echo "<td>".$u["category_name"]."</td>"; // 3 столбец
  echo "<td>".$u["amount"]."</td>";  //4 столбец
  echo "<td>".$u["description"]."</td>"; // 3 столбец
  echo "<td><a href='updateoperation.php?id=" . $u["id"] ."'>изменить операцию</a></td>";
  echo "<td><a href='deleteoperation.php?id=" . $u["id"]."'>Удалить</a></td>";
  echo "</tr>\n";

  if ($u['type']=='income') {
    $dohod += $u["amount"];
  } else {
    $rashod += $u['amount'];
  }
}
}
?>
</table>

<?
echo "Доход: ". $dohod ."руб, Расход: ". $rashod . "руб , Баланс: ". ($dohod - $rashod). "руб";
?>
</body>
</html>