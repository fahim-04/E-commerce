<?php
include 'db-conn.php';

try {
    $dns = "mysql:host=localhost;dbname=ecom;charset=utf8";
    $username = "root";
    $password = "";
    $conn = new PDO($dns, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("set names utf8"); // Corrected to use $conn instead of $pdo
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>