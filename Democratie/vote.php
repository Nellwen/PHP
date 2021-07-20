<?php
require_once 'BDD/db-connect.inc.php';
session_start();

$nomCol = $_GET["col"];

if (isset($_GET["id"]) && isset($_GET["col"])) {
    //Préparation de la requête
    $queryProp = $db->prepare(
        "SELECT * FROM propositions WHERE id_proposition = :id_proposition"
    );
    $queryProp->execute([':id_proposition' => $_GET["id"]]);
    $proposition = $queryProp->fetch(PDO::FETCH_ASSOC);

    //on rajoute 1
    $nb = intval($proposition[$nomCol]) + 1;
    var_dump($nb);

    //Préparation de la requête
    $query = $db->prepare(
        "UPDATE propositions 
        SET $nomCol = :nb
        WHERE id_proposition = :id_proposition"
    );
    //var_dump($query);
    $data = [
        ':nb' => $nb,
        'id_proposition' => $_GET["id"]
    ];

    //var_dump($data);

    //Execute la requete avec le tableau validé ET bindé
    $result = $query->execute($data);
    //var_dump($result);

    if ($result) {
        //Preparaton deuxieme requete pour ajouter dans la table vote
        $query2 = $db->prepare(
            "INSERT INTO vote (id_user, id_proposition, a_vote) 
                VALUES (:id_user, :id_proposition, 1);"
        );

        $data2 = [
            ':id_user' => $_SESSION["user_id"],
            'id_proposition' => $_GET["id"]
        ];
        $result2 = $query2->execute($data2);
        if($result2){
            //echo "ok";
            header("Location: voirProposition.php?id={$_GET["id"]}&info=voteOk&vote=1");
        }else {
            //echo "ça marche pas";
            header("Location: voirProposition.php?id={$_GET["id"]}&info=voteNoOk&vote=0");
        }
    } else {
        //echo "ça marche pas";
        header("Location: voirProposition.php?id={$_GET["id"]}&info=voteNoOk&vote=0");
    }
}
