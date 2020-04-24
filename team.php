<?php
require "config/config.php";
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css" media="screen,projection" />

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <!-- <div class="row">
  <div class="col s10 m7">
  <div class="card">
  <div>
  <img src="http://minotar.net/avatar/kallifabio/90.png">
</div>
<div class="card-content">
<span class="card-title">kallifabio</span>
</div>
</div>
</div>
</div> -->
<h3>Owner</h3>
<h5><?php echo $TEAM_OWNER_1 ?></h5><img src="http://minotar.net/avatar/kallifabio/90.png">
<br>
<br>
<h3>Admin</h3>
<h5><?php echo str_replace(" ", "_", $TEAM_ADMIN_1); ?></h5>
<br>
<h5><?php echo $TEAM_ADMIN_2 ?></h5>
<br>
<h5><?php echo $TEAM_ADMIN_3 ?></h5>
<br>
<br>
<h3>Developer</h3>
<h5><?php echo $TEAM_DEV_1 ?></h5>
<br>
<h5><?php echo $TEAM_DEV_2 ?></h5>
<br>
<h5><?php echo $TEAM_DEV_3 ?></h5>
<br>
<br>
<h3>Moderator</h3>
<h5><?php echo $TEAM_MOD_1 ?></h5>
<br>
<h5><?php echo $TEAM_MOD_2 ?></h5>
<br>
<h5><?php echo $TEAM_MOD_3 ?></h5>
<br>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
</body>

</html>
