<?php
// session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php'; // Include the updated functions file

// Get the search term from the query parameter
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch products based on search or show all
if (!empty($searchTerm)) {
    $products = searchProducts($conn, $searchTerm);
} else {
    $products = getAllProducts($conn);
}
?>