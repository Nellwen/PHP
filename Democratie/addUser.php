<?php

require_once 'BDD/db-connect.inc.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Préparation de la requête insert 
    $query = $db->prepare(
        "INSERT INTO users (id_user, pseudo, mdp, email, actif) 
                    VALUES (NULL, :pseudo, :mdp, :email, 0);"
    );
    //var_dump($query);

    //On détermine les règles de validation pour chaque champ du formulaire
    $submitForm = [
        'pseudo' => FILTER_SANITIZE_STRING,
        'mdp' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_EMAIL
    ];

    //var_dump($args);
    //On envoit le tableau des input à la fonction filter_input_array(), qui nous retourne un nouveau tableau
    $inputs = filter_input_array(INPUT_POST, $submitForm);
    //var_dump($inputs);
    //on hash le mdp
    $inputs['mdp'] = password_hash($inputs['mdp'], PASSWORD_DEFAULT);
    //var_dump($inputs);

    //Renomme les clés pour les lier aux paramètres (ajoute le ":" devant le nom des champs)
    $data = [];
    foreach ($inputs as $key => $value) {
        $data[":$key"] = $value;  //first_name devient :first_name
    }

    //var_dump($data);

    //Execute la requete avec le tableau validé ET bindé
    $result = $query->execute($data);
    //var_dump($result);

    if ($result) {
        //TODO envoyer mail
        $message = "Bonjour {$inputs['pseudo']}.</br>
                Merci de cliquer sur ce lien pour valider votre compte : <a href=http://exojulien.test/Democratie/validation.php?name={$inputs['pseudo']}&hash={$inputs['mdp']}>Ici</a>";
        $mailUser = $inputs["email"];
        $sujet = "Validation de votre compte Democratie 2.0";
        $headers = "From: \"Democratie2.0\"<democratie@yopmail.com>\n";
        $headers .= "Reply-To: democratie@yopmail.com\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";

        mail($mailUser, $sujet, $message, $headers);

        //on repasse sur index.php
        header("Location: index.php?info=singinOk");
    } else {
        header("Location: index.php?info=singinNoOk");
    }
}
