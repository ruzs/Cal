<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .nav {
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            text-align: center;
            margin: 0 auto;
        }

        table td {
            border: 1px solid #ccc;
            padding: 3px 9px;
        }
    </style>
</head>

<body>
    <?php
    $cal = [];

    $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
    $year = (isset($_GET['y'])) ? $_GET['y'] : date("Y");

    $nextMonth = $month + 1;
    $prevMonth = $month - 1;



    if ($nextMonth > 13) {
        $year = $year + 1;
        $month = 1;
        $nextMonth = 2;
        $prevMonth = 0;
    }
    if ($prevMonth < 0) {
        $year = $year - 1;
        $month = 12;
        $prevMonth = 11;
        $nextMonth = 13;
    }



    $firstDay = $year . "-" . $month . "-1";
    $firstDayWeek = date("N", strtotime($firstDay));
    $monthDays = date("t", strtotime($firstDay));
    $lastDay = $year . '-' . $month . '-' . $monthDays;
    $spaceDays = $firstDayWeek - 1;
    $weeks = ceil(($monthDays + $spaceDays) / 7);

    for ($i = 0; $i < $spaceDays; $i++) {
        $cal[] = '';
    }

    for ($i = 0; $i < $monthDays; $i++) {
        $cal[] = date("d", strtotime("+$i days", strtotime($firstDay)));
    }
    for ($i = 0; $i < ($weeks * 7 - $monthDays - $spaceDays); $i++) {
        $cal[] = '';
    }

    echo "$prevMonth.$month.$nextMonth";
    echo "第一天" . $firstDay . "星期" . $firstDayWeek;
    echo "<br>";
    echo "該月共" . $monthDays . "天,最後一天是" . $lastDay;
    echo "<br>";
    echo "月曆天數共" . ($monthDays + $spaceDays) . "天，" . $weeks . "周";

    ?>

    <div class="nav" style="display:flex;width:80%;justify-content:space-between;align-items:center">
        <a href="?y=<?= $year; ?>&m=<?= $prevMonth; ?>">上一個月</a>
        <h1><?= $year; ?> 年 <?= $month; ?> 月份 </h1>
        <a href="?y=<?= $year; ?>&m=<?= $nextMonth; ?>">下一個月</a>
    </div>

    <table>
        <?php
        foreach ($cal as $i => $day) {
            if ($i % 7 == 0) {
                echo "<tr>";
            }
            // if ($today==date("d")) {
            //   echo "<td class='today'>$day</td>";
            // }else{
            echo "<td>$day</td>";
            // }

            if ($i % 7 == 6) {
                echo "</tr>";
            }
        }

        ?>

    </table>
</body>

</html>