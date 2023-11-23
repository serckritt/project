<?php
  $grade   = $_REQUEST["grade"  ];
  $class   = $_REQUEST["class"  ];
  $num   = $_REQUEST["num"  ];
  $name  = $_REQUEST["name" ];
  $st_num = $_REQUEST["st_num" ];


  if ($grade && $class && $num && $name && $st_num) {

    try {
        require("db_connect.php");

        $num = $grade*10000 + $class*100 + $num;

        $query = $db->query("select count(*) from students where st_num = '$num'");
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($row["count(*)"]==0 || $num==$st_num){

        $db->exec("SET foreign_key_checks = 0;
                  update students set st_num = '$num', st_name = '$name'
                  where st_num = $st_num;
                  update score set st_num = '$num'
                  where st_num = $st_num;
                  SET foreign_key_checks = 1;");
        }

    } catch (PDOException $e) {
        exit($e->getMessage());
    }

    if ($row["count(*)"]!=0 && $num!=$st_num){
?>
<script>
    alert('중복되는 학번입니다.');
    history.back();
</script>
<?php
    }else{
      header("Location:students.php");
      exit();
    }
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
