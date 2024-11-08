<?php
session_start();
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ensure only admins can delete users
    if ($_SESSION['user_type'] === 'admin') {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: view-users.php");
            exit();
        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "Unauthorized access.";
    }
} else {
    echo "Invalid request.";
}
