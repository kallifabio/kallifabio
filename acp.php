<?php
require('acp2.php');

if(isset($_GET['username'])) {
   $username = $_GET['username'];
} else {
   $username = "Gast";
}

echo "Hallo $username, dein Passwort sollte zwischen ".$config['min_password_length']." und ".$config['max_password_length']." Zeichen besitzen";

?>
