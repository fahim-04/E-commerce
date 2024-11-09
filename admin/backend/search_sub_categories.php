<?php
include_once 'functions.php';

if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Ensure this matches the limit in `getTotalSubCategories`

    $subCategories = get_sub_Categories($conn, $page, $limit, $search);
    echo $subCategories;
}
