<?php
require_once 'BDD/db-connect.inc.php';

session_start();

//si il existe on envoie sur le dashbord avec une session et mdp hash enregistré
//sinon on renvoie sur l index avec usernotfound

//on verifie en post le pseudo et le mdp
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = filter_input(INPUT_POST, 'user');
    $password = filter_input(INPUT_POST, 'mdp_user');

    if ($pseudo != "" && $password != "") {
        //si existe on fait la requete
        $query = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
        $query->execute([':pseudo' => $pseudo]);
        $userOk = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($userOk == false) {
            header('Location: index.php?info=usernotfound'); //Envoi d'information en get à la page index pour les messages d'erreurs
        } elseif(!password_verify($password, $userOk["mdp"])){
            header('Location: index.php?info=noMdp');
        }elseif($userOk["actif"] == false){
            header('Location: index.php?info=noValidate');
        }else {
            $_SESSION['username'] = $userOk["pseudo"];
            $_SESSION['user_id'] =$userOk["id_user"];
            $_SESSION['logged'] = true;
            $_SESSION['log_timestamp'] = time();
            $_SESSION['ip_client'] = $_SERVER['REMOTE_ADDR'];
            header('Location: dashbord.php'); //Redirection vers la page du dashbord
        }
        
    } else {
        header('Location: index.php?info=champsVide');
    }
}else{
    header('Location: index.php?info=notlogged');
}
   