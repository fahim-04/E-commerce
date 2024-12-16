<?php
// Include necessary files and initialize connection
include '../backend/connection.php';
include 'functions-web.php';

// Get the category ID from the request
$categoryId = isset($_GET['cate_id']) ? (int)$_GET['cate_id'] : 0;

if ($categoryId > 0) {
    // Fetch subcategories using the helper function
    $subcategories = getSubcategories($conn, $categoryId);

    // Return the subcategories as a JSON response
    header('Content-Type: application/json');
    echo json_encode($subcategories);
} else {
    // Return an empty array if no valid category ID is provided
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>