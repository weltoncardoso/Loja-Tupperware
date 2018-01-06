<?php
Class homeController extends controller {

    public function __construct() {
        parent::__construct();

        $adm = new admins();
        if($adm->isLogged() == false) {
        	header("Location: /lojatupperware/painel/login");
        }
    }

    public function index() {
        $dados = array();

        $this->loadTemplate('home', $dados);
    }

}