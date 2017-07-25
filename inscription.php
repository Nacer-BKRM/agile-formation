<?php

    session_start();

    require 'database/Database.php';

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
            $pdo = \cyberagile\Database::getInstance();

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
            header('Location: /index.php');
            exit();
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cyber Agile - Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="web/dependancies/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="web/dependancies/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="web/css/style.css">
</head>
<body>

    <?php include 'partials/navbar.php'; ?>

<div class="container" style="margin-top: 75px;">

    <?php include 'partials/errors_flash.php'; ?>

    <h1>Inscription</h1>
    <form method="post">
        <div class="form-group">
            <input type="text" name="nom" placeholder="Nom" class="form-control">
            <input type="text" name="prenom" placeholder="Prénom" class="form-control">
            <input type="email" name="email" placeholder="Email" class="form-control">
            <input type="password" name="password" placeholder="Mot de passe" class="form-control">
            <input type="password" name="confirm" placeholder="Confirmation" class="form-control">
        </div>
        <hr>
        <div class="form-group">
            <input type="text" name="telephone" placeholder="Numéro de téléphone" class="form-control">
            <label>Homme
                <input type="radio" name="sexe" value="Homme">
            </label>
            <label>Femme
                <input type="radio" name="sexe" value="Femme">
            </label>
            <input type="number" name="numero" placeholder="Numéro de voie" class="form-control">
            <input type="text" name="voie" placeholder="Nom de la voie" class="form-control">
            <input type="text" name="ville" placeholder="Ville" class="form-control">
            <input type="text" name="codepostal" placeholder="Code postal" class="form-control">
            <input type="text" name="pays" placeholder="Pays" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" name="submit" type="submit">Inscription</button>
        </div>
    </form>
</div>

<script src="web/dependancies/jquery/dist/jquery.min.js"></script>
<script src="web/dependancies/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>