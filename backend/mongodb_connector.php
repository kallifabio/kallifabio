<?php
$mongo= new MongoClient();
$db=$mongo->local;
$collection=$db->kontakt;

if($_POST)
{
  $insert= array(
    'name'=> $_POST['name'],
    'telefon'=> $_POST['telefon'],
    'email'=> $_POST['email'],
  );

  if($collection->insert($insert))
  {
    echo "Daten sind angekommen";
  }
  else {
    echo "some Issue";
  }
}
else {
  echo "Es gitb keine Daten zum speichern";
}
?>
