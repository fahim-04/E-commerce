<?php
session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php';

// Get the product ID from the URL
$pro_id = isset($_GET['pro_id']) ? intval($_GET['pro_id']) : 0;

// Validate product ID
if ($pro_id === 0) {
    die("<h2 class='text-danger'> Product not found. Please go back and select a valid product.</h2>");
}

// Query the database to fetch product details
$sql = "SELECT pro_id, pro_image, pro_name, pro_desc, pro_short_desc, meta_key, meta_title, meta_desc, selling_price, stock, slug_url 
        FROM ec_product 
        WHERE pro_id = :pro_id AND status = 1";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
    $stmt->execute();

    // Check if the product exists
    if ($stmt->rowCount() > 0) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("<h2>No product found with ID $pro_id. Please try another product.</h2>");
    }
} catch (PDOException $e) {
    die("<h2>Database query failed: " . htmlspecialchars($e->getMessage()) . "</h2>");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($product['meta_desc'] ?? ''); ?>">
    <meta name="title" content="<?php echo htmlspecialchars($product['meta_title'] ?? 'Product Details'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($product['meta_key'] ?? ''); ?>">
    <title classs="prod-name back-top"><?php echo htmlspecialchars($product['pro_name'] ?? 'Product Details'); ?></title>
    <link rel="shortcut icon" href="images/ST.png" type="image/x-icon">

    <style>
        .product-details {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
        }

        .product-image {
            max-width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .pro_desc {
            margin-top: 40px;
            line-height: 1.6;
        }

        .pro-name {
            /* font-size: 32px; */
            font-weight: bold;
            color: #333333;
            margin-bottom: 50px;
        }

        .pro_short_desc {
            font-size: 16px;
            color: #666666;
            line-height: 1.6;
        }

        .prod-price {
            font-size: 16px;
            color: #28a745;
            font-weight: bold;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1a73e8;
        }

        .pro-desc {
            padding-top: 60px;
        }

        .pro-desc h2 {
            font-size: 24px;

            margin-bottom: 20px;
        }

        .pro-desc p {
            font-size: 16px;
            padding: 0 25px;
            margin-bottom: 20px;
        }

        .imgSdesc {
            margin-bottom: 30px;
        }

        .meta-key {
            margin-top: 50px;
            font-style: italic;
            color: #666666;
        }

        .bgc {
            background-color: #f8f9fa;
            padding: 20px 0;
            border-radius: 10px;
        }
    </style>
    <?php include 'web-links.php'; ?>
</head>

<body>
    <div id="wrapper">
        <div class="w1">
            <?php include $filepath . '/navbar.php'; ?>
        </div>

        <div class="container mt-5">
            <div class="product-details ">
                <div class="bgc">
                    <div class="text-center mb-5">
                        <h1 class="pro-name"><?php echo htmlspecialchars($product['pro_name']); ?></h1>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center imgSdesc">
                            <img src="<?php echo htmlspecialchars($product['pro_image']); ?>"
                                alt="<?php echo htmlspecialchars($product['slug_url']); ?>"
                                class="product-image">
                        </div>
                        <div class="col-md-6">
                            <p class="mt-3 pro_short_desc"><?php echo htmlspecialchars($product['pro_short_desc']); ?></p>
                            <h4 class="prod-price">$<?php echo number_format($product['selling_price'], 2); ?></h4>
                            <p class="text-muted">Stock: <?php echo htmlspecialchars($product['stock']); ?></p>
                            <a href="order.php?pro_id=<?php echo $product['pro_id']; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                </div>
                <div class="pro-desc ">
                    <hr>
                    <h2>Specifications:</h2>
                    <p><?php echo nl2br($product['pro_desc']); ?></p>
                </div>
                <!-- <p class="meta-key mt-4"><strong>Keywords:</strong> <i><?php echo htmlspecialchars($product['meta_key']); ?></i></p> -->
            </div>
        </div>

    </div>

    <?php include $filepath . '/footer-web.php'; ?>
    <span id="back-top" class="fa fa-arrow-up"></span>
    </div>

    <!-- Include JS Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.main.js"></script>
</body>

</html>