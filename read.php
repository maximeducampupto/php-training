<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "reunion_island";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $randos = getRandos($conn);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

function getRandos($conn)
{
    $query = 'select * from hiking';
    if ($query = $conn->query($query)) {
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>

  <?php

  if (isset($_SESSION['flash'])) { ?>
      <div class="<?= 'flash-'.$_SESSION['flash']['class'] ?>">
          <p><?= $_SESSION['flash']['message']?></p>
      </div>
  <?php } session_unset() ?>

    <div class="container">
        <h1>Liste des randonnées</h1>
        <table class="readTable">
            <tr>
                <th>Nom</th>
                <th>Difficulté</th>
                <th>Distance</th>
                <th>Durée</th>
                <th>Dénivelé</th>
            </tr>
            <?php foreach($randos as $rando) { ?>
                <tr>
                    <td><a href="<?= 'update.php?id='.$rando['id'] ?>"><?= $rando['name'] ?></a></td>
                    <td><?= ucfirst($rando['difficulty']) ?></td>
                    <td><?= $rando['distance'] ?></td>
                    <td><?= $rando['duration'] ?></td>
                    <td><?= $rando['height_difference'] ?></td>
                </tr>
            <?php } ?>
        </table>

        <a href="create.php">Ajouter une randonnée</a>
    </div>

  </body>
</html>
