<?php
require_once 'BDD/db-connect.inc.php';
require_once "notification/tableauNotificationDashbord.php";
require_once "notification/notification.php";
session_start();

//verifier la session est bien ouverte
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    //sinon on renvoie a index.php?info=notlogged
    header('Location: index.php?info=notlogged');
}


//affichage des alert
$infoMessage = filter_input(INPUT_GET, 'info');

$pseudo = $_SESSION['username'];
$id_user = $_SESSION['user_id'];

//Requete pour chercher le nombre de propostion du user
$query = $db->prepare("SELECT COUNT(*) FROM propositions WHERE id_user = :id_user"); //TO DO mettre un alias pour colonne count
$query->execute([':id_user' => $id_user]);
$proposition = $query->fetch(PDO::FETCH_ASSOC);
$nb_proposition = $proposition["COUNT(*)"];

//Requete pour aller chercher les proposition pour l'user
$queryProp = $db->prepare("SELECT * FROM propositions WHERE id_user = :id_user");
$queryProp->execute([':id_user' => $id_user]);
$allPropositionUser = $queryProp->fetchAll(PDO::FETCH_ASSOC);

//Requete pour aller chercher toutes les proposition
$queryAllProp = $db->prepare("SELECT * FROM propositions WHERE soumission = :soumission");
$queryAllProp->execute([':soumission' => 1]);
$allProposition = $queryAllProp->fetchAll(PDO::FETCH_ASSOC);

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
        <div class="row">
            <div class="col-9">
                <h1 class=" mb-4 mt-4">Bonjour <?= $pseudo ?></h1>
            </div>
            <div class="col-3">
                <a href="logout.php">Se déconnecter</a>
            </div>
        </div>
        <hr>
        <h2 class=" mb-4 mt-4">Vos propositions</h2>
        <p>Nombre de propositions : <?= $nb_proposition ?></p>
        <hr>
        <?php
        if (isset($_GET['info'])) {
            displayMessage($messages2, $_GET['info']);
        };
        ?>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Soumise au vote</th>
                        <th scope="col">Pour</th>
                        <th scope="col">Contre</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                        <th scope="col">Soummettre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allPropositionUser as $prop) {
                    ?>
                        <tr>
                            <th scope="row"><?= $prop["id_proposition"] ?></th>
                            <td><?= $prop["title"] ?></td>
                            <td style="color:<?= ($prop["soumission"]) ? "green" : "red" ?>"><?= ($prop["soumission"]) ? "oui" : "non" ?></td>
                            <td><?= $prop["nb_pour"] ?></td>
                            <td><?= $prop["nb_contre"] ?></td>
                            <td> <a href="modifProposition.php?id=<?= $prop['id_proposition'] ?>" class="btn <?= ($prop['soumission'] ? "disabled" : "") ?>" style="background-color:blueviolet; color:white">Modifier</a></td>
                            <td><a href="suppProposition.php?id=<?= $prop['id_proposition'] ?>" class="btn btn-danger <?= ($prop['soumission'] ? "disabled" : "") ?>">Supprimer</a></td>
                            <td> <a href="soumissionProposition.php?id=<?= $prop['id_proposition'] ?>" class="btn btn-warning <?= ($prop['soumission'] ? "disabled" : "") ?>">Soumettre</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="newProposition.php" class="btn btn-success">Ajouter une proposition</a>
        <h2 class=" mb-4 mt-4">Propositions soumises au vote</h2>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Déjà voté</th>
                        <th scope="col">Pour</th>
                        <th scope="col">Contre</th>
                        <th scope="col">Voir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allProposition as $propo) {
                    ?>
                        <tr>
                            <th scope="row"><?= $propo["id_proposition"] ?></th>
                            <?php
                                //Requete pour chercher le pseudo de l'user qui écrit la proposition
                                $queryUser = $db->prepare("SELECT * FROM users WHERE id_user = :id_user"); //TO DO mettre un alias pour colonne count
                                $queryUser->execute([':id_user' => $propo["id_user"]]);
                                $user = $queryUser->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <td><?= $user["pseudo"] ?></td>
                            <td><?= $propo["title"] ?></td>
                            <?php 
                                //Requete pour chercher si l'utilisateur a déjà voté ou non
                                $queryVote = $db->prepare("SELECT * FROM vote WHERE id_user = :id_user and id_proposition = :id_proposition"); //TO DO mettre un alias pour colonne count
                                $queryVote->execute([':id_user' => $id_user,
                                                    ':id_proposition' => $propo["id_proposition"]]);
                                $vote = $queryVote->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <td><?= ($vote["a_vote"]) ? "oui" : "" ?></td>
                            <td><?= $propo["nb_pour"] ?></td>
                            <td><?= $propo["nb_contre"] ?></td>
                            <td> <a href="voirProposition.php?id=<?= $propo['id_proposition'] ?>&vote=<?= $vote["a_vote"] ?>" class="btn btn-primary">Voir</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>