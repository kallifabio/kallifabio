<?php
  require "backend/mysql_connector.php";

  $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
  $txt = "John Doe\n";
  fwrite($myfile, $txt);
  $txt = "Jane Doe\n";
  fwrite($myfile, $txt);
  fclose($myfile);

  $statement = $mysql->prepare("INSERT INTO users (email, vorname, nachname) VALUES (?, ?, ?)");
  $statement->execute(array('info@php-einfach.de', 'Klaus', 'Neumann'));
?>
