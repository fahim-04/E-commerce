<?php

session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php';

// Fetch products from the database
$products = getAllProducts($conn); // Assuming this function is defined in functions-web.php
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snaptech. | Product</title>
    <?php $filepath = realpath(dirname(__FILE__));
    include $filepath . '/web-links.php'; ?>
    <style>
        .mt-product-list {
            margin-top: 30px;
        }

        .product-image {
            width: 76%;
        }

        .product-title {
            font-size: 18px;
        }

        .product-title:hover {
            color: #d9534f;
            /* Change color on hover */
        }

        .product-price {
            margin-top: 10px;
            font-size: 16px;
            color: #6b6b6b;
        }
    </style>
</head>

<body>
    <?php include $filepath . '/navbar.php'; ?>
    <div id="wrapper">

    <div id="pre-loader" class="loader-container">
        <div class="loader">
            <img src="images/svg/rings.svg" alt="loader">
        </div>
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

    <section class="product-list">
        <div class="container">
            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="product-card">
                                <img class="product-image" src="<?php echo htmlspecialchars($product['pro_image']); ?>" alt="<?php echo htmlspecialchars($product['pro_name']); ?>" class="product-image">
                                <h4 class="product-price">$<?php echo number_format($product['selling_price'], 2); ?></h4>
                                <a href="product-details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="product-title">
                                    <?php echo htmlspecialchars($product['pro_name']); ?>
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>