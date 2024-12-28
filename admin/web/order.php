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
$sql = "SELECT pro_id, pro_image, pro_name, selling_price FROM ec_product WHERE pro_id = :pro_id AND status = 1";

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

// Process the order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = trim($_POST['customer_name']);
    $customer_email = trim($_POST['customer_email']);
    $address = trim($_POST['address']);
    $m_number = trim($_POST['m_number']);
    $quantity = intval($_POST['quantity']);

    if (empty($customer_name) || empty($customer_email) || empty($address) || empty($m_number) || $quantity <= 0) {
        $error_message = "All fields are required, and quantity must be greater than 0.";
    } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } elseif (!preg_match('/^\d{10}$/', $m_number)) {
        $error_message = "Please enter a valid 10-digit mobile number.";
    } else {
        // Insert order into database
        $order_sql = "INSERT INTO ec_orders (order_id, item_name, item_id, address, customer_name, customer_email, quantity, total_price, m_number, ordered_on) 
              VALUES (:order_id, :item_name, :item_id, :address, :customer_name, :customer_email, :quantity, :total_price, :m_number, :ordered_on)";

        try {
            $order_stmt = $conn->prepare($order_sql);
            $total_price = $quantity * $product['selling_price'];

            $order_id = rand(1000, 10000); // Generate a random order ID
            $ordered_on = date('d-m-Y'); // Use YYYY-MM-DD format for the ordered_on field

            $order_stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $order_stmt->bindParam(':item_name', $product['pro_name'], PDO::PARAM_STR);
            $order_stmt->bindParam(':item_id', $pro_id, PDO::PARAM_INT);
            $order_stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $order_stmt->bindParam(':customer_name', $customer_name, PDO::PARAM_STR);
            $order_stmt->bindParam(':customer_email', $customer_email, PDO::PARAM_STR);
            $order_stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $order_stmt->bindParam(':total_price', $total_price, PDO::PARAM_STR);
            $order_stmt->bindParam(':m_number', $m_number, PDO::PARAM_STR);
            $order_stmt->bindParam(':ordered_on', $ordered_on, PDO::PARAM_STR);

            $order_stmt->execute();

            $success_message = "Order placed successfully! Your Order ID is $order_id.";
        } catch (PDOException $e) {
            $error_message = "Failed to place order: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Product</title>
    <?php include 'web-links.php'; ?>
    <style>
        .order-form {

            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;

        }

        .product-details {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-image {
            max-width: 30%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            width: fit-content;
        }

        .message.error {
            color: #e3342f;
        }

        .message.success {
            color: #38c172;
        }

        .prod-price {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #333;
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
    <div class="order-form">
        <div class="product-details">

            <h2><?php echo htmlspecialchars($product['pro_name']); ?></h2>
            <img src="<?php echo htmlspecialchars($product['pro_image']); ?>" alt="<?php echo htmlspecialchars($product['pro_name']); ?>" class="product-image">
            <p class="prod-price">Price: $<?php echo number_format($product['selling_price'], 2); ?></p>


        </div>

        <?php if (!empty($error_message)): ?>
            <div class="message error"> <?php echo $error_message; ?> </div>
        <?php elseif (!empty($success_message)): ?>
            <div class="message success"> <?php echo $success_message; ?> </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="customer_name">Your Name</label>
                <input type="text" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="customer_email">Your Email</label>
                <input type="email" id="customer_email" name="customer_email" required>
            </div>
            <div class="form-group">
                <label for="address">Delivery Address</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="m_number">Mobile Number</label>
                <input type="text" id="m_number" name="m_number" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required>
                Total Price: $<span id="total-price"><?php echo number_format($product['selling_price'], 2); ?></span>
                <input type="hidden" id="unit-price" value="<?php echo number_format($product['selling_price'], 2); ?>">
            </div>
            <button type="submit" class="btn-primary">Place Order</button>
        </form>
    </div>

    <?php include $filepath . '/footer-web.php'; ?>
    <span id="back-top" class="fa fa-arrow-up"></span>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const totalPriceElement = document.getElementById('total-price');
            const unitPrice = parseFloat(document.getElementById('unit-price').value);

            quantityInput.addEventListener('input', function() {
                const quantity = parseInt(quantityInput.value) || 1; // Default to 1 if empty or invalid
                const totalPrice = (unitPrice * quantity).toFixed(2);
                totalPriceElement.textContent = totalPrice;
            });
        });
    </script>
    <!-- Include JS Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.main.js"></script>
</body>

</html>