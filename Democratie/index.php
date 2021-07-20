<?php
session_start();
require_once "notification/tableauNotificationIndex.php";
require_once "notification/notification.php";

//$action = filter_input(INPUT_GET, 'info');
$infoMessage = filter_input(INPUT_GET, 'info');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>


</head>

<body>

    <div class="container">
        <h1 class="text-center mb-4 mt-4">Démocratie 2.0 </br>
            <small class="text-muted text-center">TP pour travailler PDO et PHP</small>
        </h1>


        <div class="row">
            <div class="col-6">
                <h3>Se connecter</h3>
                <form method="post" action="login.php">
                    <div class=" row mb-3">
                        <div class="col-4">
                            <label for="user" class="col-form-label">Utilisateur</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control" id="user" name="user" placeholder="Saisir votre nom d'utilisateur">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="mdp_user" class="col-form-label">Mot de passe</label>
                        </div>
                        <div class="col-7">
                            <input type="password" class="form-control" id="mdp_user" name="mdp_user" placeholder="Saisir votre mot de passe">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </form>
                <?php 
                if(isset($_GET['info'])){
                    displayMessage($messages, $_GET['info']);
                };
            ?>
            </div>
            <div class="col-6">
                <img src="images/accueil.png" class="img-fluid" alt="image vote oui non">
            </div>
        </div>
        <div class="row alert alert-dark mt-5">
            <h3>Pas encore inscrit ?</h3>
            <p class="h4"> Pour vous inscrire à notre plateforme, et avoir la chance de voter des super propositions, veuillez avant tout vous inscrire !</p>
            <form method="post" action="addUser.php">
                <div class="row">
                <div class="col-3">
                    <div class="row mb-3">
                        <div class="col-2">
                            <label for="email" class="col-form-label">Email</label>
                        </div>
                        <div class="col-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row mb-3">
                        <div class="col-2">
                            <label for="pseudo" class="col-form-label">Pseudo</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="votrepseudo">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row mb-3 g-0">
                        <div class="col-4 ">
                            <label for="mdp" class="col-form-label">Mot de passe</label>
                        </div>
                        <div class="col-8 g-0">
                            <input type="password" class="form-control" id="mdp" name="mdp">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
                </div>
            </form>
                
            <hr class="mb-3 mt-3">
            <p>Pour  voir les spécifications techniques, rendez-vous sur <a href="https://webboy.fr/formation/course/view.php?id=161">sur la page PDO</a> dans le Moodle.</p>
        </div>

    </div>


</body>

</html>