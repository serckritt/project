<?php
  $num   = $_REQUEST["num"  ];

  try {
      require("db_connect.php");


      $db->exec("
      SET foreign_key_checks = 0;
      delete from exam where ex_num='$num';
      delete from score where ex_num='$num';
      SET foreign_key_checks = 1;");

  } catch (PDOException $e) {
      exit($e->getMessage());
  }


  header("Location:exam.php");
  exit();

?>
