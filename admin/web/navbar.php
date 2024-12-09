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

<header id="mt-header" class="style3">
	<!-- mt top bar start here -->
	<div class="mt-top-bar">
		<div class="container">
			<div class="">
				<div class="col-xs-12 col-sm-6 hidden-xs">
					<span class="tel active"> <i class="fa fa-phone" aria-hidden="true"></i> +1 (555) 333 22 11</span>
					<a class="tel" href="#"> <i class="fa fa-envelope-o" aria-hidden="true">info@snaptech.com</i> </a>
				</div>
				<div class="col-xs-12 col-sm-6 text-right">

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

					<div class="mt-logo"><a href="index.php"><img src="images/snaptech3.png" style="width: 200px" alt="Snaptech"></a></div>

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
					<nav id="nav">
						<ul>
							<li><a href="index.php">HOME </a></li>
							<li><a href="products.php">PRODUCTS </a></li>
							<li><a href="about-us.php">About US</a></li>
							<li><a href="contact-us.php">Contact Us</a></li>
						</ul>
					</nav>
					<!-- mt icon list end here -->
				</div>
			</div>
		</div>
	</div>
	<div class="mt-search-popup">
		<div class="mt-holder">
			<a href="#" class="search-close"><span></span><span></span></a>
			<div class="mt-frame">
				<form action="#">
					<fieldset>
						<input type="text" placeholder="Search...">

						<button class="icon-magnifier" type="submit"></button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<!-- mt bottom bar end here -->
	<span class="mt-side-over"></span>
</header>
<!-- Modal -->
<?php
// Function to mask email
function maskEmail($email)
{
	// Split the email into parts
	$atPos = strpos($email, '@');
	if ($atPos === false) return $email; // Invalid email, return as is

	$namePart = substr($email, 0, $atPos); // Before the @
	$domainPart = substr($email, $atPos); // After the @

	if (strlen($namePart) > 3) {
		// Replace all but the first 3 characters with asterisks
		$maskedName = substr($namePart, 0, 3) . str_repeat('*', strlen($namePart) - 3);
	} else {
		// If the name part is too short, show it as is
		$maskedName = $namePart;
	}

	return $maskedName . $domainPart; // Combine masked name and domain
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_name']) && isset($_SESSION['user_email']);
?>
<div id="userModal" class="modal">
	<div class="modal-content text-center">
		<p class="close-btn">&times;</p>
		<h1 class="text-center" style="color: #000; padding: 15px">Account</h1>

		<?php if ($isLoggedIn): ?>
			<!-- Display user info -->
			<h3> Name : <?php echo htmlspecialchars($_SESSION['user_name']); ?></h3>
			<h3> Email : <?php echo htmlspecialchars(maskEmail($_SESSION['user_email'])); ?></h3>
			<p> User Type : <?php echo htmlspecialchars(ucfirst($_SESSION['user_type'])); ?></p>
			<a href="logout.php" class="btn btn-danger">Logout</a>
		<?php else: ?>
			<!-- Display generic user info -->
			<h2 class="pb-5">Guest</h2>

			<a href="../backend/index.php" class="btn" style="background-color: #007bff; color: white;">Login</a>
			<a href="../backend/registration.php" class="btn" style="background-color: #9FE2BF; color: white;">Registration</a>
		<?php endif; ?>
	</div>
</div>

<script>
	const iconUser = document.querySelector('.icon-user');
	const userCard = document.querySelector('.user-card');

	iconUser.addEventListener('mouseenter', () => {
		userCard.classList.add('visible');
	});

	iconUser.addEventListener('mouseleave', () => {
		setTimeout(() => {
			userCard.classList.remove('visible');
		}, 300); // Delay to allow for smooth transition
	});
</script>