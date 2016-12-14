<?php

class ControllerDefault {

    public function erreur() {
        $controller = 'default';
        $view = 'erreur'; //Faire la vue create pour Commande
        $pagetitle = 'erreur';
        require File::build_path(array('view', 'view.php'));
    }
    public function accueil(){
        $controller = 'default';
        $view = 'accueil';
        $pagetitle = 'accueil';
        require File::build_path(array('view', 'view.php'));
    }
}

?>
