<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "reunion_island";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
        $q = "select * from hiking where id = $id";
        if ($query = $conn->query($q)) {
            $rando = $query->fetch(PDO::FETCH_ASSOC);
        }
    }
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/php-training/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?= $rando['name'] ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile" <?= $rando['difficulty'] == 'très facile' ? 'selected' : ''?>>Très facile</option>
				<option value="facile"  <?= $rando['difficulty'] == 'facile' ? 'selected' : ''?>>Facile</option>
				<option value="moyen"  <?= $rando['difficulty'] == 'moyen' ? 'selected' : ''?>>Moyen</option>
				<option value="difficile"  <?= $rando['difficulty'] == 'difficile' ? 'selected' : ''?>>Difficile</option>
				<option value="très difficile" <?= $rando['difficulty'] == 'très difficile' ? 'selected' : ''?>>Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?= $rando['distance'] ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?= $rando['duration'] ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?= $rando['height_difference'] ?>">
		</div>
		<button type="button" name="button">Envoyer</button>
	</form>
</body>
</html>
