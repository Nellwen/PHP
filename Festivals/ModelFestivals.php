<?php

class ModelFestivals
{

    public function __construct()
    {
    }

    public function getDataFestivals($departement)
    {
        $url = "https://cinema-public.opendatasoft.com/api/records/1.0/search/?dataset=panorama-des-festivals&q=&facet=region&facet=domaine&facet=complement_domaine&facet=departement&facet=mois_habituel_de_debut&refine.departement=";
        $json = file_get_contents($url . $departement);
        $data = json_decode($json, true, 512, JSON_OBJECT_AS_ARRAY);
        return $data;
    }
}