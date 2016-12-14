<?php

require_once File::build_path(array('model', 'Model.php'));
require_once File::build_path(array('model', 'ModelProduit.php'));

class ControllerProduit {
    
    public function readAll() {
        $tab_v = ModelProduit::selectAll();
        $controller = "produit";
        $view = 'list';
        $pagetitle = 'Liste des Produits';
        require File::build_path(array('view', 'view.php'));
    }

    public function read() {
        $tableau = ModelProduit::select($_GET["idProduit"]);
        $controller = 'produit';
        $view = 'detail';
        $pagetitle = 'Produit';
        require File::build_path(array('view', 'view.php'));
    }

    public function delete() {
        ModelProduit::delete($_GET["idProduit"]);
        $controller = "produit";
        $view = 'deleted';
        $pagetitle = 'Produit';
        require File::build_path(array('view', 'view.php'));
    }
    
    public function create() {
        $controller = "produit";
        $view = 'update'; 
        $pagetitle = 'Creation d\'un nouveau Produit';
        $fonc = 'created';
        require File::build_path(array('view', 'view.php'));
    }

    public function created() {
        $tab_values = array('idProduit' => $_POST['idProduit'], 'nomProduit' => $_POST['nomProduit'], 'prixProduit' => $_POST['prixProduit']);
        ModelProduit::save($tab_values);
        self::readAll();
    }

}

?>