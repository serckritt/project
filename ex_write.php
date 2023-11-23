<?php
  $action = "ex_insert.php";
  $name = "";
  $start = "";
  $end = "";
  $grade = "";
  $i = "";
  $checked= [];

  $num = isset($_REQUEST["num"]) ? $_REQUEST["num"] : "";

  if($num){
    try {
        require("db_connect.php");
        $query = $db->query("select * from exam where ex_num=$num");
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {

          $start =  $row["ex_start"];
          $end =  $row["ex_end"];
          $name = $row["ex_name"];
          $grade = $row["ex_grade"];
          $action = "ex_update.php";
          $i = 0;
        }
        $query = $db->query("select distinct sb_num from score where ex_num=$num");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $checked[$i] = $row["sb_num"];
          $i++;
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
            <th>시험명</th>
            <td><input type="text" name="name" maxlength="20" value="<?=$name?>"></td>
        </tr>
        <tr>
            <th>시작일시</th>
            <td><input type="date" name="start" value="<?=$start?>"></td>
        </tr>
        <tr>
            <th>종료일시</th>
            <td><input type="date" name="end" value="<?=$end?>"></td>
        </tr>
        <tr>
            <th>대상학년</th>
            <td><input type="radio" name="grade" value="1" <?php if($grade==1){?>checked<?php } ?>>1학년
              <input type="radio" name="grade" value="2"<?php if($grade==2){?>checked<?php } ?>>2학년
              <input type="radio" name="grade" value="3"<?php if($grade==3){?>checked<?php } ?>>3학년
                <br><?php if($num){ ?>※학년 수정 시 이전 정보는 삭제되며 되돌릴 수 없습니다!!※ <?php } ?> </td>
        </tr>
        <tr>
            <th>과목</th>
            <td>
<?php
    try {
        require("db_connect.php");
        $query = $db->query("select * from subject order by sb_num");
        $i=0;
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>

            <p><input type="checkbox" name="code[]" value="<?=$row["sb_num"]?>"
<?php
              for($i = 0; $i < count($checked); $i++) {

              if($checked[$i] == $row["sb_num"]){

?>
checked <?php  break;}}?>               >   <?=$row["sb_name"]?></p>

<?php          $i++;
        }
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
?>        <?php if($num){ ?>※체크 해제 시 해당 과목 정보는 삭제되며 되돌릴 수 없습니다!!※</td> <?php } ?>
        </tr>
    </table>
    <input class="invisible" type="text" name="ex_num" maxlength="20" value="<?=$num?>">
    <input class="invisible" type="text" name="ex_grade" maxlength="20" value="<?=$grade?>">
    <input type="submit" value="저장">
    <input type="button" value="취소" onclick="history.back()">
</form>

</body>
</html>
