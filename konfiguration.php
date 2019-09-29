<?php
// die Konstanten auslagern in eigene Datei
// die dann per require_once ('konfiguration.php');
// geladen wird.

// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define ( 'MYSQL_HOST',      'localhost' );

// bei XAMPP ist der MYSQL_Benutzer: root
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );
// für unser Bsp. nennen wir die DB adressverwaltung
define ( 'MYSQL_DATENBANK', 'adressverwaltung' );
?>

<?php
require_once ('konfiguration.php');
$db_link = mysqli_connect (
  MYSQL_HOST,
  MYSQL_BENUTZER,
  MYSQL_KENNWORT,
  MYSQL_DATENBANK
);
?>

<?php
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
define ( 'MYSQL_HOST',      'localhost' );
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );
define ( 'MYSQL_DATENBANK', 'adressverwaltung' );

$db_link = mysqli_connect (MYSQL_HOST,
MYSQL_BENUTZER,
MYSQL_KENNWORT,
MYSQL_DATENBANK);

if ( $db_link )
{
  echo 'Verbindung erfolgreich: ';
  print_r( $db_link);
}
else
{
  // hier sollte dann später dem Programmierer eine
  // E-Mail mit dem Problem zukommen gelassen werden
  die('keine Verbindung möglich: ' . mysqli_error());
}
?>
