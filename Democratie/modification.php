<?php 

require_once 'BDD/db-connect.inc.php';

if (isset($_GET["id"])) {
    //Préparation de la requête
    $query = $db->prepare(
        "UPDATE propositions 
        SET title = :title, 
            text_proposition = :text_proposition 
        WHERE id_proposition = :id_proposition"
    );
    //var_dump($query);
    $data = [
        ':title' => $_POST["title"],
        ':text_proposition' => $_POST["text_proposition"],
        ':id_proposition' => $_GET["id"]
    ];
    
    //var_dump($data);

    //Execute la requete avec le tableau validé ET bindé
    $result = $query->execute($data);
    //var_dump($result);

    if ($result) {
        //echo "ok";
        header("Location: dashbord.php?info=modifPropOk");
    } else {
        //echo "ça marche pas";
       header("Location: dashbord.php?info=modifPropNoOk");
    }
}

?>