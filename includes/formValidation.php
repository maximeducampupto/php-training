<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15-Jan-19
 * Time: 1:16 PM
 */

$name = isset($_POST['name']) ? $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING) : null;
$difficulty = isset($_POST['difficulty']) ? $difficulty = filter_var($_POST['difficulty'], FILTER_SANITIZE_STRING) : null;
$distance = isset($_POST['distance']) ? $distance = filter_var($_POST['distance'], FILTER_SANITIZE_NUMBER_INT) : null;
$duration = validateDuration($_POST['duration']);
$height_difference = isset($_POST['height_difference']) ? $height_difference = filter_var($_POST['height_difference'], FILTER_SANITIZE_NUMBER_INT) : null;
$available = isset($_POST['available']) ? filter_var($_POST['available'], FILTER_SANITIZE_NUMBER_INT) : null;
