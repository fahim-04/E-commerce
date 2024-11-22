<header id="mt-header" class="style3">
	<!-- mt top bar start here -->
	<div class="mt-top-bar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 hidden-xs">
					<span class="tel active"> <i class="fa fa-phone" aria-hidden="true"></i> +1 (555) 333 22 11</span>
					<a class="tel" href="#"> <i class="fa fa-envelope-o" aria-hidden="true">info@snaptech.com</i> </a>
				</div>
				<div class="col-xs-12 col-sm-6 align-content-end">
					<!-- Empty section for alignment -->
				</div>
			</div>
		</div>
	</div>
	<!-- mt top bar end here -->

	<!-- mt bottom bar start here -->
	<div class="mt-bottom-bar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!-- mt logo start here -->
					<div class="mt-logo"><a href="index.php"><img src="images/snaptech3.png" style="width: 200px" alt="Snaptech"></a></div>

					<!-- mt icon list start here -->
					<ul class="mt-icon-list">
						<li class="hidden-lg hidden-md">
							<a href="#" class="bar-opener mobile-toggle">
								<span class="bar"></span>
								<span class="bar small"></span>
								<span class="bar"></span>
							</a>
						</li>
						<li><a href="#" class="icon-magnifier"></a></li>
						<li><a href="#" class="icon-handbag"></a></li>
						<li>
							<a href="#" id="openModalButton" class="icon-user"></a>
						</li> <!-- User icon triggers modal -->
					</ul>

					<!-- Navigation -->
					<nav id="nav">
						<ul>
							<li><a href="index.php">HOME </a></li>
							<li><a href="product-grid-view.php">PRODUCTS </a></li>
							<li><a href="about-us.php">About US </a></li>
							<li><a href="contact-us.php">Contact Us </a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->

</header>
<!-- Modal -->
<div id="userModal" class="modal">
	<div class="modal-content text-center">
		<span class="close-btn">&times;</span>
		<h1 class="text-center" style="color: #000; padding: 15px">Account</h1>
		<h5><?php echo $_SESSION['user_name'] ?? '' ?></h5>
		<p><?php echo $_SESSION['user_type'] ?? '' ?> </p>
		<a href="../backend/index.php" class="btn btn-primary">Login</a>
		<a href="logout.php" class="btn btn-danger">Logout</a>
	</div>
</div>
<!-- Styles for Modal -->
<style>
	/* Reset margins and paddings */
	body,
	header {
		margin: 0;
		padding: 0;
	}



	/* Modal styling */
	.modal {
		display: none;
		/* Hidden by default */
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
		/* Transparent background */
		z-index: 1000;
		/* Ensures it's above everything */
	}

	.modal-content {
		background-color: white;
		margin: 8% auto;
		/* Centered */
		padding: 20px;
		width: 40%;
		/* Adjust as needed */
		border-radius: 3px;
		position: relative;
		box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
	}

	/* Close button styling */
	.close-btn {
		position: absolute;
		top: 10px;
		right: 20px;
		font-size: 24px;
		cursor: pointer;
		color: #333;
	}
</style>

<!-- Script for Modal Functionality -->
<!-- <script>
	// Modal functionality
	const userModal = document.getElementById('userModal');
	const iconUser = document.querySelector('.icon-user');
	const closeBtn = document.querySelector('.close-btn');

	// Open the modal when user clicks the user icon
	iconUser.addEventListener('click', (e) => {
		e.preventDefault(); // Prevent default anchor behavior
		userModal.style.display = 'block';
	});

	// Close the modal when the close button is clicked
	closeBtn.addEventListener('click', () => {
		userModal.style.display = 'none';
	});

	// Close the modal when clicking outside of it
	window.addEventListener('click', (event) => {
		if (event.target === userModal) {
			userModal.style.display = 'none';
		}
	});
</script> -->