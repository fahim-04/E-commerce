<?php
// Include the database connection and necessary functions
include 'db-conn.php';
include 'functions.php';

// Check if 'id' is provided in the GET request
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id']; // Ensure it's an integer to prevent SQL injection

    // SQL query to delete the product
    $sql = "DELETE FROM ec_product WHERE pro_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Successful deletion
            header("Location: view-products.php?message=Product+deleted+successfully");
        } else {
            // Failed deletion or product not found
            header("Location: view-products.php?error=Product+not+found+or+deletion+failed");
        }
        
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing statement
        header("Location: view-products.php?error=Database+error");
    }
} else {
    // No product ID provided
    header("Location: view-products.php?error=No+product+ID+provided");
}

// Close the database connection
mysqli_close($conn);
?>
