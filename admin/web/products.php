<?php
session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php';

// Fetch all categories and subcategories from the database
$categoriesQuery = "SELECT * FROM ec_categories WHERE status = 1";
$categoriesResult = $conn->query($categoriesQuery);
$subcategoriesQuery = "SELECT * FROM ec_sub_categories WHERE status = 1";
$subcategoriesResult = $conn->query($subcategoriesQuery);

// Organize subcategories by parent category
$subcategories = [];
while ($sub = $subcategoriesResult->fetch(PDO::FETCH_ASSOC)) {
    $subcategories[$sub['cate_id']][] = $sub;
}


$category = $_GET['category'] ?? null;
$subcategories = $_GET['subcategories'] ?? null;
$priceRange = $_GET['price_range'] ?? null;
$searchTerm = $_GET['search_term'] ?? null;

$query = "SELECT * FROM ec_product WHERE status = 1";

if ($category) {
    $query .= " AND pro_cate = :category";
}
if ($subcategories) {
    $subcatArray = explode(',', $subcategories);
    $query .= " AND pro_sub_cate IN (" . implode(',', array_fill(0, count($subcatArray), '?')) . ")";
}
if ($priceRange) {
    $query .= " AND selling_price BETWEEN :minPrice AND :maxPrice";
}
if ($searchTerm) {
    $query .= " AND (pro_name LIKE :search OR meta_key LIKE :search)";
}

$stmt = $conn->prepare($query);
// Bind parameters dynamically...
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
        /* Custom styles for filters and layout */
        .container-fluid {
            display: flex;
            flex-wrap: wrap;
        }

        .filter-section {
            flex: 2;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .products-section {
            flex: 8;
            padding: 15px;
            position: relative;
        }

        .vertical-nav {
            width: 100%;
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .nav-item {
            margin-bottom: 10px;
            position: relative;
        }

        .dropdown-btn {
            width: 100%;
            text-align: left;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .dropdown-btn:hover {
            background-color: #0056b3;
        }

        .dropdown-content {
            display: none;
            background-color: #f1f1f1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }

        .dropdown-content a {
            display: block;
            color: #333;
            padding: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
            border-radius: 4px;
        }

        .nav-item .dropdown-btn.active+.dropdown-content {
            display: block;
        }

        #products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 60px;
        }

        .product-card {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 70%;
            height: auto;
            margin: 10px auto;
            display: block;
        }

        .product-title {
            font-size: 16px;
            margin: 10px 0;
            font-weight: bold;
        }

        .product-price {
            color: #ff6060;
            font-size: 14px;
            font-weight: bold;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .pagination button {
            padding: 10px 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            color: #333;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .pagination button.active {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .pagination button:disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        .pagination button:hover:not(:disabled) {
            background-color: #0056b3;
            color: #fff;
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
                    <aside class="filter-section">
                        <h3>Filters</h3>

                        <!-- Category Dropdown -->
                        <div class="category-filter">
                            <label for="category-dropdown">Category:</label>
                            <select id="category-dropdown">
                                <option value="">Select Category</option>
                            </select>
                            <div id="subcategory-checklist">
                                <!-- Subcategories will load dynamically -->
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div class="price-filter">
                            <label for="min-price">Min Price:</label>
                            <input type="number" id="min-price" placeholder="Min Price">
                            <label for="max-price">Max Price:</label>
                            <input type="number" id="max-price" placeholder="Max Price">
                        </div>

                        <!-- Search Bar -->
                        <div class="search-bar">
                            <label for="search-input">Search:</label>
                            <input type="text" id="search-input" placeholder="Search products...">
                        </div>

                        <!-- Reset Button -->
                        <button id="reset-button">Reset Filters</button>
                    </aside>

                    <!-- Product Section -->
                    <div class="product-section" id="products">
                        <!-- Products will load dynamically -->
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <button id="prev-button">Previous</button>
                        <span id="current-page">1</span>
                        <button id="next-button">Next</button>
                    </div>
                </div>
        </div>
        </main>
        <?php include 'footer-web.php'; ?>
    </div>
    <span id="back-top" class="fa fa-arrow-up"></span>
    </div>
</body>

</html>