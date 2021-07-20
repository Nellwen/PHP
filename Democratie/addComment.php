<?php

require_once 'BDD/db-connect.inc.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Préparation de la requête
    $query = $db->prepare(
        "INSERT INTO commentaires (id_commentaire, id_user, id_proposition, text_commentaire, jour) 
    VALUES (NULL, :id_user, :id_proposition, :text_commentaire, :jour)"
    );
    //var_dump($query);

    //On détermine les règles de validation pour chaque champ du formulaire
    $submitForm = [
        'text_commentaire' => FILTER_SANITIZE_STRING,
    ];
    //On envoit le tableau des input à la fonction filter_input_array(), qui nous retourne un nouveau tableau
    $inputs = filter_input_array(INPUT_POST, $submitForm);
    //var_dump($inputs);

    //date et heure
    setlocale(LC_ALL, 'fr_FR');
    date_default_timezone_set('Europe/Paris');
    $dt = utf8_encode(strftime('Le %A %d %B %Y, %H:%M:%S'));

    
    $data = [];
    $data[':id_user'] = $_SESSION['user_id'];
    $data[':id_proposition'] = $_GET["id"];
    //Renomme les clés pour les lier aux paramètres (ajoute le ":" devant le nom des champs)
    foreach ($inputs as $key => $value) {
        $data[":$key"] = $value;
    }
    $data[':jour'] = $dt;


    //var_dump($data);

    //Execute la requete avec le tableau validé ET bindé
    $result = $query->execute($data);
    //var_dump($result);

    if ($result) {
       // echo "ok";
        header("Location: voirProposition.php?id={$_GET["id"]}&vote={$_GET["vote"]}&info=commentAjout"); 
    } else {
        //echo "marche pas";
        header("Location: voirProposition.php?id={$_GET["id"]}&vote={$_GET["vote"]}&info=commentNoAjout");
    }
}
