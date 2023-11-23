<?php
  $name   = $_REQUEST["name"  ];
  $start   = $_REQUEST["start"  ];
  $end   = $_REQUEST["end"  ];
  $grade   = $_REQUEST["grade"  ];
  $code  = $_REQUEST["code"];


  if ($name && $start && $end && $grade && $code) {

    try {
        require("db_connect.php");



        $db->exec("insert into exam (ex_name, ex_start, ex_end, ex_grade)
                   values ('$name','$start','$end', '$grade')");

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
      try{
      $query2 = $db->query("select max(ex_num) from exam");
      $row2 = $query2->fetch(PDO::FETCH_ASSOC);
      $ex_num = $row2["max(ex_num)"];

      $query3 = $db->query("select * from students where st_num / 10000 >= $grade and st_num / 10000 < $grade+1");

      while ($row3 = $query3->fetch(PDO::FETCH_ASSOC)) {
        $st_num = $row3["st_num"];
        foreach ($code as $sb_num) {
          $db->exec("insert into score (ex_num, st_num, sb_num)
                     values ('$ex_num','$st_num','$sb_num')");
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
    location.replace('index.php');
    exit;
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
