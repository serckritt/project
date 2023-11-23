<?php
  $grade = "";
  $class = "";
  $num = "";
  $name = "";
  $action = "st_insert.php";

  $st_num = isset($_REQUEST["num"]) ? $_REQUEST["num"] : "";

  if($st_num){
    try {
        require("db_connect.php");
        $query = $db->query("select * from students where st_num=$st_num");
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $grade = floor($row["st_num"]/10000);
          $class = floor($row["st_num"]%10000/100);
          $num =  floor($row["st_num"]%10000%100);
          $name = $row["st_name"];
          $action = "st_update.php";
        }
    } catch (PDOException $e) {
        exit($e->getMessage());
    } 
  }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
    body{
      text-align: center;
    }
    table {
      width:680px;
      text-align:center;
      margin: 20px auto 10px auto;
      border-collapse: collapse;
    }
    th    {
      width:100px;
      background-color:yellow;
      border: 1px solid #000;
    }
    td{
      border: 1px solid #000;
    }
    input[type=text],input[type=date], textarea {
      width:99%;
      border : none;
      text-align: center;
    }

    .invisible{
      display: none;
    }
    </style>
</head>
<body>
  <?php
    require("header.php");
  ?>
<form method="post" action="<?=$action?>">
    <table>
        <tr>
            <th>학년</th>
            <td><input type="text" name="grade" maxlength="10" value="<?=$grade?>"></td>
        </tr>
        <tr>
            <th>반</th>
            <td><input type="text" name="class" maxlength="10" value="<?=$class?>"></td>
        </tr>
        <tr>
            <th>번호</th>
            <td><input type="text" name="num" maxlength="10" value="<?=$num?>"></td>
        </tr>
        <tr>
            <th>이름</th>
            <td><input type="text" name="name" maxlength="20" value="<?=$name?>"></td>
        </tr>
    </table>
          <input class="invisible" type="text" name="st_num" maxlength="20" value="<?=$st_num?>">
    <input type="submit" value="저장">
    <input type="button" value="취소" onclick="history.back()">
</form>

</body>
</html>
