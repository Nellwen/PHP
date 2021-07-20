<?php

require_once 'BDD/db-connect.inc.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Préparation de la requête
    $query = $db->prepare(
        "INSERT INTO propositions (id_proposition, id_user, title, text_proposition, soumission, nb_pour, nb_contre) 
    VALUES (NULL, :id_user, :title, :text_proposition, 0, 1, 0);"
    );
    //var_dump($query);

    //On détermine les règles de validation pour chaque champ du formulaire
    $submitForm = [
        'title' => FILTER_SANITIZE_STRING,
        'text_proposition' => FILTER_SANITIZE_STRING,
    ];
    //On envoit le tableau des input à la fonction filter_input_array(), qui nous retourne un nouveau tableau
    $inputs = filter_input_array(INPUT_POST, $submitForm);
    //var_dump($inputs);

    //Renomme les clés pour les lier aux paramètres (ajoute le ":" devant le nom des champs)
    $data = [];
    $data[':id_user'] = $_SESSION['user_id'];
    foreach ($inputs as $key => $value) {
        $data[":$key"] = $value;  
    }
    
    
    var_dump($data);

    //Execute la requete avec le tableau validé ET bindé
    $result = $query->execute($data);
    //var_dump($result);

    if ($result) {
        header("Location: dashbord.php?info=propcreated");
    } else {
       header("Location: dashbord.php?info=propNocreated");
    }

}
