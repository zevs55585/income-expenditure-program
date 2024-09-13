<?php
  require("db.php");
//print_r($_GET);

  $queryUpdateYchet = sprintf('UPDATE expenses_and_incomes SET  date="%s", description="%s", type="%s", category_id="%s", amount="%s" WHERE id = %d', $_GET["date"], $_GET["description"],$_GET["type"], $_GET["category_id"], $_GET["amount"], $_GET["id"]);
  $result = mysqli_query($link,$queryUpdateYchet );

  if (!$result) {
    die('Неверный запрос: ' . mysqli_error($link));
}

  header("Location: index.php")

?>