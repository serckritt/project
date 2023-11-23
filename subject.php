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
        <th>과목코드</th>
        <th>과목명  </th>
        <th>수정/삭제</th>
    </tr>
<?php
    try {
        require("db_connect.php");
        $query = $db->query("select * from subject order by sb_num");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
        <tr>
            <td><?=$row["sb_num"]?></td>
            <td><?=$row["sb_name"]?></td>
            <td><input type="button" value="수정" onclick="location.href='sb_write.php?num=<?=$row["sb_num"]?>'">
                <input type="button" value="삭제" onclick="location.href='sb_delete.php?num=<?=$row["sb_num"]?>'"> </td>
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
    <input type="button" value="추가" onclick="location.href='sb_write.php'">
  </body>
</html>
