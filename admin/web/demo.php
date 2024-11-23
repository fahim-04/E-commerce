<?php
session_start();
include '../backend/connection.php'; // Database connection
include 'functions-web.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnapTech</title>
    <!-- Include the site stylesheet -->
    <?php
    $filepath = realpath(dirname(__FILE__));
    include $filepath . '/web-links.php';
    ?>
</head>

<body>
    <?php include $filepath . '/navbar.php'; ?>

    <!-- Main container of all the page elements -->
    <div id="wrapper">
        <!-- Slider section -->
        <div class="mt-mainslider4 add">
            <div class="container">
                <div class="row">
                    <!-- banner slider start here -->
                    <div class="banner-slider">
                        <!-- holder start here -->
                        <div class="holder">
                            <div class="img">
                                <img src="images/sliders/pixel-9-pro.png" alt="image description">
                            </div>
                            <div class="txt">
                                <span class="sub-title">Google Pixel 9 Pro</span>
                                <h1>Camera 50MP, 5x Zoom, 8K Video</h1>
                                <h2>6.3" OLED, 120Hz Display.</h2>
                                <h3>Gorilla Glass & IP68.</h3>
                                <span class="price">Starts from $ 984<sub>.99</sub></span>
                            </div>
                        </div><!-- holder end here -->
                        <!-- holder start here -->
                        <div class="holder ">
                            <div class="img">
                                <img src="images/sliders/S24ultra.png" alt="image description">
                            </div>
                            <div class="txt">
                                <span class="sub-title">Samsung Galaxy S24 Ultra</span>
                                <h1>Snapdragon 8 <br> Gen 3</h1>
                                <h2>200MP Pro Quad Camera</h2>
                                <h3>6.8" Dynamic AMOLED Display</h3>
                                <span class="price">Starts from $ 789<sub>.94</sub></span>
                            </div>
                        </div><!-- holder end here -->
                        <!-- holder start here -->
                        <div class="holder">
                            <div class="img">
                                <img src="images/sliders/iphone16pro.png" alt="image description">
                            </div>
                            <div class="txt">
                                <span class="sub-title">Apple iPhone 16 Pro Max</span>
                                <h1>A18 Pro Chip </h1>
                                <h2>5x Optical Zoom</h2>
                                <h3>6.9" Super Retina XDR Display</h3>
                                <span class="price">Starts from $ 1,199<sub>.99</sub></span>
                            </div>
                        </div><!-- holder end here -->
                    </div><!-- banner slider end here -->
                </div>
            </div>
        </div>
        <!-- Slider end -->

        <divs class="w1">
            <!-- Main container -->
            <div class="container mt-5">
                <h2 class="heading pb-3">Smart Phones</h2>

                <?php
                // Fetch products using the updated function
                $categoryId = 1; // Example category
                $products = getSPhones($conn, $categoryId);

                if (isset($products['error'])) {
                    echo "<p>Error: " . $products['error'] . "</p>";
                } elseif (!empty($products)) {
                ?>
                    <!-- Bootstrap Carousel -->
                    <div id="productSlider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $activeClass = 'active'; // First slide needs the active class
                            foreach ($products as $product) {
                            ?>
                                <div class="carousel-item <?php echo $activeClass; ?>">
                                    <div class="card text-center" style="width: 250px; margin: auto;">
                                        <img src="<?php echo !empty($product['pro_image']) ? htmlspecialchars($product['pro_image']) : 'images/placeholder.jpg'; ?>"
                                            class="card-img-top"
                                            alt="<?php echo htmlspecialchars($product['pro_name']); ?>"
                                            style="width: 100%; height: auto;">
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo htmlspecialchars($product['pro_name']); ?></h4>
                                            <a href="<?php echo htmlspecialchars($product['slug_url']); ?>" class="btn btn-primary">See more...</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $activeClass = ''; // Reset after first item
                            }
                            ?>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#productSlider" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productSlider" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                <?php
                } else {
                    echo "<p>No products found.</p>";
                }
                ?>
            </div>
        </divs>





        <!-- Footer -->
        <?php include $filepath . '/footer-web.php'; ?>

        <!-- Include scripts -->