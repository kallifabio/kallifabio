<?php
	require 'config/config.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $TITLE_NAME_ONLINE ?></title>

	<link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link href="assets/css/index.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/darkmode.css">

	<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.reyfm.de/js/socket.io.js"></script>
	<script src="assets/js/app.js"></script>
	<script type="text/javascript">
		var arrLang = {
			'de': {
				'home': 'Startseite',
				'shop': 'Laden',
				'dashboard': 'Eigenschaftenleiste',
				'music': 'Musik',
				'contact': 'Kontakt',
				'login': 'Anmelden',
				'team': 'Mitglieder'
			},
			'en': {
				'home': 'Home',
				'shop': 'Shop',
				'dashboard': 'Dashboard',
				'music': 'Music',
				'contact': 'Contact',
				'login': 'Login',
				'team': 'Team'
			}
		};

		$(function() {
			$('.translate').click(function() {
				var lang = $(this).attr('id');

				$('.lang').each(function(index, element) {
					$(this).text(arrLang[lang][$(this).attr('key')]);
				});
			});
		});
	</script>
	<script>
		if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
			console.log('🎉 Dark mode is supported');
		}
	</script>
	<!-- <script type="text/javascript">
	// YOUR SCRIPT GOES HERE ...

	var vr = document.registerElement('v-r'); // vertical rule

</script> -->
</head>

