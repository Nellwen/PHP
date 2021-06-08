<?php

class ViewFestivals {

    public function __construct(){

    }

    

    public function afficherListeFestivals($data)
    {
        $page = "Festivals/template/departement.html";
        include "template/template.html";
    }

    public function afficherPage($page) {
        $page = "Festivals/template/{$page}.html";
        include "template/template.html";
    }
    
}
