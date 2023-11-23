<?php

  $st_num = isset($_REQUEST["st_num"]) ? $_REQUEST["st_num"] : "";
  $ex_num = isset($_REQUEST["ex_num"]) ? $_REQUEST["ex_num"] : "";

  if($st_num&&$ex_num){
    try {
        require("db_connect.php");
        $query = $db->query("SELECT distinct st.st_name, ex.ex_name
            FROM score sc, subject sb, exam ex, students st
            WHERE ex.ex_num = '$ex_num' and sc.sb_num = sb.sb_num AND st.st_num = sc.st_num AND ex.ex_num = sc.ex_num and st.st_num = '$st_num'");
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $st_name =  $row["st_name"];
            $ex_name =  $row["ex_name"];
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
      margin: 20px auto;
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
    input[type=text], textarea {
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
<form method="post" action="sc_update.php">
    <table>
        <tr>
          <th>학년</th>
          <td><?=floor($st_num/10000)?>학년</td>
        </tr>
        <tr>
          <th>반</th>
          <td><?=floor($st_num%10000/100)?>반</td>
        </tr>
        <tr>
          <th>번호</th>
          <td><?=floor($st_num%10000%100)?></td>
        </tr>
        <tr>
          <th>이름</th>
          <td><?=$st_name?></td>
        </tr>
        <tr>
          <th>시험명</th>
          <td><?=$ex_name?></td>
        </tr>
<?php
        try{
          require("db_connect.php");
          $query2 = $db->query("SELECT sb.sb_num, sb.sb_name, sc.sc_score
              FROM score sc, subject sb, exam ex, students st
              WHERE ex.ex_num = '$ex_num' and sc.sb_num = sb.sb_num AND ex.ex_num = sc.ex_num AND st.st_num = '$st_num' and st.st_num = sc.st_num
              order by sb.sb_num;");
              while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
?>

        <tr>
          <th><?= $row2["sb_name"]?></th>
          <td><input type="text" name="<?=$row2["sb_num"]?>" maxlength="20" value="<?=$row2["sc_score"]?>"></td>
        </tr>

<?php
              }
          } catch (PDOException $e) {
              exit($e->getMessage());
          }
?>
    </table>
    <input class="invisible" type="text" name="st_num" maxlength="20" value="<?=$st_num?>">
    <input class="invisible" type="text" name="ex_num" maxlength="20" value="<?=$ex_num?>">
    <input type="submit" value="저장">
    <input type="button" value="취소" onclick="history.back()">
</form>

</body>
</html>
