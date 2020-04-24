<?php
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
define ( 'MYSQL_HOST',      'localhost' );
define ( 'MYSQL_BENUTZER',  '' );
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
