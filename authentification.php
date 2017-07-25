
<?php
/**
 * Created by PhpStorm.
 * User: E4gleKnight
 * Date: 25/07/2017
 * Time: 09:47
 */

require 'database.php';
session_start();


//Initialisation des erreurs
$errors=[];



//Récupération des données
$email = filter_input(INPUT_POST,"login",FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);

$isSubmitted = filter_has_var(INPUT_POST,"submit");

if ($isSubmitted){
    //Validation des données
    if (empty ($email)){
        $errors[]= "Vous devez saisir votre identifiant";
    }
    if (empty($password)){
        $errors[]="Vous devez saisir un mot de passe";
    }

    //Traitement des données
    //S'il n'y a pas d'erreurs
    if (count($errors)==0) {

        //Connexion à la base de données pour vérifier l'authentification
        $connexion = database::getInstance();
        $query = $connexion->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', sha1($password), PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

    }
        if ($result) {
            $temp = $result['prenom'] . " " . $result['nom'];
            $_SESSION['user'] = $temp;
            $role = $result['role'];
            if($role == 'ADMIN'){
                header("location:pageadmin.php");
                exit();
            }else{
                header("location:pageuser.php");
                exit();
            }
        } else {
            echo "Erreur";
        }
    }


if (count($errors)>0):?>
<div class= "alert alert-danger">
    <ul>
        <?php foreach ($errors as $item) : ?>
        <li><?=$item?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif;?>


        <form method="post">
            <div class="form-group" >
                <label>Votre identifiant</label>
                <input type="email" name="login" class ="form-control">
            </div>
            <div class ="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class = "form-control">
            </div>
            <div class="form-group">
                 <button type="submit" name="submit" class="btn">Valider</button>
            </div>
        </form>


