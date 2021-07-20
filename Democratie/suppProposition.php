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
        "DELETE FROM propositions WHERE id_proposition = :id_proposition"
    );
    //var_dump($query);
    //Renomme les clés pour les lier aux paramètres (ajoute le ":" devant le nom des champs)
    $data = [
        ':id_proposition' => $_GET["id"]
    ];
    
    //var_dump($data);

    //Execute la requete avec le tableau validé ET bindé
    $result = $query->execute($data);
    //var_dump($result);

    if ($result) {
        header("Location: dashbord.php?info=suppPropOk");
    } else {
       header("Location: dashbord.php?info=suppPropNoOk");
    }
}