<body id="startseite">
	<noscript>This will not work without JavaScript enabled</noscript>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand disabled" href="" style="coursor: none;">kallifabio.net</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="lang nav-item nav-link active" key="home" href="index.html">Startseite<span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link disabled" href="#">Forum</a>
				<a class="lang nav-item nav-link disabled" key="shop" href="#">Laden</a>
				<!-- <a class="lang nav-item nav-link disabled" key="dashboard" href="dashboard.html">Dashboard</a> -->
				<a class="nav-item nav-link" href="uuidfetcher/fetcher.php">UUIDFetcher</a>
				<a class="lang nav-item nav-link disabled" key="music" href="#">Musik</a>
				<a class="lang nav-item nav-link disabled" key="contact" href="#">Kontakt</a>
				<a class="lang nav-item nav-link" key="login" href="login.html">Anmelden</a>
			</div>
			<div class="navbar-nav">
				<a class="lang nav-item nav-link disabled" key="team" href="#">Mitglieder</a>
			</div>
		</div>
	</nav>
	<script>
		function apply_darkmode() {
			$("meta[property='apple-mobile-web-app-status-bar-style']").attr("content", "black-translucent");
			$("#preloader img").attr("src", "https://cdn.reyfm.de/img/glitch-logo-v2-white.gif");
			$('head').prepend($('<style>#preloader{background:#131317!important;}</style>'));
			$('head').append($('<link rel="stylesheet" type="text/css" />').attr('href', 'assets/css/darkmode.css'));
		}

		function load_darkmode() {
			if (localStorage.getItem("settings.darkmode") === "true") {
				if (localStorage.getItem("settings.darkmode.auto") === "true") {
					var timehours = new Date().getHours();
					if (timehours >= 20 || timehours < 6) {
						rfm.is_darkmode = true;
						apply_darkmode();
					}
				} else {
					rfm.is_darkmode = true;
					apply_darkmode();
				}
			}
		}
		load_darkmode();
	</script>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.html" data-activates="slide-out" style="cursor: none;">kallifabio.net</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="lang" key="home"><a class="navbar" href="index.html">Home</a></li>
				<li class="lang" key="forum"><a class="navbar" href="#">Forum</a></li>
				<li class="lang" key="shop"><a class="navbar" href="index.php">Shop</a></li>
				<li class="lang" key="dashboard"><a class="navbar" href="dashboard.html">Dashboard</a></li>
			</ul>
		</div>
	</nav>

	<div class="dropdown">
		<button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Sprache auswählen
		</button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
			<button onclick="gfg_Run()" class="translate dropdown-item" type="btn" id="de" style="color: #039be5; font-size: 17px;">Deutsch<img alt src="./assets/img/lang/de-DE.png" style="height: 40px; width: 40px; margin: 5px 15px; float: right;"></button>
			<br />
			<button onclick="changeColor('button', '#101010')" class="translate dropdown-item" type="btn" id="en" style="color: #039be5; font-size: 17px;">Englisch<img alt src="./assets/img/lang/en-US.png" style="height: 40px; width: 40px; margin: 5px 15px; float: right;"></button>
			<script>
				var de = document.getElementById("de");
				var en = document.getElementById("en");

				function changeColor(color) {
					document.body.style.color = color;
				}

				function gfg_Run() {
					changeColor('yellow');
				}
			</script>
		</div>
	</div>

	<ul>
		<li class="lang" key="home"><a href="index.html">Home</a></li>
		<li class="lang" key="forum">Forum</li>
		<li class="lang" key="shop">Shop</li>
		<li class="lang" key="dashboard">Dashboard</li>
		<li class="lang" key="contact">Contact</li>
	</ul>
	<center>
		<iframe src="https://open.spotify.com/embed/playlist/4jVvhTA6Xf56C1uBR48HVF" width="620" height="608" frameborder="0" allowtransparency="false" allow="encrypted-media"></iframe>
		<div id="cover-container" class="pointer" style="background-color: #a826ff; margin-left: 150px; margin-right: 150px;">
			<img id="play" src="https://cdn.reyfm.de/img/play-icon-shadow.png">
			<div id="artist" class="rightpx" style="text-align: right; margin-right: 350px;">ARTIST</div>
			<div id="title" class="rightpx" style="text-align: right; margin-right: 350px;">TITLE</div>
			<div id="listeners" class="rightpx" style="text-align: right; margin-right: 350px;">LIVE <span>— <span class="listeners">0</span></span></div>
			<div class="slider-container">
				<input class="slider" id="volumeslider" type="range" min="0" max="100" step="1">
			</div>
			<!-- <img class="cover" id="coverart-bg" src="https://cdn.reyfm.de/img/nocover_500x500_blurred.jpg">
			<img class="cover" id="coverart" src="https://cdn.reyfm.de/img/nocover_500x500_blurred.jpg" style=""> -->
		</div>
		<div id="chat" class="shadow" style="display: block;">
			<section id="chatroom"></section>
			<section id="input_zone">
				<input id="message" class="vertical-align" placeholder="Nachricht" type="text" />
				<button id="send_message" class="vertical-align pointer" type="button"></button>
			</section>
		</div>
		<!-- <audio class="channel-player shadow" id="audio_with_controls" style="color: #039be5;" controls src="https://listen.reyfm.de/mashup_320kbps.mp3" type="audio/mp3" autoplay="false" loop="false">
			Ihr Browser kann dieses Tondokument nicht wiedergeben.<br>
			Es enthält eine Aufführung der Europahymne.
			Sie können es unter
			<a href="https://listen.reyfm.de/mashup_320kbps.mp3">diesem Link</a>
			abrufen.
		</audio> -->
	</center>
	<script>
		$(document.body).addClass('content-channel');
		chn = '13';
		chnName = 'mashup';
		chnColor = '#a826ff'
	</script>
	<script src="assets/js/player.js"></script>

	</script>
	<a id="79f299fa9190f476a1f41b6ce0f5a53a" href="http://www.gratis-kontaktformular.de" style="color: #039be5;">http://www.gratis-kontaktformular.de/</a>
	<script src="https://www.gratis-kontaktformular.de/formular.php?i=79f299fa9190f476a1f41b6ce0f5a53a" type="text/javascript"></script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="//code.tidio.co/uwng4bivfnj9gy6s1m2tivt0xikl0zsj.js"></script>
</body>

</html>
