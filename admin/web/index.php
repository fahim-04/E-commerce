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
	<!-- include the site stylesheet -->
	<?php $filepath = realpath(dirname(__FILE__));
	include $filepath . '/web-links.php'; ?>
</head>

<body>
	<?php include $filepath . '/navbar.php'; ?>
	<!-- main container of all the page elements -->
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
		<div class="w1">
			<!-- Main container -->
			<div class="container mt-5 prod-show">
				<!-- for smart phones -->
				<div class="row">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h2 class="heading color-dark col-6">Smart Phones</h2>
						<a href="products.php" class="btn btn-primary col-6" rel="noopener noreferrer">See All</a>
					</div>

					<div class="">
						<?php
						// Fetch products using the updated function
						$categoryId = 1; // Replace with a valid category ID
						$products = getSPhones($conn, $categoryId);

						if (isset($products['error'])) {
							echo "<p class='text-danger'>Error: " . $products['error'] . "</p>";
						} elseif (!empty($products)) {
							foreach ($products as $row) {
						?>
								<div class="col-6 d-flex justify-content-center mb-4">
									<div class="card col-6 col-lg-3 col-xl-3  col-md-6  col-sm-6" style="max-width: 200px; padding: 20px;">
										<!-- Product Image -->
										<img src="<?php echo !empty($row['pro_image']) ? htmlspecialchars($row['pro_image']) : 'images/placeholder.jpg'; ?>"
											class="card-img-top img-fluid"
											alt="<?php echo htmlspecialchars($row['pro_name']); ?>">

										<!-- Product Title -->
										<div class="card-body text-center">
											<a href="<?php echo htmlspecialchars($row['slug_url']); ?>"
												class="card-title text-truncate d-block"
												style="font-size: 16px;">
												<?php echo htmlspecialchars($row['pro_name']); ?>
											</a>
										</div>
									</div>
								</div>
						<?php
							}
						} else {
							echo "<p>No products found.</p>";
						}
						?>
					</div>
				</div>
				<!-- smart phones end -->

				<!-- for tablets -->

				<div class="row">

					<div class="d-flex justify-content-between align-items-center mb-3">
						
							<h2 class="heading  col-6">Tabs</h2>
							<a href="products.php" class="btn btn-primary col-6" rel="noopener noreferrer">See All</a>
				
					</div>

					<div class="">
						<?php
						// Fetch products using the updated function
						$categoryId = 14747; // Replace with a valid category ID
						$products = getTabs($conn, $categoryId);

						if (isset($products['error'])) {
							echo "<p class='text-danger'>Error: " . $products['error'] . "</p>";
						} elseif (!empty($products)) {
							foreach ($products as $row) {
						?>
								<div class="col-6 d-flex justify-content-center mb-4">
									<div class="card col-6 col-lg-3 col-xl-3  col-md-6  col-sm-6" style="max-width: 200px; padding: 20px;">
										<!-- Product Image -->
										<img src="<?php echo !empty($row['pro_image']) ? htmlspecialchars($row['pro_image']) : 'images/placeholder.jpg'; ?>"
											class="card-img-top img-fluid"
											alt="<?php echo htmlspecialchars($row['pro_name']); ?>">

										<!-- Product Title -->
										<div class="card-body text-center">
											<a href="<?php echo htmlspecialchars($row['slug_url']); ?>"
												class="card-title text-truncate d-block"
												style="font-size: 16px;">
												<?php echo htmlspecialchars($row['pro_name']); ?>
											</a>
										</div>
									</div>
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