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
requireWith('includes/layout/header.php', ['title' => 'Randonnées']);
require('includes/layout/flashMessage.php');
?>

<div class="container">
    <h1>Liste des randonnées</h1>

    <?php if (isset($_SESSION['user_id'])) { ?>
        <a href="create.php" class="addButton">Ajouter une randonnée</a>
    <?php } ?>

    <table class="readTable">
        <tr>
            <th>Nom</th>
            <th>Difficulté</th>
            <th>Distance</th>
            <th>Durée</th>
            <th>Dénivelé</th>
            <th>Disponible</th>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <th></th>
            <?php } ?>
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

                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <td><a href="<?= 'delete.php?id='.$rando['id'] ?>" class="deleteButton">x</a></td>
                    <?php } ?>

                </tr>
            <?php } ?>
        <?php } ?>
    </table>
</div>
</body>
</html>