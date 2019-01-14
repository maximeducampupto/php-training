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

    $sql = "insert into hiking (name, difficulty, distance, duration, height_difference) VALUES (?,?,?,?,?)";
    $stmt= $conn->prepare($sql);

     if (isset($_POST['button']))
    {
         $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
         $difficulty = filter_var($_POST['difficulty'], FILTER_SANITIZE_STRING);
         $distance = filter_var($_POST['distance'], FILTER_SANITIZE_NUMBER_INT);
         $duration = filter_var($_POST['duration'], FILTER_SANITIZE_STRING);
         $height_difference = filter_var($_POST['height_difference'], FILTER_SANITIZE_NUMBER_INT);

         if ($stmt->execute([$name, $difficulty, $distance, $duration, $height_difference])) {
             $_SESSION['flash'] = ['class' => 'success', 'message' => 'Randonnée correctement ajoutée'];
         } else {
             $_SESSION['flash'] = ['class' => 'error', 'message' => 'Une erreur est survenue'];
         }
         header('Location: read.php');
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
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
