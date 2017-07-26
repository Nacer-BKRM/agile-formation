<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 26/07/2017
 * Time: 10:27
 */

$errors = [];

renderView(
    'adminHome',
    [
        'pageTitle' => 'Administration',
        'errors' => $errors
    ]
);