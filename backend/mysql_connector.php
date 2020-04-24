<?php
// Datenbank-Verbindung herstellen
// siehe (mysql-datenbank-verbindung-herstellen.htm)
require_once ('mysql_config.php');

// zuweisen der MySQL-Anweisung einer Variablen
$sql = 'CREATE DATABASE adressverwaltung ';

$result = mysqli_query($db_link, $sql)
  or die("Anfrage fehlgeschlagen: " . mysql_error());
?>

<?php
// Datenbank-Verbindung herstellen
require_once ('mysql_config.php');

// MySQL-Befehl der Variablen $sql zuweisen
$sql = "
    CREATE TABLE `adressen` (
    `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `nachname` VARCHAR( 150 ) NOT NULL ,
    `vorname` VARCHAR( 150 ) NULL ,
    `akuerzel` VARCHAR( 2 ) NOT NULL ,
    `strasse` VARCHAR( 150 ) NULL ,
    `plz` INT( 5 ) NOT NULL ,
    `telefon` VARCHAR( 20 ) NULL
    ) ENGINE = MYISAM ;
    ";

// MySQL-Anweisung ausführen lassen
$db_erg = mysqli_query($db_link, $sql)
  or die("Anfrage fehlgeschlagen: " . mysqli_error());
?>
