<!DOCTYPE html>
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
    <div>
      <table>
        <tr>
          <th>시험명</th>
          <th>대상학년</th>
          <th>시작일시</th>
          <th>종료일시</th>
          <th>조회</th>
          <th>수정/삭제</th>
        </tr>
<?php
    try {
        require("db_connect.php");
        $query = $db->query("select * from exam order by ex_start");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
        <tr>
            <td><?=$row["ex_name"]?></td>
            <td><?=$row["ex_grade"]?>학년</td>
            <td><?=$row["ex_start"]?></td>
            <td><?=$row["ex_end"]?></td>
            <td><input type="button" value="조회" onclick="location.href='score.php?num=<?=$row["ex_num"]?>'"></td>
            <td><input type="button" value="수정" onclick="location.href='ex_write.php?num=<?=$row["ex_num"]?>'">
                <input type="button" value="삭제" onclick="location.href='ex_delete.php?num=<?=$row["ex_num"]?>'"> </td>
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
    <input type="button" value="추가" onclick="location.href='ex_write.php'">
  </body>
</html>
