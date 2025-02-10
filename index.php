<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rogue_test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>We are coming soon</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<!-- Bootstrap CSS -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

	<!-- Bootstrap JS Bundle (includes Popper.js) -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->

	<!-- SweetAlert2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

	<!-- SweetAlert2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



	<!-- Fonts-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome/font-awesome.min.css">
	<!-- Vendors-->
	<link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/grid.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/YTPlayer/css/jquery.mb.YTPlayer.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/vegas/vegas.min.css">
	<!-- App & fonts-->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Work+Sans:300,400,500,700">
	<link rel="stylesheet" type="text/css" id="app-stylesheet" href="assets/css/main.css">
</head>

<body>
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
		$email = $_POST['email'];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// Check if the email already exists in the database
			$checkStmt = $conn->prepare("SELECT id FROM subscribers WHERE email = ?");
			$checkStmt->bind_param("s", $email);
			$checkStmt->execute();
			$checkStmt->store_result();

			if ($checkStmt->num_rows > 0) {
				// Email already exists: Show error message with SweetAlert
				echo "<script>
                    Swal.fire({
                        title: 'Email Already Exists!',
                        text: 'Email already added to wishlist. Please enter a different email address.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                </script>";
			} else {
				// Email is unique: Proceed with the insertion
				$stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");

				// Check if prepare failed
				if ($stmt === false) {
					echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to prepare the query.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    </script>";
					exit;
				}

				// Bind the parameter and check if it succeeded
				$stmt->bind_param("s", $email);

				// Execute the query and check if the insertion was successful
				if ($stmt->execute()) {
					// Success: Show success message with SweetAlert
					echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'You have successfully added to wishlist!',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then(() => {
                            window.location.href = 'index.php'; // Redirect to the homepage or any other page
                        });
                    </script>";
				} else {
					// Error: Show error message with SweetAlert
					echo "<script>
                        Swal.fire({
                            title: 'Oops!',
                            text: 'There was an error while adding in wishlist. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    </script>";
				}

				// Close the statement
				$stmt->close();
			}

			// Close the check statement
			$checkStmt->close();
		} else {
			// Invalid email format: Show error message with SweetAlert
			echo "<script>
                Swal.fire({
                    title: 'Invalid Email!',
                    text: 'Please enter a valid email address.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            </script>";
		}
	}

	// Close the database connection
	$conn->close();
	?>

	<div class="page-wrap" id="root">
		<div class="md-content">
			<div class="hero md-skin-dark" style="background-image:url(https://images.pexels.com/photos/764880/pexels-photo-764880.jpeg?w=1260&amp;h=750&amp;auto=compress&amp;cs=tinysrgb);">
				<div class="container">
					<div class="hero__wrapper">
						<div class="row">
							<div class="col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-1 ">
								<div class="hero__title_inner"><span class=""><img src="rogue-logo-white.png" alt=""></span>
									<h1 class="hero__title">We Are Almost Ready for Launch</h1>
								</div>
							</div>
						</div>
						<div class="countdown__module" data-date="2025/05/01">
							<p><span id="days">%D</span> Days</p>
							<p><span id="hours">%H</span> Hours</p>
							<p><span id="minutes">%M</span> Minutes</p>
							<p><span id="seconds">%S</span> Seconds</p>
						</div>

						<!-- Email Form Section -->
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-12 col-md-6">
									<h1 class="hero__title text-center">Add Me To Wishlist</h1>
									<form id="email-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateEmail(event)">
										<div class="form-group">
											<input type="email" id="email" name="email" class="w-100" placeholder="Enter your Email Address" required style="border-radius: 0;">
										</div>
										<div class="pt-5 d-flex justify-content-center align-items-center">
											<button type="submit" class="btn btn-dark btn-sm">Notify Me</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Vendors-->
	<script type="text/javascript" src="assets/vendors/jquery/jquery.min.js"></script>
	<!-- Bootstrap JS Bundle (including Popper.js) -->
	<script type="text/javascript" src="assets/vendors/jquery.countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="assets/vendors/flat-surface-shader/fss.min.js"></script>
	<script type="text/javascript" src="assets/vendors/particles.js/particles.js"></script>
	<script type="text/javascript" src="assets/vendors/waterpipe/waterpipe.js"></script>
	<script type="text/javascript" src="assets/vendors/quietflow/quietflow.min.js"></script>
	<script type="text/javascript" src="assets/vendors/YTPlayer/jquery.mb.YTPlayer.min.js"></script>
	<script type="text/javascript" src="assets/vendors/vegas/vegas.min.js"></script>
	<!-- App-->
	<script type="text/javascript" src="assets/js/main.js"></script>

	<script>
		$(document).ready(function() {
			// Set the target date (May 1, 2025 at 00:00:00)
			let targetDate = new Date("May 1, 2025 00:00:00").getTime();

			function updateCountdown() {
				let now = new Date().getTime();
				let timeLeft = targetDate - now;

				if (timeLeft <= 0) {
					clearInterval(countdownTimer);
					$("#days, #hours, #minutes, #seconds").text("00");
					return;
				}

				let days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
				let hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
				let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

				// Ensuring two-digit format (e.g., 01, 02, ..., 09)
				$("#days").text(days.toString().padStart(2, '0'));
				$("#hours").text(hours.toString().padStart(2, '0'));
				$("#minutes").text(minutes.toString().padStart(2, '0'));
				$("#seconds").text(seconds.toString().padStart(2, '0'));
			}

			// Initial call to avoid delay
			updateCountdown();

			// Update the countdown every second
			let countdownTimer = setInterval(updateCountdown, 1000);
		});

		// Email validation function using SweetAlert
		function validateEmail(event) {
			event.preventDefault();

			const email = document.getElementById('email').value;
			const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

			if (regex.test(email)) {
				// If the email is valid, submit the form
				document.getElementById('email-form').submit();
			} else {
				// Show SweetAlert error for invalid email
				Swal.fire({
					title: 'Oops!',
					text: 'Please enter a valid email address.',
					icon: 'error',
					confirmButtonText: 'Try Again'
				});
			}
		}
	</script>
</body>

</html>