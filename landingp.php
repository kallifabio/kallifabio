<?php
  require "config/config.php";

  /* Require API
  ---------------------------*/
  /*require 'mojang-api.class.php';*/

  /* Mojang Status
  ---------------------------*/
  /*$status = MojangAPI::getStatus();
  echo 'Minecraft.net: ' . $status['minecraft.net']; // Minecraft.net: green
  */
 ?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $TITLE_NAME_ONLINE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="google-site-verification" content="CeTknMlUfxMoa1-6oTNVihlqcCXhYTI7qfocIiWtxDI">
    <meta name="description" content="closeheat - Edit Landing Page Code In-browser">
    <meta property="og:description" content="Quickly build high-converting custom landing pages">
    <meta property="og:image" content="http://closeheat.com/img/ogimage.png">
    <meta property="og:title" content="Edit Landing Page Code In-browser">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css" media="screen,projection" />
    <!-- StyleSheets-->
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/css" rel="stylesheet" type="text/css">
    <link href="assets/css/css(1)" rel="stylesheet" type="text/css">
    <link href="assets/css/css(2)" rel="stylesheet" type="text/css">
    <link href="icon" rel="stylesheet">
    <!-- JavaScripts-->
    <link rel="stylesheet" crossorigin="anonymous" href="assets/css/main.css">
    <script type="text/javascript" async="" src="assets/js/mixpanel-2-latest.min.js"></script>
    <script type="text/javascript" async="" src="assets/js/analytics.js"></script>
    <script type="text/javascript" async="" src="assets/js/55363db9-2877-45ff-9ad5-4118a8d080cb.js"></script>
    <script type="text/javascript" async="" src="assets/js/gtm.js"></script>
    <script type="text/javascript" async="" src="assets/js/analytics.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/materialize.min.js"></script>
    <script src="assets/js/smoothscroll.min.js"></script>
    <script>
        ! function() {
            var analytics = window.analytics = window.analytics || [];
            if (!analytics.initialize)
                if (analytics.invoked) window.console && console.error && console.error("Segment snippet included twice.");
                else {
                    analytics.invoked = !0;
                    analytics.methods = ["trackSubmit", "trackClick", "trackLink", "trackForm", "pageview", "identify", "group", "track", "ready", "alias", "page", "once", "off", "on"];
                    analytics.factory = function(t) {
                        return function() {
                            var e = Array.prototype.slice.call(arguments);
                            e.unshift(t);
                            analytics.push(e);
                            return analytics
                        }
                    };
                    for (var t = 0; t < analytics.methods.length; t++) {
                        var e = analytics.methods[t];
                        analytics[e] = analytics.factory(e)
                    }
                    analytics.load = function(t) {
                        var e = document.createElement("script");
                        e.type = "text/javascript";
                        e.async = !0;
                        e.src = ("https:" === document.location.protocol ? "https://" : "http://") + "cdn.segment.com/analytics.js/v1/" + t + "/analytics.min.js";
                        var n = document.getElementsByTagName("script")[0];
                        n.parentNode.insertBefore(e, n)
                    };
                    analytics.SNIPPET_VERSION = "3.0.1";
                    analytics.load('X8Da6RRazy6GokMZpxLQsVvCfcsOfCmQ');
                    analytics.page();
                }
        }();
    </script>
    <!-- Favicons-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://closeheat.com/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://closeheat.com/img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://closeheat.com/img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://closeheat.com/img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://closeheat.com/img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://closeheat.com/img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://closeheat.com/img/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://closeheat.com/img/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://closeheat.com/img/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="http://closeheat.com/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="http://closeheat.com/img/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="http://closeheat.com/img/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="http://closeheat.com/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="http://closeheat.com/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/favicons/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <script src="assets/js/2407530281.js"></script>
    <script async="" src="assets/js/hotjar-67832.js"></script>
    <style type="text/css"></style>
    <script async="" src="assets/js/modules.edc291623c5e6ec9ef2e.js" charset="utf-8"></script>
    <style type="text/css">
        iframe#_hjRemoteVarsFrame {
            display: none !important;--
            width: 1px !important;
            height: 1px !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
    </style>
</head>

