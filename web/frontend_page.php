<?php
session_start();
$filepath = realpath(dirname(__FILE__));
include $filepath . "../admin/backend/connection.php";
include $filepath . "../admin/backend/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include $filepath . '../admin/backend/links.php';?>
</head>
<body>
    <a class="btn btn-primary" href="../admin/backend/logout.php">Logout</a>
</body>
</html>