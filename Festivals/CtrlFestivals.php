<?php
include_once "Festivals/ViewFestivals.php";
include_once "Festivals/ModelFestivals.php";

class CtrlFestivals
{

    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new ViewFestivals();
        $this->model = new ModelFestivals();
    }

    public function getPage($page){
        $this->view->afficherPage($page);
    }

    public function getListeFestivals($departement)
    {
        $data = $this->model->getDataFestivals($departement);
        $this->view->afficherListeFestivals($data);
    }
}