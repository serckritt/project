<?php
  $num   = $_REQUEST["num"  ];

  try {
      require("db_connect.php");


      $db->exec("
      SET foreign_key_checks = 0;
      delete from students where st_num='$num';
      delete from score where st_num='$num';
      SET foreign_key_checks = 1;");

  } catch (PDOException $e) {
      exit($e->getMessage());
  }


  header("Location:students.php");
  exit();

?>
