<?php

require_once 'BDD/db-connect.inc.php';
session_start();
if (isset($_GET["id"])) {
    //Préparation de la requête
    $query = $db->prepare(
        "UPDATE propositions 
        SET soumission = :soumission
        WHERE id_proposition = :id_proposition"
    );
    //var_dump($query);
    $data = [
        ':soumission' => 1,
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
            header("Location: dashbord.php?info=soumissionOk");
        }
    } else {
        //echo "ça marche pas";
        header("Location: dashbord.php?info=soumissionNoOk");
    }
}
