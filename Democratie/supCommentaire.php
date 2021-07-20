<?php

require_once 'BDD/db-connect.inc.php';
session_start();

//verifier la session est bien ouverte
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    //sinon on renvoie a index.php?info=notlogged
    header('Location: index.php?info=notlogged');
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["id"])) {
    
    //Préparation de la requête
    $query = $db->prepare(
        "DELETE FROM commentaires WHERE id_commentaire = :id_commentaire"
    );
    //var_dump($query);
    //Renomme les clés pour les lier aux paramètres (ajoute le ":" devant le nom des champs)
    $data = [
        ':id_commentaire' => $_GET["idcom"]
    ];
    
    //var_dump($data);

    //Execute la requete avec le tableau validé ET bindé
    $result = $query->execute($data);
    //var_dump($result);

    if ($result) {
        header("Location: voirProposition.php?id={$_GET["id"]}&vote={$_GET["vote"]}&info=commentSupp");
    } else {
       header("Location: voirProposition.php?id={$_GET["id"]}&vote={$_GET["vote"]}&info=commentNoSupp");
    }
}
