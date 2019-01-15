<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15-Jan-19
 * Time: 1:14 PM
 */

function validateDuration($duration)
{
    if (isset($duration) and !is_null($duration))
    {
        $fduration = filter_var($duration, FILTER_SANITIZE_STRING);
        $reg = '/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/';

        return preg_match($reg, $duration) ? $fduration : null;
    } else {
        return null;
    }
}

function requireWith($path, $variables)
{
    extract($variables);
    require $path;
}