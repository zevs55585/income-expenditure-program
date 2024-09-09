<?php
  require("db.php");
    print_r($_GET);
    $result_id=$_GET['id'];
    $result = mysqli_query($link, 'SELECT * From expenses_and_incomes Where id = "'.$_GET['id'].'"');

    if (!$result) {
        die('Неверный запрос: ' . mysqli_error($link));
    }
    $result = mysqli_fetch_assoc($result);




    $categ=mysqli_query($link, 'SELECT * From category');
    if (!$categ) {
        die('Неверный запрос: ' . mysqli_error($link));
    }
?>
<html>
    <head>
        <title>Ychet - update Ychet</title>
    </head>
    <body>
<a href="index.php">Главная страница</a>
<br/>

<form action="createupdateoperation.php">

<table border=1>
<tr>
    <input type="hidden" name="id" value="<?=$result['id']?>">
    <td>
        Дата
    </td>
    <td>
        <!-- <label for="date">Дата:</label> -->
        <!-- <input type="date" id="date" name="date"  value="<?= result['date'] ?>" required> -->

        <input name="date" type="text" value="<?= $result['date'] ?>">
</tr>
<tr>
    <td for="type">Тип:</td>
    <td><select id="type" name="type" required>
      <option value="expense">Расход</option>
      <option value="income">Доход</option>
    </select></td>
</tr>
<tr>
    <td>Категория</td>
     <td>
        <select name="category_id">
            <?
            while ($c = mysqli_fetch_assoc($categ)) {
                $selected="";
                if ($c["id"] == $result["category_id"]){
                    $selected="selected";
                }
            ?>
                <option <?=$selected?> value="<?= $c["id"] ?>"><?= $c["name"]?></option>
            <?
            }
            ?>
        </select>
    </td>
</tr>
<tr>
        <td for="amount">Сумма:</td>
    <td><input name="amount" type="text" value="<?= $result['amount'] ?>"></td>

</tr>



<tr>
    <td>
        Описание задачи
    </td>
    <td>
        <input name= "description" type="text"value="<?= $result['description'] ?>">
    </td>


</tr>

</table>
<input type="submit"/>
 </form>

    </body>
</html>