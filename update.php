<?php

include('includes/db_connection.php');
include('includes/helpers.php');

if (isset($_GET['id']))
{
    $id = htmlspecialchars($_GET['id']);
    $q = "select * from hiking where id = $id";
    if ($query = $conn->query($q)) {
        $rando = $query->fetch(PDO::FETCH_ASSOC);
    }
}

$sql = "update
        hiking
        set
        name=?,
        difficulty=?,
        distance=?,
        duration=?,
        height_difference=?,
        available=?
        where id=?";
$stmt= $conn->prepare($sql);

if (!empty($_POST))
{
    include('includes/formValidation.php');

    if ($stmt->execute([$name, $difficulty, $distance, $duration, $height_difference, $available, $id]))
    {
        $_SESSION['flash'] = ['class' => 'success', 'message' => 'Randonnée correctement éditée'];
    } else {
        $_SESSION['flash'] = ['class' => 'error', 'message' => 'Une erreur est survenue'];
    }
    header('Location: index.php');
}


requireWith('includes/layout/header.php', ['title' => 'Editer une randonnée']);

?>

<body>
	<a href="/php-training/read.php">Liste des données</a>
	<h1 style="text-align: center; margin-bottom: 2rem;">Editer</h1>
	<form action="" method="post" class="rando-form">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?= $rando['name'] ?>" required>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty" required>
				<option value="très facile" <?= $rando['difficulty'] == 'très facile' ? 'selected' : ''?>>Très facile</option>
				<option value="facile"  <?= $rando['difficulty'] == 'facile' ? 'selected' : ''?>>Facile</option>
				<option value="moyen"  <?= $rando['difficulty'] == 'moyen' ? 'selected' : ''?>>Moyen</option>
				<option value="difficile"  <?= $rando['difficulty'] == 'difficile' ? 'selected' : ''?>>Difficile</option>
				<option value="très difficile" <?= $rando['difficulty'] == 'très difficile' ? 'selected' : ''?>>Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?= $rando['distance'] ?>" required>
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?= $rando['duration'] ?>" required>
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?= $rando['height_difference'] ?>" required>
		</div>

        <div>
            <div>
                <label for="available">Disponible</label>
                <select name="available">
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>
        </div>
        <input type="submit" value="Editer" style="width: 10% !important;">
	</form>
</body>
</html>
