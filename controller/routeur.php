<?php

require_once File::build_path(array('controller', 'ControllerClient.php'));
require_once File::build_path(array('controller', 'ControllerCommande.php'));
require_once File::build_path(array('controller', 'ControllerProduit.php'));
require_once File::build_path(array('controller', 'ControllerDefault.php'));

if (isset($_GET['contro'])) {
    $contro = ucfirst($_GET['contro']);
    $table = $contro;
    $controller = "Controller" . $table;
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if (class_exists($controller)) {
            if (in_array($action, get_class_methods($controller))) {
                $controller::$action();
            } else {
                ControllerDefault::erreur();
            }
        } else {
            ControllerDefault::erreur();
        }
    } else if (isset($_POST['contro'])) {
        $contro = ucfirst($_POST['contro']);
        $table = $contro;
    } else {
        ControllerDefault::erreur();
    }
} else {
    ControllerDefault::accueil();
}
?>
