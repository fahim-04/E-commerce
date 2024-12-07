	<footer id="mt-footer" class="style2 wow fadeInUp" data-wow-delay="0.6s">
		<!-- F Promo Box of the Page -->
		<aside class="f-promo-box dark">
			<div class="container divider">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
						<!-- F Widget Item of the Page -->
						<div class="f-widget-item">
							<span class="widget-icon"><i class=" fa fa-solid fa-truck"></i></span>
							<div class="txt-holder">
								<h1 class="f-promo-box-heading">FREE SHIPPING</h1>
								<p>Free shipping on all orders</p>
							</div>
						</div>
						<!-- F Widget Item of the Page end -->
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
						<!-- F Widget Item of the Page -->
						<div class="f-widget-item">
							<span class="widget-icon"><i class="fa fa-life-ring"></i></span>
							<div class="txt-holder">
								<h1 class="f-promo-box-heading">SUPPORT 24/7</h1>
								<p>We support 24 hours a day</p>
							</div>
						</div>
						<!-- F Widget Item of the Page -->
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
						<!-- F Widget Item of the Page -->
						<div class="f-widget-item">
							<span class="widget-icon"><i class="fa fa-dropbox"></i></span>
							<div class="txt-holder">
								<h1 class="f-promo-box-heading">GIFT CARDS</h1>
								<p>Give perfect gift</p>
							</div>
						</div>
						<!-- F Widget Item of the Page -->
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<!-- F Widget Item of the Page -->
						<div class="f-widget-item">
							<span class="widget-icon"><i class="fa fa-money"></i></span>
							<div class="txt-holder">
								<h1 class="f-promo-box-heading">PAYMENT 100% SECURE</h1>
								<p>Payment 100% secure</p>
							</div>
						</div>
						<!-- F Widget Item of the Page -->
					</div>
				</div>
			</div>
		</aside>
		<!-- F Promo Box of the Page end -->
		<!-- Footer Holder of the Page -->
		<div class="footer-holder dark">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-5 col-md-4 mt-paddingbottomxs">
						<!-- F Widget About of the Page -->
						<div class="f-widget-about">
							<div class="logo">
								<img src="images/snaptech3.png" alt="" srcset="">
							</div>
							<p>Exercitation ullamco laboris nisi ut aliquip ex<br> commodo consequat. Duis aute irure</p>
							<ul class="list-unstyled address-list">
								<li><i class="fa fa-map-marker"></i>
									<address>Connaugt Road Central Suite 18B, 148 <br>New Yankee</address>
								</li>
								<li><i class="fa fa-phone"></i><a href="tel:15553332211">+1 (555) 333 22 11</a></li>
								<li><i class="fa fa-envelope-o"></i><a href="info@snaptech.com">info@snaptech.com</a></li>
							</ul>
						</div>
						<!-- F Widget About of the Page -->
					</div>
					<nav class="col-xs-12 col-sm-7 col-md-5 mt-paddingbottomxs">
						<!-- Footer Nav of the Page -->
						<div class="nav-widget-1">

						</div>
						<!-- Footer Nav of the Page end -->
						<!-- Footer Nav of the Page -->
						<div class="nav-widget-1">

						</div>
						<!-- Footer Nav of the Page end -->
						<!-- Footer Nav of the Page -->
						<div class="nav-widget-1">

						</div>
						<!-- Footer Nav of the Page end -->
					</nav>
					<div class="col-xs-12 col-md-3 text-right hidden-sm">
						<!-- F Widget Newsletter of the Page -->
						<div class="f-widget-newsletter">

							<div class="holder">

							</div>
							<!-- F Widget Newsletter of the Page end -->
							<h4 class="f-widget-heading follow">Follow Us</h4>
							<!-- Social Network of the Page -->
							<ul class="list-unstyled social-network social-icon">
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
							</ul>
							<!-- Social Network of the Page end -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Holder of the Page end -->
		<!-- Footer Area of the Page -->
		<div class="footer-area">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<p>© <a href="#">Snaptech.</a> - All rights Reserved</p>
					</div>
					<div class="col-xs-12 col-sm-6 text-right">
						<div class="bank-card">
							<img src="images/bank-card.png" alt="bank-card">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Area of the Page end -->
	</footer>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Slick Carousel JS -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

	<script src="js/jquery.js"></script>
	<!-- include jQuery -->
	<script src="js/plugins.js"></script>
	<!-- include jQuery -->
	<script src="js/jquery.main.js"></script>
	<script src="js/main.js"></script>

	<!-- modal for account -->
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