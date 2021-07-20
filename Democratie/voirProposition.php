<?php
require_once 'BDD/db-connect.inc.php';
require_once "notification/tableauNotificationProp.php";
require_once "notification/notification.php";
session_start();

//verifier la session est bien ouverte
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    //sinon on renvoie a index.php?info=notlogged
    header('Location: index.php?info=notlogged');
}
//affichage des alert
$infoMessage = filter_input(INPUT_GET, 'info');

//Requete pour aller chercher la proposition
$query = $db->prepare("SELECT * FROM propositions WHERE id_proposition = :id_proposition");
$query->execute([':id_proposition' => $_GET["id"]]);
$proposition = $query->fetch(PDO::FETCH_ASSOC);

//Requete pour aller chercher les commentare de la proposition
$queryCommentaire = $db->prepare("SELECT * FROM commentaires WHERE id_proposition = :id_proposition");
$queryCommentaire->execute([':id_proposition' => $_GET["id"]]);
$commentaires = $queryCommentaire->fetchAll(PDO::FETCH_ASSOC);


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

    <div class="container p-4">
        <a href="dashbord.php" class="" style="color:blueviolet">Retourner au tableau de bord</a>
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <h3 class="text-muted">Proposition n°<?= $_GET["id"] ?></h3>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $proposition["title"] ?></h5>
                <div class="card-text">
                    <p><?= $proposition["text_proposition"] ?></p>
                    <ul>
                        <li>Pour : <?= $proposition["nb_pour"] ?></li>
                        <li>Pour : <?= $proposition["nb_contre"] ?></li>
                    </ul>
                </div>
                <div class="row  d-flex justify-content-start">
                    <div class="col-2">
                        <a href="vote.php?id=<?= $_GET["id"] ?>&col=nb_pour" class="btn btn-success <?= ($_GET["vote"]) ? "disabled" : "" ?>">Voter Pour</a>
                    </div>
                    <div class="col-2">
                        <a href="vote.php?id=<?= $_GET["id"] ?>&col=nb_contre" class="btn btn-danger <?= ($_GET["vote"]) ? "disabled" : "" ?>">Voter contre</a>
                    </div>
                    <?php if (isset($_GET["vote"])) { ?>
                        <p><?= ($_GET["vote"]) ? "Vous avez déjà voté" : "" ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['info'])) {
            displayMessage($messages3, $_GET['info']);
        };
        ?>
        <hr>
        <form method="post" action="addComment.php?id=<?= $_GET["id"] ?>&vote=<?= $_GET["vote"] ?>">
            <legend>Ajouter un commentaire</legend>
            <div class="row">
                <div class="col-10">
                    <div class="input-group">
                        <span class="input-group-text">Rajouter un commentaire</span>
                        <textarea class="form-control" aria-label="With textarea" name="text_commentaire"></textarea>
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn mb-3 mt-3" style="background-color: blueviolet; color:white">Publier</button>
                </div>
            </div>
        </form>
        <hr>
        <h2>Liste des commentaires</h2>
        <?php foreach ($commentaires as $com) { ?>
            <div class="card m-4">
                <div class="card-header">
                    <?= $com["jour"] ?>
                </div>
                <div class="card-body">
                    <?php
                        //Requete pour chercher le pseudo de l'user qui écrit le commentaire
                        $queryUser = $db->prepare("SELECT * FROM users WHERE id_user = :id_user");
                        $queryUser->execute([':id_user' => $com["id_user"]]);
                        $user = $queryUser->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <h5 class="card-title"><?= $user["pseudo"] ?></h5>
                    <p class="card-text"><?= $com["text_commentaire"] ?></p>
                    <?php if ($com["id_user"] == $_SESSION["user_id"]) { ?>
                        <a href="supCommentaire.php?id=<?= $_GET["id"] ?>&vote=<?= $_GET["vote"] ?>&idcom=<?= $com["id_commentaire"] ?>" style="color: red;">Supprimer ce commentaire</a>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>
    </div>


</body>

</html>