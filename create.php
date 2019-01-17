<?php

include('includes/db_connection.php');
include('includes/helpers.php');
include('includes/check_login.php');


$sql = "insert into hiking (name, difficulty, distance, duration, height_difference, available) VALUES (?,?,?,?,?,?)";
$stmt= $conn->prepare($sql);

if (isset($_POST['button']))
{
    include('includes/formValidation.php');

    if ($stmt->execute([$name, $difficulty, $distance, $duration, $height_difference, $available])) {
        $_SESSION['flash'] = ['class' => 'success', 'message' => 'Randonnée correctement ajoutée'];
    } else {
        $_SESSION['flash'] = ['class' => 'error', 'message' => 'Une erreur est survenue'];
    }
    header('Location: index.php');
}


requireWith('includes/layout/header.php', ['title' => 'Ajouter une randonnée'])

?>

<body>
	<a href="/php-training/index.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="" required>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty" required>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="" required>
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="" required>
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="" required>
		</div>

        <div>
            <label for="available">Disponible</label>
            <select name="available">
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
