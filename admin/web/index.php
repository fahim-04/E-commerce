<?
session_start();
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
			<!-- mt header style3 start here -->
			<!-- mt header end here -->
			<!-- mt search popup start here -->
			<!-- mt search popup end here -->
			<!-- mt main start here -->
			<main id="mt-main">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<!-- banner frame start here -->
							<div class="banner-frame toppadding-zero promo-cc row">
								<!-- banner 5 white start here -->
								<div class="banner-5 col-md-6 white wow fadeInLeft promo-1 img-fluid" data-wow-delay="0.6s">
									<img src="images/banner/new arival.jpg" alt="new arival" class="img-responsive">
									<div class="holder">
										<div class="texts">
											<!-- add link -->
										</div>
									</div>
								</div>
								<!-- banner 5 white end here -->

								<!-- banner 6 white start here -->
								<div class="banner-5 col-md-6 white wow fadeInRight promo-2 img-fluid" data-wow-delay="0.6s">
									<img src="images/banner/Pixel-9-pro.jpg" alt="image description" class="img-responsive">
									<div class="holder">
										<!-- add link -->
									</div>
								</div>
								<!-- banner 6 white end here -->
							</div>
							<!-- banner frame end here -->
						</div>

						<!-- banner frame end here -->

						<!-- banner box third end here -->
						<!-- slider 7 start here -->
						<!-- slider 7 end here -->
					</div><!-- banner frame end here -->
					<!-- mt producttabs style2 start here -->
					<div class="mt-producttabs style3 wow fadeInUp" data-wow-delay="0.6s">
						<h2 class="heading">Smart Phone</h2>
						<!-- tabs slider start here -->
						<div class="tabs-slider">
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img01.jpg" alt="image description"></a>
												<span class="caption">
													<span class="new">new</span>
												</span>
												<ul class="mt-stars">
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Puff Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img02.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img03.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img04.jpg" alt="image description"></a>
												<span class="caption">
													<span class="off">15% Off</span>
													<span class="new">new</span>
												</span>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img05.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img03.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
						</div>
						<!-- tabs slider end here -->
					</div><!-- mt producttabs end here -->
					<!-- banner frame start here -->


					<!-- mt producttabs style3 start here -->
					<div class="mt-producttabs style3 wow fadeInUp" data-wow-delay="0.6s">
						<h2 class="heading">Tabs</h2>
						<!-- tabs slider start here -->
						<div class="tabs-slider">
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img01.jpg" alt="image description"></a>
												<span class="caption">
													<span class="new">new</span>
												</span>
												<ul class="mt-stars">
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Puff Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img02.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img03.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img04.jpg" alt="image description"></a>
												<span class="caption">
													<span class="off">15% Off</span>
													<span class="new">new</span>
												</span>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img05.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1 start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="images/products/img03.jpg" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
									</div>
								</div><!-- mt product1 end here -->
							</div>
							<!-- slide end here -->
						</div>
						<!-- tabs slider end here -->
					</div><!-- mt producttabs style3 end here -->
					<!-- mt patners start here -->

				</div>
		</div>
	</div>
	</main>
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
