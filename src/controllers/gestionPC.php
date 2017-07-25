<?php

$id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);


$connexion = getPDO();
$sql = 'UPDATE pcs SET libre=1 WHERE id_pc =:id';
$param["id"] = $id;
$stm = $connexion->prepare($sql);
$stm->execute($param);


header("location:index.php?controller=computerHome");
