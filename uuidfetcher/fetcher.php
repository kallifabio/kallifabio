<html lang="de">

<head>
  <meta charset="utf-8">
  <title>kallifabio.net | UUIDFetcher</title>

  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
  <link href="fetcher.css" type="text/css" rel="stylesheet">
</head>

<body>
  <form action="#" method="GET">
    <input type="text" name="username" placeholder="Gebe deinen gewünschten Username ein" onclick="this.value = '';">
    <br/>
    <input type="text" name="uuid" placeholder="Gebe deine gewünschte UUID ein" onclick="this.value = '';">
    <br/>
    <input type="submit" value="Absenden">
    <br/>
  </form>
  <footer class="footer">
    <p>Template by BukkitDev</p>
    <a href="https://pixabay.com/de/users/allinonemovie-201131/" target="_blank"><p>Background Image by allinonemovie</p></a>
  </footer>
</body>
</html>
<!-- <?php
header('Location: fetcher.php');
exit();
?> -->
<?php
if (isset($_GET['username']) and $_GET['username'] != "username" and $_GET['username'] != "") {
  echo "<div id='container'>";
  $username = $_GET['username'];
  $uuid = getUUID($username);
  echo "<h1>" . $username . "</h1><br>";
  echo "<img src='https://minotar.net/avatar/" . $username . "'\"</img><br>";
  echo "<br><b>Namensverlauf:</b><br>";
  echo getAllNames($uuid);
  echo "<br><b>UUID:</b> " . $uuid . "<br>";
  echo "</div><br>";
}

if (isset($_GET['uuid']) and $_GET['uuid'] != "uuid" and $_GET['uuid'] != "") {
  echo "<div id='container'>";
  $uuid = $_GET['uuid'];
  $username = getLastUserName($uuid);
  echo "<h1>" . $username . "</h1><br>";
  echo "<img src='https://minotar.net/avatar/" . $username . "'\"</img><br>";
  echo "<br><b>Namensverlauf:</b><br>";
  echo getAllNames($uuid);
  echo "<br><b>UUID:</b> " . $uuid;
  echo "</div><br>";
}

function getUUID($username)
{
  $json = file_get_contents('https://api.mojang.com/users/profiles/minecraft/' . $username);
  if (!empty($json)) {
    $data = json_decode($json, true);
    if (is_array($data) and !empty($data)) {
      return $data['id'];
    }
  }
}

function getLastUserName($uuid)
{
  $json = file_get_contents('https://api.mojang.com/user/profiles/' . $uuid . '/names');
  if (!empty($json)) {
    $data = json_decode($json, true);
    if (is_array($data) and !empty($data)) {
      $last = array_pop($data);
      return $last['name'];
    }
  }
}

function getAllNames($uuid)
{
  $json = file_get_contents('https://api.mojang.com/user/profiles/' . $uuid . '/names');
  if (!empty($json)) {
    $data = json_decode($json, true);
    if (is_array($data) and !empty($data)) {

      $data = array_reverse($data);
      foreach ($data as $key => $value) {
        echo($value['name'] . "<br>");
      }
    }
  }
}
?>
