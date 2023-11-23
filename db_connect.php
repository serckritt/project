<?php
    $db = new PDO("mysql:host=localhost;port=3307;dbname=phpdb", "php", "1234");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
