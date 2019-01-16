<?php

include('includes/db_connection.php');
include('includes/helpers.php');

$randos = getRandos($conn);


function getRandos($conn)
{
    $query = 'select * from hiking';
    if ($query = $conn->query($query)) {
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return null;
    }
}

requireWith('includes/layout/header.php', ['title' => 'Randonnées'])


?>
  <body>
  <?php
  if (isset($_SESSION['flash'])) { ?>
      <div class="<?= 'flash-'.$_SESSION['flash']['class'] ?>">
          <p><?= $_SESSION['flash']['message']?></p>
      </div>
  <?php } session_unset() ?>

    <div class="container">
        <h1>Liste des randonnées</h1>

        <a href="create.php" class="addButton">Ajouter une randonnée</a>

        <table class="readTable">
            <tr>
                <th>Nom</th>
                <th>Difficulté</th>
                <th>Distance</th>
                <th>Durée</th>
                <th>Dénivelé</th>
                <th>Disponible</th>
                <th></th>
            </tr>
            <?php if (!empty($randos)) { ?>
                <?php foreach($randos as $rando) { ?>
                    <tr>
                        <td><a href="<?= 'update.php?id='.$rando['id'] ?>"><?= $rando['name'] ?></a></td>
                        <td><?= ucfirst($rando['difficulty']) ?></td>
                        <td><?= $rando['distance'] ?></td>
                        <td><?= $rando['duration'] ?></td>
                        <td><?= $rando['height_difference'] ?></td>
                        <td><?= $rando['available'] == '1' ? 'Oui' : 'Non' ?></td>
                        <td><a href="<?= 'delete.php?id='.$rando['id'] ?>" class="deleteButton">x</a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
  </body>
</html>
