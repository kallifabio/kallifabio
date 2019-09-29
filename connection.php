<!DOCTYPE html>
<html lang="de">
<head>

</head>
<body>
  <?php
  $verbindung = mysqli_connect ("localhost", "blockhome_kalli", "root")
  or die("Fehler im System");

  mysqli_select_db ($verbindung, "tutorial")
  or die("Es konnte keine Verbindung zur Datenbank hergestellt werden.");

  ?>
</body>
</html>
