<?php
  $grade   = $_REQUEST["grade"  ];
  $class   = $_REQUEST["class"  ];
  $num   = $_REQUEST["num"  ];
  $st_name  = $_REQUEST["name" ];

  if ($grade && $class && $num && $st_name) {

    try {
        require("db_connect.php");

        $st_num = $grade*10000 + $class*100 + $num;

        $query = $db->query("select count(*) from students where st_num = '$st_num'");
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($row["count(*)"]==0){

        $db->exec("insert into students (st_num, st_name)
                   values ('$st_num', '$st_name')");

 
        }

    } catch (PDOException $e) {
        exit($e->getMessage());
    }

    if ($row["count(*)"]!=0){
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
