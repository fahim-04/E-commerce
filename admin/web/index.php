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
							<div class="banner-frame toppadding-zero">
								<!-- banner 5 white start here -->
								<div class="banner-5 white wow fadeInLeft" data-wow-delay="0.6s">
									<img src="images/banner/new arival.jpg" alt="new arival">
									<div class="holder">
										<div class="texts">
											<!-- <strong class="title">FURNITURE DESIGNS IDEAS</strong>
											<h3><strong>New</strong> Collection</h3>
											<p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
											<span class="price-add">$ 79.00</span> -->
										</div>
									</div>
								</div><!-- banner 5 white end here -->
								<!-- banner 6 white start here -->
								<div class="banner-5 white wow fadeInRight" data-wow-delay="0.6s">
									<img src="images/banner/Pixel-9-pro.jpg" alt="image description">
									<div class="holder">
										<!-- add shopnow button here -->
										<!-- <strong class="sub-title">SOFAS &amp; ARMCHAIRS</strong>
										<h3>3 Seater Leather Sofa</h3>
										<span class="offer">
											<span class="price-less">$ 659.00</span>
											<span class="prices">$ 499.00</span>
										</span>
										<a href="product-detail.html" class="btn-shop">
											<span>shop now</span>
											<i class="fa fa-angle-right"></i>
										</a> -->
									</div>
								</div><!-- banner 5 white end here -->

							</div>
						</div>
						<!-- banner frame end here -->

						<!-- banner box third end here -->
						<!-- slider 7 start here -->
						<div class="slider-7 wow fadeInRight" data-wow-delay="0.6s">
							<!-- slider start here -->
							<div class="slider banner-slider">
								<!-- sliderstart here -->
								<div class="s-holder">
									<img src="images/sliders/img10.jpg" alt="image description">
									<div class="s-box">
										<!-- <strong class="s-title">FURNITURE DESIGNS IDEAS</strong>
												<span class="heading">Upholstered fabric</span>
												<span class="heading add">Counter stool</span>
												<div class="s-txt">
													<p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
												</div> -->
									</div>
								</div><!-- slider end here -->
								<!-- slider start here -->
								<div class="s-holder">
									<img src="images/sliders/img08.jpg" alt="image description">
									<div class="s-box">
										<strong class="s-title">FURNITURE DESIGNS IDEAS</strong>
										<span class="heading">Upholstered fabric</span>
										<span class="heading add">Counter stool</span>
										<div class="s-txt">
											<p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
										</div>
									</div>
								</div><!-- slider end here -->
								<!-- slider start here -->
								<div class="s-holder">
									<img src="images/sliders/img09.jpg" alt="image description">
									<div class="s-box">
										<strong class="s-title">KITCHEN ACCESSORIES</strong>
										<span class="heading">Wooden chopping board</span>
										<span class="heading add">Chopping Boards</span>
										<div class="s-txt">
											<p>Remo is a cutting board in solid oak wood, with an explicit reference to the oars of the boats.</p>
										</div>
									</div>
								</div><!-- holder end here -->
								<!-- holder star here -->
								<div class="s-holder">
									<img src="images/sliders/img07.jpg" alt="image description">
									<div class="s-box">
										<strong class="s-title">FURNITURE DESIGNS IDEAS</strong>
										<span class="heading add">NEW</span>
										<span class="heading add">COLLECTION</span>
										<div class="s-txt">
											<p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
										</div>
										<a href="product-detail.html" class="s-shop">SHOP NOW</a>
									</div>
								</div><!-- holder end here -->
							</div>
						</div><!-- slider 7 end here -->
					</div><!-- banner frame end here -->
					<!-- mt producttabs style2 start here -->
					<div class="mt-producttabs style2 wow fadeInUp" data-wow-delay="0.6s">
						<!-- producttabs start here -->
						<ul class="producttabs">
							<li><a href="#tab1" class="active">FEATURED</a></li>
							<li><a href="#tab2">LATEST</a></li>
							<li><a href="#tab3">BEST SELLER</a></li>
						</ul>
						<!-- producttabs end here -->
						<div class="tab-content">
							<div id="tab1">
								<!-- tabs slider start here -->
								<div class="tabs-sliderlg">
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img22.jpg" alt="image description"></a>
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
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img23.jpg" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img24.jpg" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
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
												<strong class="title"><a href="product-detail.html">Chair with armrests</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img22.jpg" alt="image description"></a>
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
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img23.jpg" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
								</div>
								<!-- tabs slider end here -->
							</div>
							<div id="tab2">
								<!-- tabs slider start here -->
								<div class="tabs-sliderlg">
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img23.jpg" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img22.jpg" alt="image description"></a>
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
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img24.jpg" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
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
												<strong class="title"><a href="product-detail.html">Chair with armrests</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img22.jpg" alt="image description"></a>
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
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img23.jpg" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
								</div>
								<!-- tabs slider end here -->
							</div>
							<div id="tab3">
								<!-- tabs slider start here -->
								<div class="tabs-sliderlg">
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img24.jpg" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
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
												<strong class="title"><a href="product-detail.html">Chair with armrests</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img22.jpg" alt="image description"></a>
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
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img23.jpg" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img22.jpg" alt="image description"></a>
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
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="images/products/img23.jpg" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
								</div>
								<!-- tabs slider end here -->
							</div>
						</div>
					</div><!-- mt producttabs end here -->
					<!-- banner frame start here -->


					<!-- mt producttabs style3 start here -->
					<div class="mt-producttabs style3 wow fadeInUp" data-wow-delay="0.6s">
						<h2 class="heading">BEST SELLER</h2>
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
</body>

<!-- Mirrored from htmlbeans.com/html/schon/homepage2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Apr 2023 13:56:02 GMT -->

</html>