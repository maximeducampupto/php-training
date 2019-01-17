<?php
/**** Supprimer une randonnée ****/

include('includes/db_connection.php');
include('includes/check_login.php');


if (isset($_GET['id']))
{
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "delete from hiking where id = $id";

    if ($conn->query($query))
    {
        $_SESSION['flash'] = ['class' => 'success', 'message' => 'Randonnée correctement supprimée'];
    } else {
        $_SESSION['flash'] = ['class' => 'error', 'message' => 'Une erreur est survenue'];
    }
    header('Location: index.php');

}