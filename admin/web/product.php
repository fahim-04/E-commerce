<?php
session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php';

// Get the search term from the query parameter
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch products based on search or show all
if (!empty($searchTerm)) {
    $products = searchProducts($conn, $searchTerm);
} else {
    $products = getAllProducts($conn); // Ensure this function exists in your included files
}


// Get filters from the request
$filters = [
    'min_price' => isset($_GET['min_price']) ? (float)$_GET['min_price'] : null,
    'max_price' => isset($_GET['max_price']) ? (float)$_GET['max_price'] : null,
    'category_id' => isset($_GET['cate_id']) ? (int)$_GET['cate_id'] : null,
    'subcategory_id' => isset($_GET['subcate_id']) ? (int)$_GET['subcate_id'] : null,
];

// Get products based on filters
// $products = getFilteredProducts($conn, $filters);

// Fetch categories and subcategories for the filter UI
$categories = getCategories($conn);
$subcategories = !empty($filters['category_id']) ? getSubcategories($conn, $filters['category_id']) : [];

// Pagination variables
$limit = 20; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page is at least 1
$offset = ($page - 1) * $limit;

// Fetch total number of products
$totalProductsQuery = "SELECT COUNT(*) as total FROM ec_product WHERE status = 1";
$totalProductsResult = $conn->query($totalProductsQuery);
$totalProducts = $totalProductsResult->fetch(PDO::FETCH_ASSOC)['total'];

// Fetch products for the current page
$productQuery = "SELECT * FROM ec_product WHERE status = 1 LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($productQuery);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total pages
$totalPages = ceil($totalProducts / $limit);
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
        .product-list {
            margin-top: 40px;
        }

        .product-list .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product-card {
            flex: 0 0 calc(25% - 10px);
            box-sizing: border-box;
            margin-bottom: 20px;
            text-align: center;
        }

        .product-image {
            width: 80%;
            max-width: 200px;
            margin: 0 auto;
        }

        .product-title {
            font-size: 18px;
            text-decoration: none;
        }

        .product-title:hover {
            color: #d9534f;
        }

        .product-price {
            margin-top: 10px;
            font-size: 16px;
            color: #6b6b6b;
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

        .filter-container {
            width: 100%;
            max-width: 300px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .filter-section {
            margin-bottom: 20px;
        }

        .filter-section h4 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
        }

        .filter-section input[type="number"],
        .filter-section select {
            width: 100%;
            padding: 8px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .filter-section button {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            color: #fff;
            background-color: #d9534f;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filter-section button:hover {
            background-color: #0056b3;
        }

        .filter-section button#resetFilters {
            background-color: #6c757d;
            margin-top: 10px;
        }

        .filter-section button#resetFilters:hover {
            background-color: #5a6268;
        }

        .pagination {
            margin: 50px;
            
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

        .pagination a.active {
            font-weight: bold;
            color: #d9534f;
        }

        .pagination a:hover {
            text-decoration: underline;
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
        }

        @media (max-width: 575px) {
            .product-card {
                flex: 0 0 100%;
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

    <aside class="prod-filter-section">
        <div class="filter-container">
            <form id="filterForm" method="GET" action="product.php">
                <!-- Price Range Filter -->
                <div class="filter-section">
                    <h4>Price Range</h4>
                    <input type="number" name="min_price" placeholder="Min Price" value="<?= htmlspecialchars($filters['min_price']) ?>">
                    <input type="number" name="max_price" placeholder="Max Price" value="<?= htmlspecialchars($filters['max_price']) ?>">
                </div>

                <!-- Category Filter -->
                <div class="filter-section">
                    <h4>Category</h4>
                    <select name="cate_id" id="categorySelect" onchange="this.form.submit()">
                        <option value="">Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['cate_id']) ?>" <?= $filters['cate_id'] == $category['cate_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['cate_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Subcategory Filter -->
                <?php if (!empty($subcategories)): ?>
                    <div class="filter-section">
                        <h4>Subcategory</h4>
                        <select name="subcate_id" id="subcategorySelect" onchange="this.form.submit()">
                            <option value="">Subcategories</option>
                            <?php foreach ($subcategories as $subcategory): ?>
                                <option value="<?= $subcategory['subcate_id'] ?>" <?php $filters['subcategory_id'] == $subcategory['cate_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($subcategory['subcate_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <!-- Apply Filters Button -->
                <div class="filter-section">
                    <button type="submit">Apply Filters</button>
                    <button type="reset" id="resetFilters" onclick="window.location='product.php'">Reset</button>
                </div>
            </form>
        </div>

        <div class="container" style="width: 450px;">
            <div class="row">
                <!-- Search Bar -->
                <div class="search-bar-container" style="margin: 10px 0; text-align: center;">
                    <form action="product.php" method="GET">
                        <input type="text" name="search" placeholder="Search products..."
                            value="<?php echo htmlspecialchars($searchTerm) ?>"
                            style="padding: 10px; font-size: 14px;">
                        <button type="submit"
                            style="padding: 10px 20px; background-color: #d9534f; color: white; border: none; border-radius: 20px; cursor: pointer;">
                            Search
                        </button>
                    </form>
                </div>
            </div>
    </aside>

    <section class="product-list">
        <div class="container">
            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                            <div class="product-card">
                                <img class="product-image"
                                    src="<?php echo htmlspecialchars($product['pro_image'] ?? 'default-image.jpg'); ?>"
                                    alt="<?php echo htmlspecialchars($product['pro_name'] ?? 'No Name Available'); ?>">
                                <h4 class="product-price">$<?php echo number_format($product['selling_price'] ?? 0, 2); ?></h4>
                                <a href="product-details.php?id=<?php echo htmlspecialchars($product['pro_id'] ?? '#'); ?>"
                                    class="product-title">
                                    <?php echo htmlspecialchars($product['pro_name'] ?? 'Unknown Product'); ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found for your search.</p>
                <?php endif; ?>

                
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <div class="container">
        <div class="row">
            <div class="pagination text-center">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <?php include $filepath . '/footer-web.php'; ?>

    <span id="back-top" class="fa fa-arrow-up"></span>
    <!-- ajax function to get subcategory -->
    <script>
        // Dynamically load subcategories when category changes
        $('#categorySelect').on('change', function() {
            const categoryId = $(this).val();
            $.ajax({
                url: 'get_subcategories.php',
                type: 'GET',
                data: {
                    category_id: categoryId
                },
                success: function(data) {
                    const subcategories = JSON.parse(data);
                    let options = '<option value="">All Subcategories</option>';
                    subcategories.forEach(function(subcategory) {
                        options += `<option value="${subcategory.id}">${subcategory.cate_name}</option>`;
                    });
                    $('#subcategorySelect').html(options);
                }
            });
        });

        // Reset filters
        $('#resetFilters').on('click', function() {
            window.location.href = 'product.php';
        });
    </script>

    <!-- Include JS Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.main.js"></script>
</body>

</html>