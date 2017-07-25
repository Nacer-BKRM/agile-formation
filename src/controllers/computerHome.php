<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 25/07/2017
 * Time: 09:49
 */

$connexion = getPDO();
$sql = 'SELECT * FROM pcs';
$listPC = $connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

renderView(
    'computerHome',
    [
        'pageTitle' => 'Bienvenue au Cyber Café',
        'listPC' => $listPC
    ]
);