<?php
  $num =  $_REQUEST["num" ];
  $name  = $_REQUEST["name" ];
  $sb_num = $_REQUEST["sb_num" ];
  $sb_name = $_REQUEST["sb_name" ];

  if ($num && $name && $sb_num && $sb_name) {

    try {
        require("db_connect.php");

        $query = $db->query("select count(*) from subject where sb_name = '$name' or sb_num = '$num'");
        $row = $query->fetch(PDO::FETCH_ASSOC);
 
        if($row["count(*)"]==0 || $num==$sb_num || $name==$sb_name){

        $db->exec("SET foreign_key_checks = 0;
                  update subject set sb_num = '$num', sb_name = '$name'
                  where sb_num = $sb_num;
                  update score set sb_num = '$num'
                  where sb_num = $sb_num;
                   SET foreign_key_checks = 1;");
        }

    } catch (PDOException $e) {
        exit($e->getMessage());
    }

    if ($row["count(*)"]!=0 && $num!=$sb_num && $name!=$sb_name){
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
