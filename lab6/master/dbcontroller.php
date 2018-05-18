<?php
    $dsn = "mysql:host=localhost;dbname=phpclassspring2018;";
    $userName="PHPClassSpring2018";
    $pWord="SE266";
    try { $db = new PDO($dsn, $userName, $pWord); }
    catch(PDOException $e) {
        echo $e->getMessage();
        die("Cannot connect to database");
    }
?>