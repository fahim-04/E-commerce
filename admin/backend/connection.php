<?php
include 'db-conn.php';

try {
    $dsn = "mysql:host=localhost;dbname=ecom;charset=utf8";
    $username = "root";
    $password = "";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("set names utf8");
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
