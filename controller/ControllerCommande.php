<?php

require_once File::build_path(array('model', 'Model.php'));
require_once File::build_path(array('model', 'ModelCommande.php'));

class ControllerCommande {

    public function readAll() {
        $tableau = ModelCommande::selectAll();
        $controller = 'commande';
        $view = 'list';
        $pagetitle = 'Liste des Commandes';
        require File::build_path(array('view', 'view.php'));
    }

    public function read() {
        $tableau = ModelCommande::select($_GET['idCommande']);
        $controller = 'commande';
        $view = 'detail';
        $pagetitle = 'Details commande';
        ModelCommande::select($_GET["idCommande"]);
        require_once File::build_path(array('view', 'view.php'));
    }

    public function delete() {
        ModelCommande::delete($_GET["idCommande"]);
        $controller = 'commande';
        $view = 'deleted';
        $pagetitle = 'Commande';
        require File::build_path(array('view', 'view.php'));
    }

    public static function created() {
        $tab_values = array('idCommande' => 0, 'dateCommande' => $_GET['dateCommande'], 'idClient' => $_GET['idClient'], 'montantCommande' => $_GET['montantCommande']);
        ModelCommande::save($tab_values);
        self::histoCommande();
    }
   
    public function histoCommande(){
        $tableau = ModelCommande::getHistoCommande($_GET['idClient']);
        $controller = 'commande';
        $view = 'historique';
        $pagetitle = 'Historique';
        require File::build_path(array('view', 'view.php'));
    }

}

?>