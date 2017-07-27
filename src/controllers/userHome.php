<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 27/07/2017
 * Time: 09:43
 */
$pdo = getPDO();
$errors = [];
$email="icepjohn@hotmail.com";
/* recupération de la valeur de newletter */
$sql =$pdo->prepare( "select newsletter from users WHERE email=:email");
$sql->bindParam(':email', $email);
try {
    $sql->execute();
    $rs = $sql->fetch(PDO::FETCH_ASSOC);
    if (!$rs) {
        $errors[] = "L'utilisateur n'existe pas dans la base de données";
    } else {
        $newsletter = $rs['newsletter'];

    }
} catch (PDOException $e) {
    $errors[] = "Erreur de requête SQL";
}


$isSubmitted = filter_has_var(INPUT_POST, 'submit');
if ($isSubmitted) {
    // on récupere la valeur de la case si elle est cochée
    if (filter_has_var(INPUT_POST,'newsletter')){
        $newsletter='O'; // case cochée
    }else {
        $newsletter='N'; // case décochée
    }
    //on modifie la base de données
    $sql = $pdo->prepare('UPDATE users SET newsletter=:newsletter WHERE email=:email');
    $sql->bindParam(':newsletter', $newsletter);
    $sql->bindParam(':email', $email);
    try {
        $sql->execute();
        $_SESSION['flash'] = ["success" => "modification de l'abonnement à la newsletter ok"];
    } catch (PDOException $e) {
        $errors[] = "Impossible de modifier l'abonnement";
    }
}

renderView(
    'userHome',
    [
        'pageTitle' => 'User Home',
        'newsletter'=> $newsletter,
    ]
);