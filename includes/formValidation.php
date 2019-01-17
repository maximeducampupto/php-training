<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15-Jan-19
 * Time: 1:16 PM
 */

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;


$form = new stdClass;
$form->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$form->difficulty = filter_var($_POST['difficulty'], FILTER_SANITIZE_STRING);
$form->distance = filter_var($_POST['distance'], FILTER_VALIDATE_INT);
$form->duration = filter_var($_POST['duration'], FILTER_SANITIZE_STRING);
$form->height_difference = filter_var($_POST['height_difference'], FILTER_VALIDATE_INT);
$form->available = filter_var($_POST['available'], FILTER_VALIDATE_INT);

$formValidator = v::attribute(
                'name', v::stringType()->notEmpty())
    ->attribute('difficulty', v::stringType()->notEmpty())
    ->attribute('distance', v::intVal()->notEmpty())
    ->attribute('duration', v::date('h:i:s')->notEmpty())
    ->attribute('height_difference', v::intVal()->notEmpty())
    ->attribute('available', v::intVal()->notEmpty());



try {
    $formValidator->assert($form);
    $stmt->execute([
        $form->name,
        $form->difficulty,
        $form->distance,
        $form->duration,
        $form->height_difference,
        $form->available,
        $id]);

    $_SESSION['flash'] = ['class' => 'success', 'message' => 'Randonnée correctement éditée'];

} catch(NestedValidationException $exception) {
    $_SESSION['flash'] = ['class' => 'error', 'message' => 'Une erreur est survenue'];
}

header('Location: index.php');

