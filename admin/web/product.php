<?php
session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php';

// Fetch the search term from GET request
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Pagination variables
$limit = 20; // Items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;

$products = []; // Initialize products array
if (!empty($searchTerm)) {
    $keywords = preg_split('/\s+/', $searchTerm);
    $conditions = [];
    $params = [];

    foreach ($keywords as $index => $keyword) {
        $conditions[] = "(
            LOWER(pro_name) LIKE LOWER(CONCAT('%', :keyword$index, '%')) OR 
            LOWER(meta_key) LIKE LOWER(CONCAT('%', :keyword$index, '%'))
        )";
        $params["keyword$index"] = $keyword;
    }

    $whereClause = implode(' AND ', $conditions);

    // Query to fetch total number of products
    $totalProductsQuery = "
        SELECT COUNT(*) as total
        FROM ec_product
        WHERE status = 1 AND ($whereClause)
    ";

    $stmt = $conn->prepare($totalProductsQuery);
    foreach ($params as $paramName => $value) {
        $stmt->bindValue(":$paramName", $value, PDO::PARAM_STR);
    }
    $stmt->execute();
    $totalProducts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Query to fetch product data
    $productsQuery = "
        SELECT pro_id, pro_name, pro_image, selling_price
        FROM ec_product
        WHERE status = 1 AND ($whereClause) AND pro_image IS NOT NULL
        ORDER BY pro_name DESC
        LIMIT :limit OFFSET :offset
    ";

    $stmt = $conn->prepare($productsQuery);
    foreach ($params as $paramName => $value) {
        $stmt->bindValue(":$paramName", $value, PDO::PARAM_STR);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch all products when no search term is provided
    $products = getAllProducts($conn, $limit, $offset);
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM ec_product WHERE status = 1");
    $stmt->execute();
    $totalProducts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

$totalPages = ceil($totalProducts / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snaptech. | Product</title>
    <link rel="shortcut icon" href="images/ST.png" type="image/x-icon">
    <?php
    $filepath = realpath(dirname(__FILE__));
    include $filepath . '/web-links.php';
    ?>

    <style>
        .product-list {
            margin-top: 40px;
        }

        .product-list .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product-section {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            /* Adjusts spacing between product cards */
            margin-top: 20px;
        }

        .prod-filter-section {
            margin-top: 40px;
            display: flex;
            flex: wrap;
        }

        .product-card {

            border-radius: 5px;
            padding: 15px;
            text-align: center;

        }

        .product-image {
            width: 80%;
            max-width: 160px;
            margin: 0 auto;
            object-fit: contain;
            display: block;
        }

        .product-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }

        .product-title:hover {
            color: #d9534f;
        }

        .product-price {
            margin-top: 10px;
            font-weight: bold;
            font-size: 14px;
            color: #010101;
        }

        .search-bar-container input {
            border-radius: 20px;
            width: 300px;
            border: 1px solid #ccc;
        }

        .search-bar-container button {
            border-radius: 20px;
            border: 1px solid #d9534f;
        }

        .pagination {
            margin: 50px;
            margin: 10px auto;

        }

        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: #000;
            cursor: pointer;
            padding: 5px 10px;
            /* margin: 20px; */
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .page-div {
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .pagination a.active {
            font-weight: bold;
            color: #d9534f;
        }

        .search-bar {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px;
        }

        .search-bar input {
            width: 80%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .search-bar button {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #d9534f;
            background-color: #d9534f;
            color: #fff;
            font-size: 16px;
        }

        .search-bar button:hover {
            background-color: #f4f4f4;
            color: #d9534f;
        }


        @media (max-width: 991px) {
            .product-card {
                flex: 0 0 calc(33.33% - 10px);
            }
        }

        @media (max-width: 767px) {
            .product-card {
                flex: 0 0 calc(50% - 10px);
            }

            .product-section {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }

        @media (max-width: 575px) {
            .product-card {
                flex: 0 0 100%;
            }

            .product-section {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="pre-loader" class="loader-container">
            <div class="loader">
                <img src="images/svg/rings.svg" alt="loader">
            </div>
        </div>
        <div class="w1">
            <?php include $filepath . '/navbar.php'; ?>
        </div>
    </div>

    <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-color:rgb(233, 233, 233);">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>PRODUCT</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container search-bar" style="width: 450px;">
        <form action="product.php" method="GET">
            <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>
        </form>
    </div

        <section class="product-list">
    <div class="container">
        <div class="row">
            <div class="product-section">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $row => $product): ?>
                        <?php if (!empty($product['pro_name']) && !empty($product['pro_image']) && !empty($product['selling_price']) && !empty($product['pro_id'])): ?>
                            <div class="product-card">
                                <img class="product-image"
                                    src="<?php echo htmlspecialchars($product['pro_image']); ?>"
                                    alt="<?php echo htmlspecialchars($product['pro_name']); ?>">
                                <a href="product-details.php?pro_id=<?php echo htmlspecialchars($product['pro_id']); ?>"
                                    class="product-title">
                                    <?php echo htmlspecialchars($product['pro_name']); ?>
                                    <h4 class="product-price">$<?php echo number_format($product['selling_price'], 2); ?></h4>
                                </a>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found for your search.</p>
                <?php endif; ?>
            </div>



        </div>
    </div>
    </section>

    <!-- Pagination -->
    <div class="container">
        <div class="row page-div">
            <?php
            echo '<div class="pagination text-center m-4">';
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="?page=' . $i . '&search=' . urlencode($searchTerm) . '"' .
                    ($i === $page ? ' class="active"' : '') . '>' . $i . '</a>';
            }
            echo '</div>'; ?>
        </div>
    </div>



    <?php include $filepath . '/footer-web.php'; ?>

    <span id="back-top" class="fa fa-arrow-up"></span>



    <!-- Include JS Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.main.js"></script>
</body>

</html>