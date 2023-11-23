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
          <th>학년</th>
          <th>반</th>
          <th>번호</th>
          <th>이름</th>
          <th>수정/삭제 </th>
        </tr>
<?php
    try {
        require("db_connect.php");
        $query = $db->query("select * from students order by st_num");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?> 
        <tr>
            <td><?=floor($row["st_num"]/10000)?>학년</td>
            <td><?=floor($row["st_num"]%10000/100)?>반</td>
            <td><?=floor($row["st_num"]%10000%100)?></td>
            <td><?=$row["st_name"]?></td>
            <td><input type="button" value="수정" onclick="location.href='st_write.php?num=<?=$row["st_num"]?>'">
                <input type="button" value="삭제" onclick="location.href='st_delete.php?num=<?=$row["st_num"]?>'"> </td>
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
    <input type="button" value="추가" onclick="location.href='st_write.php'">
  </body>
</html>
