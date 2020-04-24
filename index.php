<?php
  require "config/config.php";
 ?>

<!DOCTYPE html>
<html lang="de">
<head>
	<title><?php echo $TITLE_NAME_WARTUNG ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/countdowntime/flipclock.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/web.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="bg-img1 size1 overlay1 p-b-35 p-l-15 p-r-15" style="background-image: url('assets/img/bg01.png');">
		<div class="flex-col-c p-t-160 p-b-215 respon1">
			<div class="wrappic1">
				<!-- <a href="#"><img src="images/icons/logo.png" alt="IMG"></a> -->
			</div>

			<h6 class="l1-txt1 txt-center p-t-30 p-b-100">
				Der Server geht in
			</h6>

			<div class="cd100"></div>

			<h6 class="l1-txt1 txt-center p-t-30 p-b-100">
				online!
			</h6>

		</div>

		<!--  -->
		<div class="flex-w flex-c-m p-b-35">
			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-facebook"></i>
			</a>

			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-twitter"></i>
			</a>

			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-youtube-play"></i>
			</a>
		</div>
		<footer>
			<p>&copy; 2020 Copyright by kallifabio - All rights reserved</p>
		</footer>
	</div>
<!--===============================================================================================-->
	<script src="plugins/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="plugins/bootstrap/js/popper.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="plugins/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="plugins/countdowntime/flipclock.min.js"></script>
	<script src="plugins/countdowntime/moment.min.js"></script>
	<script src="plugins/countdowntime/moment-timezone.min.js"></script>
	<script src="plugins/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="plugins/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 0,
			endtimeHours: 0,
			endtimeMinutes: 1,
			endtimeSeconds: 20,
			timeZone: ""
			// ex:  timeZone: "America/Argentina/Buenos_Aires"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="plugins/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>
</body>
</html>
