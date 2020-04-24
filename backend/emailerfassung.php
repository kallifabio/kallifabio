<?php
// Grundformular gespeichert unter dem Namen: emailerfassung.php
?>

<form action="emailerfassung.php" method="get">

  <p>Ihre E-Mail-Adresse<br>
    <input type="Text" name="email"></p>

    <p>Name:<br>
      <input type="Text" name="name"></p>

      <input type="Submit" name="" value="speichern">

    </form>

    <?php
    if ( $_GET['email'] <> "" )
    {
      // und nun die Daten in eine Datei schreiben
      // Datei wird zum Schreiben geöffnet
      $handle = fopen ( "anfragen.txt", "w" );

      // schreiben des Inhaltes von email
      fwrite ( $handle, $_GET['email'] );

      // Trennzeichen einfügen, damit Auswertung möglich wird
      fwrite ( $handle, "|" );

      // schreiben des Inhalts von name
      fwrite ( $handle, $_GET['name'] );

      // Datei schließen
      fclose ( $handle );

      echo "Danke - Ihre Daten wurden speichert";

      // Datei wird nicht weiter ausgeführt
      exit;
    }
    ?>

    <form action="emailerfassung.php" method="get">

      <p>Ihre E-Mail-Adresse<br>
        <input type="Text" name="email"></p>

        <p>Name:<br>
          <input type="Text" name="name"></p>

          <input type="Submit" name="" value="speichern">

        </form>

        <?php
        // Datei öffnen zum lesen und schreiben
        $handle = fopen ("mailadressen.txt", "r");

        while ( $inhalt = fgets ($handle, 4096 ))
        {
          echo "<li> $inhalt ";
        }

        fclose($handle);
        ?>
