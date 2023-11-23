<?php
  $name   = $_REQUEST["name"  ];
  $start   = $_REQUEST["start"  ];
  $end   = $_REQUEST["end"  ];
  $grade   = $_REQUEST["grade"  ];
  $ex_grade   = $_REQUEST["ex_grade"  ];
  $code  = $_REQUEST["code"];
  $ex_num  = $_REQUEST["ex_num"];

  if ($name && $start && $end && $grade && $code && $ex_num && $ex_grade)  {

    try {
        require("db_connect.php");

        $db->exec("SET foreign_key_checks = 0;
                  update exam set ex_name = '$name', ex_start = '$start', ex_end = '$end', ex_grade = '$grade'
                   where ex_num = $ex_num;
                   SET foreign_key_checks = 1;");

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
    if($ex_grade != $grade){
      try{
        $db->exec("
        SET foreign_key_checks = 0;
        delete from score where st_num / 10000 >= $ex_grade and st_num / 10000 < $ex_grade+1 and ex_num = $ex_num;
        SET foreign_key_checks = 1;");
      }catch (PDOException $ee) {
          exit($ee->getMessage());
      }
    }
    try{
      $query = $db->query("select * from score where ex_num = $ex_num");
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $i = 0;
        foreach ($code as $sb_num) {
          if($row["sb_num"]==$sb_num){
            $i=1;
            break;
          }
        }
        $delete = $row["sb_num"];
        if($i==0){
          $db->exec("
          SET foreign_key_checks = 0;
          delete from score where sb_num = $delete;
          SET foreign_key_checks = 1;");
        }
      }
    }catch (PDOException $ee) {
        exit($ee->getMessage());
    }

      try{

      $query = $db->query("select * from students where st_num / 10000 >= $grade and st_num / 10000 < $grade+1");

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $st_num = $row["st_num"];
        foreach ($code as $sb_num) {
          $query2 = $db->query("select count(*) from score where ex_num = $ex_num and st_num = $st_num and sb_num = $sb_num");
          $row2 = $query2->fetch(PDO::FETCH_ASSOC);

          if($row2["count(*)"]==0){
 
          $db->exec("insert into score (ex_num, st_num, sb_num)
                     values ('$ex_num','$st_num','$sb_num')");
          }
        }
      }
    }catch (PDOException $ee) {
        exit($ee->getMessage());
    }
    header("Location:exam.php");
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
