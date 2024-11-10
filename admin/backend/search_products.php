<?php
// session_start();
// include 'functions.php';



// Get the search query and sanitize it
$search = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : "";

// Fetch and display products based on the search query
// Page set to 1 with limit of 10
