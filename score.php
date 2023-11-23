<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>성적 관리 시스템</title>
    <style>
      body{
        text-align: center;
      }
      table{
        border-collapse: collapse;
        margin: auto;
        border:  1px solid #000;
      }
      th{
        border:  1px solid #000;
        width: 150px;
        background-color: yellow;
      }
      td{
        border:  1px solid #000;
        width: 150px;
      }
    </style>
</head>
<body>
<?php
  require("header.php");
?>
<table>
    <tr>
        <th>학년</th>
        <th>반</th>
        <th>번호</th>
        <th>이름</th>
<?php
    $ex_num = $_REQUEST["num"];
    $sum = 0;
    $count = 0;
    try {
       require("db_connect.php");
        $query = $db->query("SELECT distinct sb.sb_name
          FROM score sc, subject sb, exam ex
          WHERE ex.ex_num = '$ex_num' and sc.sb_num = sb.sb_num AND ex.ex_num = sc.ex_num
          order by sb.sb_num;");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>

        <th><?=$row["sb_name"]?></th>

<?php
        }
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
?>
        <th>합계</th>
        <th>평균</th>
        <th>수정</th>
    </tr>
<?php
    try {
        $query = $db->query("SELECT distinct st.st_num, st.st_name
            FROM score sc, subject sb, exam ex, students st
            WHERE ex.ex_num = '$ex_num' and sc.sb_num = sb.sb_num AND st.st_num = sc.st_num AND ex.ex_num = sc.ex_num
            order by st.st_num;");

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $sum =0;
          $count =0;
          $st_num = $row["st_num"];
?>
    <tr>
      <td><?=floor($row["st_num"]/10000)?></td>
      <td><?=floor($row["st_num"]%10000/100)?></td>
      <td><?=floor($row["st_num"]%10000%100)?></td>
      <td><?=$row["st_name"]?></td>
<?php
          try{
            require("db_connect.php");
            $query2 = $db->query("SELECT sc.sc_score
                FROM score sc, subject sb, exam ex, students st
                WHERE ex.ex_num = '$ex_num' and sc.sb_num = sb.sb_num AND ex.ex_num = sc.ex_num AND st.st_num = '$st_num' and st.st_num = sc.st_num
                order by sb.sb_num;");
                while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                $sum += $row2["sc_score"];
                $count++;
?>

      <td><?=$row2["sc_score"]?></td>

<?php
                }
            } catch (PDOException $e) {
                exit($e->getMessage());
            }
?>
      <td><?=$sum?></td>
      <td><?=round($sum/$count,2)?></td>
      <td><input type="button" value="수정" onclick="location.href='sc_write.php?st_num=<?=$st_num?>&ex_num=<?=$ex_num?>'"></td>
    </tr>
<?php
        }
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
?>
  </table>
    </div>
    <br>
    <input type="button" value="뒤로" onclick="location.href='exam.php'">
  </body>
</html>
