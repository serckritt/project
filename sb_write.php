<?php
  $name = "";
  $action = "sb_insert.php";

  $num = isset($_REQUEST["num"]) ? $_REQUEST["num"] : "";

  if($num){
    try {
        require("db_connect.php");
        $query = $db->query("select * from subject where sb_num=$num");
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {

          $name = $row["sb_name"];
          $sb_num = $num;
          $sb_name = $name;
          $action = "sb_update.php";
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
          <th>과목코드</th>
          <td><input type="text" name="num" maxlength="20" value="<?=$num?>"></td>
        </tr>
        <tr>
            <th>과목명</th>
            <td><input type="text" name="name" maxlength="20" value="<?=$name?>"></td>
        </tr>
    </table>
    <input class="invisible" type="text" name="sb_num" maxlength="20" value="<?=$sb_num?>">
    <input class="invisible" type="text" name="sb_name" maxlength="20" value="<?=$sb_name?>">
    <input type="submit" value="저장">
    <input type="button" value="취소" onclick="history.back()">
</form>

</body>
</html>
