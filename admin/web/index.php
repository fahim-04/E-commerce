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
	<link rel="shortcut icon" href="images/ST.png" type="image/x-icon">
	<!-- include the site stylesheet -->
	<?php $filepath = realpath(dirname(__FILE__));
	include $filepath . '/web-links.php'; ?>
	<style>
		.product-title {
			font-size: 16px;
		}

		.product-title:hover {
			color: #d9534f;
			/* Change color on hover */
		}

		.product-price {
			margin-top: 10px;
			font-size: 14px;
			color: #000;
		}
	</style>
</head>

<body>
	<?php include $filepath . '/navbar.php'; ?>

	<div id="wrapper">
		<!-- Page Loader -->
		<div id="pre-loader" class="loader-container">
			<div class="loader">
				<img src="images/svg/rings.svg" alt="loader">
			</div>
		</div>
		<!-- slider start -->
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

		<!-- slider end -->
		<!-- W1 start here -->
		<!-- <div class="w1"> -->
		<!-- Product Slider Section -->
		<div class="container mt-5 wow fadeInUp" data-wow-delay="0.4s">
			<!-- Smart Phones Section -->
			<div class="row">
				<div class="d-flex justify-content-between align-items-center mb-3">
					<h2 class="prod-heading col-6 pl-2">Phones</h2>
					<a href="product.php?search=phone" class="btn  col-6" style="color: #d9534f; text-decoration: underline;" rel="noopener noreferrer">See All</a>
				</div>
				<div class="slider-container">
					<?php
					$categoryId = 1; // Smart Phones category ID
					$products = getSPhones($conn, $categoryId);
					if (!empty($products)) {
						foreach ($products as $row) {
					?>
							<div class="product-card">
								<img style="width: 80%;" src="<?php echo !empty($row['pro_image']) ? htmlspecialchars($row['pro_image']) : 'images/placeholder.jpg'; ?>"
									alt="<?php echo htmlspecialchars($row['pro_name']); ?>" class="product-image">
								<a href="product-details.php?id=<?php echo $row['pro_id']; ?>" class="product-title">
									<?php echo $row['pro_name']; ?>
									<h4 href="<?php echo htmlspecialchars($row['selling_price']); ?>" class="product-price">
										$<?php echo htmlspecialchars($row['selling_price']); ?>
									</h4>
								</a>

							</div>
					<?php
						}
					} else {
						echo "<p>No products found.</p>";
					}
					?>
				</div>
			</div>

			<!-- Tabs Section -->
			<div class="row mt-5 wow fadeInUp" data-wow-delay="0.4s">
				<div class=" d-flex justify-content-between align-items-center mb-3">
					<h2 class="prod-heading col-6 pl-2">Tabs</h2>
					<a href="product.php?search=tab+pad" class="btn  col-6" style="color: #d9534f; text-decoration: underline;" rel="noopener noreferrer">See All</a>
				</div>
				<div class="slider-container">
					<?php
					$categoryId = 14747; // Tabs category ID
					$products = getTabs($conn, $categoryId);
					if (!empty($products)) {
						foreach ($products as $row) {
					?>
							<div class="product-card">
								<img style="width: 80%;" src="<?php echo !empty($row['pro_image']) ? htmlspecialchars($row['pro_image']) : 'images/placeholder.jpg'; ?>"
									alt="<?php echo htmlspecialchars($row['pro_name']); ?>" class="product-image">

								<a href="product-details.php?id=<?php echo $row['pro_id']; ?>" class="product-title">
									<?php echo $row['pro_name']; ?>
									<h4 href="<?php echo htmlspecialchars($row['selling_price']); ?>" class="product-price">
										$<?php echo htmlspecialchars($row['selling_price']); ?>
									</h4>
								</a>
							</div>
					<?php
						}
					} else {
						echo "<p>No products found.</p>";
					}
					?>
				</div>
			</div>

			<!-- Smart Watches Section -->
			<div class="row mt-5 wow fadeInUp" data-wow-delay="0.4s">
				<div class="d-flex justify-content-between align-items-center mb-3">
					<h2 class="prod-heading col-6 pl-2">Watches</h2>
					<a href="product.php?search=watch" class="btn  col-6" style="color: #d9534f; text-decoration: underline; text-align: end;" rel="noopener noreferrer">See All</a>
				</div>
				<div class="slider-container">
					<?php
					$categoryId = 74040; // Tabs category ID
					$products = getTabs($conn, $categoryId);
					if (!empty($products)) {
						foreach ($products as $row) {
					?>
							<div class="product-card">
								<img style="width: 80%;" src="<?php echo !empty($row['pro_image']) ? htmlspecialchars($row['pro_image']) : 'images/placeholder.jpg'; ?>"
									alt="<?php echo htmlspecialchars($row['pro_name']); ?>" class="product-image">

								<a href="product-details.php?pro_id=<?php echo $row['pro_id']; ?>" class="product-title">
									<?php echo $row['pro_name']; ?>
									<h4 href="<?php echo htmlspecialchars($row['selling_price']); ?>" class="product-price">
										$<?php echo htmlspecialchars($row['selling_price']); ?>
									</h4>
								</a>
							</div>
					<?php
						}
					} else {
						echo "<p>No products found.</p>";
					}
					?>
				</div>
			</div>
		</div>


	</div>
	<!-- </div> -->


	<!-- mt header style3 start here -->
	<!-- mt header end here -->
	<!-- mt search popup start here -->
	<!-- mt search popup end here -->
	<!-- mt main start here -->

	<!-- footer of the Page -->
	<?php include $filepath . '/footer-web.php'; ?>
	<!-- footer of the Page end -->
	<!-- </div> -->
	<!-- W1 end here -->
	<span id="back-top" class="fa fa-arrow-up"></span>
	<!-- </div> -->
	<!-- Popup Holder of the Page end -->
	<!-- include jQuery -->
	<script src="js/jquery.js"></script>
	<!-- include jQuery -->
	<script src="js/plugins.js"></script>
	<!-- include jQuery -->
	<script src="js/jquery.main.js"></script>
	<script>
		// Modal elements
		const modal = document.getElementById('userModal');
		const openModalButton = document.getElementById('openModalButton');
		const closeButton = document.querySelector('.close-btn');

		// Open the modal
		openModalButton.onclick = () => {
			modal.style.display = 'block';
		};

		// Close the modal when the close button is clicked
		closeButton.onclick = () => {
			modal.style.display = 'none';
		};

		// Close the modal when clicking outside of it
		window.onclick = (event) => {
			if (event.target === modal) {
				modal.style.display = 'none';
			}
		};
	</script>

	<script>
		$(document).ready(function() {
			$('.slider-container').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: false,
				arrows: false,
				dots: false,
				autoplay: false, // Enable autoplay

				responsive: [{
						breakpoint: 1199,
						settings: {
							slidesToShow: 3
						}
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2
						}
					},
					{
						breakpoint: 576,
						settings: {
							slidesToShow: 1
						}
					}
				]
			});
		});
	</script>