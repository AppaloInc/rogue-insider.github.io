<!DOCTYPE html>
<html>

<head>
	<title>We are coming soon</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- Fonts-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome/font-awesome.min.css">
	<!-- Vendors-->
	<link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/grid.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/YTPlayer/css/jquery.mb.YTPlayer.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/vegas/vegas.min.css">
	<!-- App & fonts-->
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Work+Sans:300,400,500,700">
	<link rel="stylesheet" type="text/css" id="app-stylesheet" href="assets/css/main.css">
</head>

<body>
	<div class="page-wrap" id="root">
		<div class="md-content">

			<div class="hero md-skin-dark"
				style="background-image:url(https://images.pexels.com/photos/764880/pexels-photo-764880.jpeg?w=1260&amp;h=750&amp;auto=compress&amp;cs=tinysrgb);">
				
				<div class="container">
					<div class="hero__wrapper">
						<div class="row">
							<div class="col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-1 ">
								<div class="hero__title_inner"><span class=""><img src="rogue-logo-white.png"
											alt=""></span>
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

						<div class="service-wrapper">

							<div class="service">
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- Vendors-->
	<script type="text/javascript" src="assets/vendors/jquery/jquery.min.js"></script>
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
		$(document).ready(function () {
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
	</script>
</body>

</html>