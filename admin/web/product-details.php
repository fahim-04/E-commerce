<?php
        session_start();
        include '../backend/connection.php'; // Database connection
        include 'functions-web.php';


/**
 * Fetches the details of a single product by its ID.
 *
 * @param PDO $conn Database connection
 * @param int $productId The ID of the product to fetch
 * @return array|null An associative array containing product details if found, or null if not found or on error
 */


function getProductDetails($conn, $productId)
{
    $sql = "
        SELECT * 
        FROM ec_product
        WHERE pro_id = :productId AND status = 1
        LIMIT 1
    ";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return null;
    }
}

// Get product ID from query string
$productId = isset($_GET['pro_id']) ? intval($_GET['pro_id']) : 0;
$productDetails = $productId > 0 ? getProductDetails($conn, $productId) : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($productDetails['meta_desc'] ?? ''); ?>">
    <meta name="title" content="<?php echo htmlspecialchars($productDetails['meta_title'] ?? ''); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($productDetails['meta_key'] ?? ''); ?>">
    <title><?php echo htmlspecialchars($productDetails['pro_name'] ?? 'Product Details'); ?></title>

    <style>
        .product-details {
            margin-top: 50px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-title {
            font-size: 2rem;
            font-weight: bold;
        }

        .product-price {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: bold;
        }
    </style>
    <?php include 'web-links.php'; ?>
</head>

<body>
    <div id="wrapper">
        <div class="w1">
            <?php include $filepath . '/navbar.php'; ?>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php if ($productDetails): ?>
                        <div class="product-details text-center">
                            <img class="product-image" src="<?php echo htmlspecialchars($productDetails['pro_image']); ?>" alt="<?php echo htmlspecialchars($productDetails['pro_name']); ?>">
                            <h1 class="product-title mt-4"><?php echo htmlspecialchars($productDetails['pro_name']); ?></h1>
                            <p class="product-price">$<?php echo htmlspecialchars($productDetails['selling_price']); ?></p>
                            <p class="mt-3">Stock: <?php echo htmlspecialchars($productDetails['stock']); ?></p>
                            <p class="mt-3">Description: <?php echo nl2br(htmlspecialchars($productDetails['pro_short_desc'])); ?></p>
                            <p class="mt-3">Specifications: <?php echo nl2br(htmlspecialchars($productDetails['pro_desc'])); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger text-center mt-5">
                            <p>Product not found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php include $filepath . '/footer-web.php'; ?>
    </div>

    
</body>

</html>