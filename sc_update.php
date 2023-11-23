<?php
  $st_num  = $_REQUEST["st_num"  ];
  $ex_num   = $_REQUEST["ex_num"  ];
  $score[0] = isset($_REQUEST["01"]) ? $_REQUEST["01"] : "";
  $score[1] = isset($_REQUEST["02"]) ? $_REQUEST["02" ]: "";
  $score[2] = isset($_REQUEST["03"]) ? $_REQUEST["03" ]: "";
  $score[3] = isset($_REQUEST["04"]) ? $_REQUEST["04" ]: "";
  $score[4] = isset($_REQUEST["05"]) ? $_REQUEST["05" ]: "";
  $score[5] = isset($_REQUEST["06"]) ? $_REQUEST["06" ]: "";
  $score[6] = isset($_REQUEST["07"]) ? $_REQUEST["07" ]: "";
  $score[7] = isset($_REQUEST["08"]) ? $_REQUEST["08" ]: "";
  $score[8] = isset($_REQUEST["09"]) ? $_REQUEST["09" ]: "";
  $score[9] = isset($_REQUEST["10"]) ? $_REQUEST["10" ]: "";
  $score[10] = isset($_REQUEST["11"]) ? $_REQUEST["11" ]: "";
  $score[11] = isset($_REQUEST["12"]) ? $_REQUEST["12" ]: "";




  if ($st_num && $ex_num && ($score[0] || $score[1] ||$score[2] ||$score[3] ||$score[4] ||$score[5] ||$score[6] ||$score[7] ||$score[8] ||$score[9] ||$score[10] ||$score[11])) {

    try {
        require("db_connect.php");

        for($i = 0; $i < count($score); $i++) {

        if(!$score[$i]) continue;

        $db->exec("SET foreign_key_checks = 0;
                  update score set sc_score = '$score[$i]'
                  where st_num = '$st_num'and ex_num = '$ex_num'and sb_num = '$i'+1;
                  SET foreign_key_checks = 1;");
        }

    } catch (PDOException $e) {
        exit($e->getMessage());
    }

      header("Location:score.php?num=$ex_num");
      exit();

  }else{
?>
<script>
    alert('모든 항목이 빈칸 없이 입력되어야 합니다.');
    history.back();
</script>
<?php
  }
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

</body>
</html>
