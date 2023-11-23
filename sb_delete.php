<?php
  $num   = $_REQUEST["num"  ];

  try {
      require("db_connect.php");


      $db->exec("
      SET foreign_key_checks = 0;
      delete from subject where sb_num='$num';
      delete from score where sb_num='$num';
      SET foreign_key_checks = 1;");

  } catch (PDOException $e) {
      exit($e->getMessage());
  }

 
  header("Location:subject.php");
  exit();

?>
