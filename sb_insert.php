<?php
  $num =  $_REQUEST["num" ];
  $name  = $_REQUEST["name" ];

  if ($num && $name) {

    try {
        require("db_connect.php");

        $query = $db->query("select count(*) from subject where sb_name = '$name' or sb_num = '$num'");
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($row["count(*)"]==0){

        $db->exec("insert into subject (sb_num, sb_name)
                   values ('$num', '$name')");
        }

    } catch (PDOException $e) {
        exit($e->getMessage());
    }

    if ($row["count(*)"]!=0){
?>
<script>
    alert('중복되는 항목입니다.');
    history.back();
</script>
<?php
    }else{
      header("Location:subject.php");
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