<body>
  <noscript>This will not work without JavaScript enabled</noscript>
    <nav>
        <div class="nav-wrapper" style="background-color: #4CAF50; height: 64px;">
            <a href="landingp.php" class="waves-effect brand-logo">kallifabio.net</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class="active"><a class="waves-effect" href="landingp.html">Home</a></li>
                <li><a class="waves-effect" href="#">Forum</a></li>
                <li><a class="waves-effect" href="https://kallifabionetcommunity.buycraft.net/">Shop</a></li>
                <li><a class="waves-effect" href="uuidfetcher/fetcher.php">UUIDFetcher</a></li>
                <li><a class="waves-effect" href="music.html">Music</a></li>
                <li><a class="waves-effect" href="#">Contact</a></li>
                <li><a class="waves-effect" href="login.php">Login</a></li>
                <li><a class="waves-effect" href="#">Team</a></li>
                <li><a class="waves-effect" href="dashboard/dashboard.html">Dashboard</a></li>
                <li><a class="waves-effect" href="discord.html">Discord</a></li>
                <li><a class="waves-effect" href="youtuber.html">Discord</a></li>
            </ul>
        </div>
    </nav>
    <div class="hero hero-landing" style="background-image: url(assets/img/background.png); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="row valign-wrapper no-valign-wrapper-on-mobile">
            <div class="col l5 valign hero-text">
                <div class="container-wide">
                    <h1 style="text-align: right;">Hosting by</h1>
                    <h2 style="text-align: right;"><a class="waves-effect" href="https://www.opusx.io/hosting">OpusX-Hosting</a></h2>
                </div>
            </div>
        </div>
        <div style="text-align: center; background-image: url(assets/img/counterbackground.png); background-size: cover; background-position: center; background-repeat: no-repeat;">
          <h1 style="font-size: 3.5em;">Willkommen auf kallifabio.net</h1>
          <p class="info" style="font-size: 1.3em;">Es befinden sich <span style="color: #4286f4;">0</span> Spieler auf <span class="ip" style="cursor: pointer; color: #4286f4;">kallifabio.net</span></p>
          <?php/*
            $query = MojangAPI::query('de.kallifabio.net', 25565);
            if ($query) echo 'There is ' . $query['players'] . ' players online out of ' . $query['maxplayers'] . '<br>';
            else echo 'Server is offline.<br>';
          */?>
        </div>
    </div>
    <div id="features" class="features">
      <div class="container-wide">
        <div class="row">
          <h2 style="text-align: center; font-size: 3.5em; letter-spacing: 1.2px;">Unsere Minigames</h2>
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">MLGRush</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">TTT</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">1vs1</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">Creative</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
        </div>
        <div class="row">
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">Community</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">Platzhalter</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">Platzhalter</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
          <div class="col l3" style="font-size: 1.05em;">
            <div class="feature-icon"><i class="material-icons">videogame_asset</i></div>
            <div class="feature-title">Platzhalter</div>
            <div class="feature-description">Hier wird eine Beschreibung stehen.</div>
          </div>
        </div>
      </div>
    </div>
    <footer class="page-footer green">
        <div class="container-wide">
            <div class="row">
                <div class="col m6 l6 s12">
                    <div class="row">
                        <div class="col m4 s6">
                            <h2 class="white-text">Wichtige Informationen</h2>
                            <p class="grey-text text-lighten-4">Wir sind ein Team von paar Leuten, die an diesem Projekt arbeiten, als wäre es unser Vollzeitjob. Jeder Betrag würde zur Unterstützung und Weiterentwicklung dieses Projekts beitragen und wird sehr
                              geschätzt.<br />Schreibt uns gerne an <a class="grey-text text-lighten-1" href="mailto:support@kallifabio.net">support@kallifabio.net</a> wenn du zu irgendwas Fragen hast.</p>
                        </div>
                    </div>
                </div>
                <div class="col m6 l6 s12">
                    <div class="row">
                        <div class="col m4 s6">
                          <h2>Social Media</h2>
                            <ul>
                                <li><a class="white-text waves-effect" href="#" style="text-transform: none; font-size: 18px;">Twitter</a></li>
                                <li><a class="white-text waves-effect" href="#" style="text-transform: none; font-size: 18px;">Instagram</a></li>
                                <li><a class="white-text waves-effect" href="#" style="text-transform: none; font-size: 18px;">Facebook</a></li>
                                <li><a class="white-text waves-effect" href="#" style="text-transform: none; font-size: 18px;">Platzhalter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col m6 l6 s12">
                    <div class="row">
                        <div class="col m4 s6">
                          <h2>Wichtige Links</h2>
                            <ul>
                                <li><a class="white-text waves-effect" href="https://materializecss.com/" style="text-transform: none; font-size: 18px;">Materialize</a></li>
                                <li><a class="white-text waves-effect" href="#" style="text-transform: none; font-size: 18px;">Support</a></li>
                                <li><a class="white-text waves-effect" href="status.php" style="text-transform: none; font-size: 18px;">Status</a></li>
                                <li><a class="white-text waves-effect" href="https://hardwarespecs.de/impressum.html" style="text-transform: none; font-size: 18px;">Impressum</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
      <div class="container left-align">
        <div class="left">
          © 2020 Copyright by kallifabio - All rights reserved
        </div>
        <div class="right">
          <a href="agb.html" class="grey-text text-lighten-3 waves-effect" style="text-align: right;">Nutzungs und Datenschutzbedinungen</a>
        </div>
      </div>
    </div>
    </footer>
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 67832,
                hjsv: 5
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'http://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <div class="hiddendiv common"></div>
    <script type="text/javascript" id="" src="assets/js/adsbygoogle.js"></script>
    <script type="text/javascript" id="">
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-4745843440367393",
            enable_page_level_ads: !0
        });
    </script>
    <iframe name="_hjRemoteVarsFrame" title="_hjRemoteVarsFrame" id="_hjRemoteVarsFrame" src="box-b736908ce6b0e933fad3a2e45df61b38.html" style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="assets/js/mcstatus.js"></script>
    <script src="assets/js/playercount.js" type="text/javascript"></script>
    <script src="//code.tidio.co/uwng4bivfnj9gy6s1m2tivt0xikl0zsj.js"></script>
</body>

</html>
