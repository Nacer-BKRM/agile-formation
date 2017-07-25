<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 25/07/2017
 * Time: 16:12
 */

$pdo = getPDO();

$errors = [];
$isSubmitted = filter_has_var(INPUT_POST, 'submit');
if ($isSubmitted) {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = "";
    if ($_POST['password'] == $_POST['confirm']) {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    } else {
        $errors[] = "Les mots de passe doivent correspondre";
    }
    $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
    $sexe = $_POST['sexe'];
    $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);
    $voie = filter_input(INPUT_POST, 'voie', FILTER_SANITIZE_STRING);
    $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
    $codePostal = filter_input(INPUT_POST, 'codepostal', FILTER_SANITIZE_STRING);
    $pays = filter_input(INPUT_POST, 'pays', FILTER_SANITIZE_STRING);
    if (empty($nom)) {
        $errors[] = "Vous devez saisir un nom";
    }
    if (empty($prenom)) {
        $errors[] = "Vous devez saisir un prénom";
    }
    if (empty($email)) {
        $errors[] = "Vous devez saisir un email";
    }
    if (empty($password)) {
        $errors[] = "Vous devez saisir un mot de passe";
    }
    if (empty($telephone)) {
        $errors[] = "Vous devez saisir un numéro de téléphone";
    }
    if (empty($sexe)) {
        $errors[] = "Vous devez sélectionner un sexe";
    }
    if (empty($numero)) {
        $errors[] = "Vous devez saisir un numéro de voie";
    }
    if (empty($voie)) {
        $errors[] = "Vous devez saisir un nom de voie";
    }
    if (empty($ville)) {
        $errors[] = "Vous devez saisir une ville";
    }
    if (empty($codePostal)) {
        $errors[] = "Vous devez saisir un code postal";
    }
    if (empty($pays)) {
        $errors[] = "Vous devez saisir un pays";
    }
    if (empty($errors)) {

        $pdo->beginTransaction();
        $sql = $pdo->prepare("INSERT INTO users (nom, prenom, email, password, telephone, sexe, role) VALUES (:nom, :prenom, :email, :password, :telephone, :sexe, :role)");
        $passcrypt = sha1($password);
        $role = "USER";
        $sql->bindParam(':nom', $nom);
        $sql->bindParam(':prenom', $prenom);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $passcrypt);
        $sql->bindParam(':telephone', $telephone);
        $sql->bindParam(':sexe', $sexe);
        $sql->bindParam(':role', $role);
        try {
            $sql->execute();
            $lastInsertId = $pdo->lastInsertId();
        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = "Erreur lors de l'enregistrement de l'utilisateur";
        }
        $sql = $pdo->prepare("INSERT INTO adresses (numero, voie, ville, cp, pays, id_user) VALUES (:numero, :voie, :ville, :cp, :pays, :id_user)");
        $sql->bindParam(':numero', $numero);
        $sql->bindParam(':voie', $voie);
        $sql->bindParam(':ville', $ville);
        $sql->bindParam(':cp', $codePostal);
        $sql->bindParam(':pays', $pays);
        $sql->bindParam(':id_user', $lastInsertId);
        try {
            $sql->execute();
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = "Erreur lors de l'enregistrement de l'adresse";
        }
        $_SESSION['flash'] = "Vous êtes maintenant inscrit";
        header('Location: /index.php?controller=computerHome');
        exit();
    }
}


renderView(
    'inscription',
    [
        'pageTitle' => 'Inscription'
    ]
);