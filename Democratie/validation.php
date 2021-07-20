<?php 
require_once "BDD/db-connect.inc.php";
//on recupère en GET l'id et le hash et 
if(isset($_GET["name"]) && isset($_GET["hash"])){
    //on verifie on passe l'actif a 1 dans la bdd et 
    //Préparation de la requête
    $query = $db->prepare(
        "UPDATE users SET actif = :bool WHERE mdp = :mdp and pseudo = :pseudo"
    );
    $result = $query->execute(array(
        ':bool' =>          1,
        ':mdp' =>           $_GET["hash"],
        ':pseudo' =>        $_GET["name"]
    ));
    //on renvoie à la index.php?info=validate ou novalidate
    if($result){
        header("Location: index.php?info=validate");
    }else{
        header("Location: index.php?info=noValidate");
    }
}

?>