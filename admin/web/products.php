<?php
session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php';

// Database connection
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ecom";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Fetch categories
$categoriesQuery = "SELECT * FROM ec_categories";
$categoriesResult = $conn->query($categoriesQuery);

// Fetch subcategories dynamically
$subcategoriesQuery = "SELECT * FROM ec_sub_categories";
$subcategoriesResult = $conn->query($subcategoriesQuery);

// Handle filtering and search
$whereClauses = [];
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $whereClauses[] = "pro_cate = '$category'";
}

if (isset($_GET['subcategories'])) {
    $subcategories = implode("','", $_GET['subcategories']);
    $whereClauses[] = "pro_sub_cate IN ('$subcategories')";
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $whereClauses[] = "(pro_name LIKE '%$search%' OR meta_key LIKE '%$search%')";
}

if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
    $minPrice = $_GET['min_price'];
    $maxPrice = $_GET['max_price'];
    $whereClauses[] = "selling_price BETWEEN $minPrice AND $maxPrice";
}

// Compile WHERE clause
$whereClause = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";

// Pagination setup
$itemsPerPage = 25;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Fetch products
$productsQuery = "SELECT * FROM ec_product $whereClause LIMIT $itemsPerPage OFFSET $offset";
$productsResult = $conn->query($productsQuery);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snaptech. | Product</title>
    <?php
    $filepath = realpath(dirname(__FILE__));
    include $filepath . '/web-links.php';


    ?>
    <style>
        /* Add your styling here */
        .container {
            display: flex;
        }

        .filter-section {
            flex: 2;
            padding: 10px;
            border-right: 1px solid #ddd;
        }

        .product-section {
            flex: 10;
            padding: 10px;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include $filepath . '/navbar.php'; ?>

    <div id="wrapper">
        <!-- <div id="pre-loader" class="loader-container">
            <div class="loader">
                <img src="images/svg/rings.svg" alt="Loader">
            </div>
        </div> -->

        <div class="w1">
            <header id="mt-header" class="style4">
                <div class="mt-bottom-bar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="mt-search-popup">
                                    <div class="mt-holder">
                                        <a href="#" class="search-close">
                                            <span></span><span></span>
                                        </a>
                                        <div class="mt-frame">
                                            <form action="search.php" method="GET">
                                                <fieldset>
                                                    <input type="text" name="q" placeholder="Search...">
                                                    <button class="icon-magnifier" type="submit"></button>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main id="mt-main">
                <section class="mt-contact-banner style4" style="background-image: url(images/img11.jpg);">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <h1>Products</h1>
                                <nav class="breadcrumbs">
                                    <ul class="list-unstyled">
                                        <li><a href="index.php">Home <i class="fa fa-angle-right"></i></a></li>
                                        <li>Products</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="container">
                    <!-- Filter Section -->
                    <div class="filter-section">
                        <h3>Filters</h3>
                        <form method="GET" action="products.php">
                            <!-- Category Dropdown -->
                            <label for="category">Category:</label>
                            <select id="category" name="category" onchange="this.form.submit()">
                                <option value="">Select Category</option>
                                <?php while ($row = $categoriesResult->fetch_assoc()): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                                <?php endwhile; ?>
                            </select>

                            <!-- Subcategories -->
                            <div>
                                <h4>Subcategories:</h4>
                                <?php while ($row = $subcategoriesResult->fetch_assoc()): ?>
                                    <label>
                                        <input type="checkbox" name="subcategories[]" value="<?= $row['id'] ?>"
                                            onchange="this.form.submit()"> <?= $row['sub_category_name'] ?>
                                    </label><br>
                                <?php endwhile; ?>
                            </div>

                            <!-- Price Filter -->
                            <h4>Price:</h4>
                            <label for="min_price">Min:</label>
                            <input type="number" id="min_price" name="min_price">
                            <label for="max_price">Max:</label>
                            <input type="number" id="max_price" name="max_price">
                            <button type="submit">Apply</button>

                            <!-- Reset Button -->
                            <button type="button" onclick="window.location.href='products.php'">Reset</button>
                        </form>
                    </div>

                    <!-- Product Section -->
                    <div class="product-section">
                        <h3>Products</h3>
                        <div class="product-grid">
                            <?php while ($row = $productsResult->fetch_assoc()): ?>
                                <div class="product-card">
                                    <img src="<?= $row['image_url'] ?>" alt="<?= $row['pro_name'] ?>" style="width:100%; height:200px;">
                                    <p style="color: #ff6060;">$<?= $row['selling_price'] ?></p>
                                    <h4><?= $row['pro_name'] ?></h4>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            <a href="?page=<?= max(1, $page - 1) ?>">Previous</a>
                            <a href="?page=<?= $page + 1 ?>">Next</a>
                        </div>
                    </div>
                </div>
        </div>
        </main>
        <?php include 'footer-web.php'; ?>
    </div>
    <span id="back-top" class="fa fa-arrow-up"></span>
    </div>
