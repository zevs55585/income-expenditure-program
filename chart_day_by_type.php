<?php
require("db.php");

//print_r($_GET);

function allYchetByUserByDayType($link, $user_id) {
    $result = mysqli_query($link, "SELECT date, sum(case when type = 'expense' then amount else 0 end) expense, sum(case when type = 'income' then amount else 0 end) income FROM `expenses_and_incomes` Where user_id = '$user_id' GROUP by date Order by date asc;");

    if (!$result) {
        die('Неверный запрос: ' . mysqli_error($link));
    }

    $res = [];
    while ($u = mysqli_fetch_assoc($result)){   //$r  переменная
        $res[] = $u;
    }
    return $res;
}
?>

<html>
<head>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
  <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
  <style type="text/css">

    html,
    body,
    #container {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
    }
  
</style>
</head>
<body>
  <div style="position:absolute; right:10px;top:10px;">
    <?
    if (!$_SESSION["user"]){
      ?>
      <a href="auth.php">Вход</a>
      <a href="registration.php">Зарегистрироваться</a>
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



  <a href="add.php">Добавить новую операцию</a><br>
  <a href="index.php">Главная сраница</a>
<?php
$ychet = allYchetByUserByDayType($link, $_SESSION['user']['id']);

if (count($ychet) == 0) {
  echo "<br/>список операций пуст";
} else {
  echo "<br/>список операций:";
}
?>
  
  <div id="container"></div>
  

  <script>

    anychart.onDocumentReady(function () {
      // create data set on our data
      var dataSet = anychart.data.set([
        <?php
        $count = count($ychet);
        $i=0;
        foreach ($ychet as $key => $u) {
          $i++;
          echo "['".$u["date"]."', ".$u["income"].", ".$u["expense"]."]";
          if ($i!=$count) {
            echo ",\n";
          }
        }
        ?>
      ]);

      // map data for the first series, take x from the zero column and value from the first column of data set
      var firstSeriesData = dataSet.mapAs({ x: 0, value: 1 });

      // map data for the second series, take x from the zero column and value from the second column of data set
      var secondSeriesData = dataSet.mapAs({ x: 0, value: 2 });

      // create column chart
      var chart = anychart.column();

      // turn on chart animation
      chart.animation(true);

      // set chart title text settings
      chart.title('Диаграмма доходов и расходов');

      // temp variable to store series instance
      var series;

      // helper function to setup label settings for all series
      var setupSeries = function (series, name) {
        series.name(name);
        series.selected().fill('#f48fb1 0.8').stroke('1.5 #c2185b');
      };

      // create first series with mapped data
      series = chart.column(firstSeriesData);
      series.xPointPosition(0.45);
      setupSeries(series, 'Доход');

      // create second series with mapped data
      series = chart.column(secondSeriesData);
      series.xPointPosition(0.25);
      setupSeries(series, 'Расход');

      // set chart padding
      chart.barGroupsPadding(0.3);

      // format numbers in y axis label to match browser locale
      chart.yAxis().labels().format('Руб {%Value}{groupsSeparator: }');

      // set titles for Y-axis
      chart.yAxis().title('Выручка в рублях');

      // turn on legend
      chart.legend().enabled(true).fontSize(13).padding([0, 0, 20, 0]);

      chart.interactivity().hoverMode('single');

      chart.tooltip().format('${%Value}{groupsSeparator: }');

      // set container id for the chart
      chart.container('container');

      // initiate chart drawing
      chart.draw();
    });
  
</script>
</body>
</html>
                