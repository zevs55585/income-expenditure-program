<?php
require("db.php");
//print_r($_GET);
$categ=mysqli_query($link, 'SELECT * From category');
//if (!$result) {
//    die('Неверный запрос: ' . mysqli_error($link));
//}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Добавить новую операцию</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="style.css">-->
</head>
<body>
  <a href="index.php">Вернуться на главную страницу</a>
  <h1>Добавить новую операцию</h1>
  <form action="create_add.php" method="GET">
    <table border="1">
    <td for="date">Дата:</td>
    <td><input type="date" id="date" name="date" required></td>

    <td for="type">Тип:</td>
    <td><select id="type" name="type" required>
      <option value="expense">Расход</option>
      <option value="income">Доход</option>
    </select></td>

    <td for="category">Категория:</td>
    <td><select name="category_id">
      <?
      while ($c = mysqli_fetch_assoc($categ)) {
      ?>
          <option value="<?= $c["id"] ?>"><?= $c["name"]?></option>
        <?
        }
        ?>
      </select></td>
    <!-- <input type="text" id="category" name="category" required> -->

    <td for="amount">Сумма:</td>
    <td><input type="number" step="0.01" id="amount" name="amount" required></td>

    <td for="description">Описание:</td>
    <td><textarea id="description" name="description"></textarea></td>
    </table>

    <button type="submit">Сохранить</button>
  </form>
</body>
</html>