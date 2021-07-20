<?php
// on prépare un tableau associatif avec les messages à afficher
$messages = [
    "champsVide" => [
        "title"             => "Erreur de saisie",
        "message"           => "Vous devez rentrer un Nom d'utilisateur et un Mot de passe pour vous connecter.",
        "bootstrapColor"    => "warning"
    ],

    "noMdp" => [
        "title"             => "Erreur de connexion",
        "message"           => "Nous n'avons pas réussi à vous identifier, votre Mot de passe est incorrect.",
        "bootstrapColor"    => "danger"
    ],

    "notlogged" => [
        "title"             => "Erreur de login",
        "message"           => "Vous n'êtes pas ou plus connecté.",
        "bootstrapColor"    => "warning"
    ],

    "noValidate" => [
        "title"             => "Votre compte n'est pas encore validé",
        "message"           => "Merci de regarder vos mails et de suivre le lien, afin de valider votre compte.",
        "bootstrapColor"    => "warning"
    ],
    "validate" => [
        "title"             => "Votre compte a bien été validé",
        "message"           => "Vous pouvez vous connecté à présent",
        "bootstrapColor"    => "success"
    ],
    "usernotfound" => [
        "title"             => "Erreur de connexion",
        "message"           => "Nous n'avons pas réussi à vous identifier, votre Nom d'utilisateur n'existe pas.",
        "bootstrapColor"    => "danger"
    ],
    "singinOk" => [
        "title"             => "Votre compte a bien été crée",
        "message"           => "Vous allez recevoir un e-mail de confirmation pour valider votre inscription",
        "bootstrapColor"    => "success"
    ],
    "singinNoOk" => [
        "title"             => "Erreur d'enregistrement",
        "message"           => "Nous n'avons pas réussi à vous enregistrer.",
        "bootstrapColor"    => "danger"
    ],
    "pseudoExist" => [
        "title"             => "Erreur d'enregistrement",
        "message"           => "Ce pseudo existe déjà.",
        "bootstrapColor"    => "warning"
    ],
    "emailExist" => [
        "title"             => "Erreur d'enregistrement",
        "message"           => "Cet email existe déjà.",
        "bootstrapColor"    => "danger"
    ]
];
