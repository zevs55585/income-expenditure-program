<?php
require("db.php");
print_r($_GET);

$user_id = $_SESSION["user"]["id"];
$date = mysqli_real_escape_string($link, $_GET["date"]);
$type = mysqli_real_escape_string($link, $_GET["type"]);
$amount = mysqli_real_escape_string($link, $_GET["amount"]);
$description = mysqli_real_escape_string($link, $_GET["description"]);
$category = mysqli_real_escape_string($link, $_GET["category_id"]);

$sql = "INSERT INTO `expenses_and_incomes` (`user_id`, `date`, `type`, `amount`, `description`, `category_id`)
        VALUES ('$user_id', '$date', '$type', '$amount', '$description', '$category')";

$result = mysqli_query($link, $sql);
if (!$result) {
    die('Неверный запрос: ' . mysqli_error($link));
} else {
    header("Location: index.php");
    exit;
}

//$result = mysqli_query($link, "INSERT INTO `expenses_and_incomes` (`date`, `type`, `category`,`amount`,`description`) VALUES ('".$_GET["date"]."', '".$_GET["type"]."', '".$_GET["category"]."','".$_GET["amount"]."', '".$_GET["description"]."');");
//if (!$result) {
// /  die('Неверный запрос: ' . mysqli_error($link));
//}
//if (isset($_SESSION["user"]) && $_SESSION["user"]["id"]) {

//    $queryTemplate_InsertRent = "INSERT INTO `expenses_and_incomes` (`user_id`, `date`, `type`, `category`,`amount`,`description`) VALUES (%d, now(), %d, %d, %d, %d)";

//    $sqlInsertRent = sprintf($queryTemplate_InsertRent, $_SESSION["user"]["id"], $_GET["date"], $_GET["type"], $_GET["category"], $_GET["amount"], $_GET["description"]);

//    $result = mysqli_query($link, $sqlInsertRent);
//    if (!$result) {
//        die('Неверный запрос: ' . mysqli_error($link));
 //   }
//}

//$result = mysqli_query($link, "INSERT INTO `expenses_and_incomes` (`user_id`,`date`, `type`, `category`,`amount`,`description`) VALUES ('$user_id".$_GET["date"]."', '".$_GET["type"]."', '".$_GET["category"]."','".$_GET["amount"]."', '".$_GET["description"]."');");
//if (!$result) {
//    die('Неверный запрос: ' . mysqli_error($link));
//}
header("Location: index.php")
?>

