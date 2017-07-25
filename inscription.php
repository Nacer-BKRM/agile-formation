<?php

    require 'database/Database.php';

    $pdo = \cyberagile\Database::getInstance();

    $sql = $pdo->prepare("SELECT * FROM users");

    $sql->execute();

    $qr = $sql->fetchAll(PDO::FETCH_ASSOC);

    var_dump($qr);

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

<?php include 'partials/navbar.php' ?>

<div class="container" style="margin-top: 75px;">
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
            <button class="btn btn-primary" type="submit">Inscription</button>
        </div>
    </form>
</div>

<script src="web/dependancies/jquery/dist/jquery.min.js"></script>
<script src="web/dependancies/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>