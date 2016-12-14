<?php

require_once File::build_path(array('model', 'Model.php'));
require_once File::build_path(array('model', 'ModelClient.php'));
require_once File::build_path(array('lib', 'Session.php'));
require_once File::build_path(array('lib', 'Panier.php'));

class ControllerClient {

    public function readAll() {
        $tab_v = ModelClient::selectAll();
        $controller = 'client';
        $view = 'list';
        $pagetitle = 'Liste des Clients';
        require File::build_path(array('view', 'view.php'));
    }

    public function read() {
        $tableau = ModelClient::select($_GET["idClient"]);
        $controller = 'client';
        $view = 'detail';
        $pagetitle = 'Client';
        require File::build_path(array('view', 'view.php'));
    }

    public function delete() {
        ModelClient::delete($_GET["idClient"]);
        $controller = 'client';
        $view = 'deleted';
        $pagetitle = 'Client';
        session_unset();
        session_destroy();
        require File::build_path(array('view', 'view.php'));
    }

    public function update() {
        $data = ModelClient::select($_GET['idClient']);
        $failmdp = false;
        $failmail = false;
        $fonc = 'updated';
        $controller = 'client';
        $view = 'update';
        $pagetitle = 'Mise à jour des informations du client';
        require File::build_path(array('view', 'view.php'));
    }

    public function updated() {
        $failmdp = false;
        $failmail = false;
        $controller = 'client';
        $view = 'detail';
        $pagetitle = 'Modifications effectuées';
        if ($_POST['mdp'] != $_POST['mdp2']) {
            $failmdp = true;
            $controller = 'client';
            $view = 'update';
            $fonc = 'updated';
            require_once File::build_path(array('view', 'view.php'));
        } else {
            $mdp = Security::chiffrer($_POST['mdp']);
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
                $failmail = true;
                $controller = 'client';
                $view = 'update';
                $fonc = 'updated';
                require_once File::build_path(array('view', 'view.php'));
            } else {
                $data = array('idClient' => $_POST['idClient'],
                    'nomClient' => $_POST['nom'],
                    'prenomClient' => $_POST['prenom'],
                    'mdpClient' => $mdp,
                    'dateNaissanceClient' => $_POST['dateNaissance'],
                    'emailClient' => $_POST['email'],
                    'admin' => $_POST['admin']);
                ModelClient::update($data);
                $tableau = ModelClient::select($_POST["idClient"]);
                require File::build_path(array('view', 'view.php'));
            }
        }
    }

    public function create() {
        $failmdp = false;
        $failmail = false;
        $fonc = 'created';
        $controller = 'client';
        $view = 'update';
        $pagetitle = 'Creation d\'un nouveau Client';
        require File::build_path(array('view', 'view.php'));
    }

    public function created() {
        $data = array('idClient' => $_POST['idClient'],
            'nonce' => Security::generateRandomHex(),
            'nomClient' => $_POST['nom'],
            'prenomClient' => $_POST['prenom'],
            'mdpClient' => $_POST['mdp'],
            'dateNaissanceClient' => $_POST['dateNaissance'],
            'emailClient' => $_POST['email'],
            'admin' => 0);
        $failmdp = false;
        $failmail = false;
        $controller = 'client';
        $view = 'created';
        $pagetitle = 'Creation du client';
        if ($_POST['mdp'] != $_POST['mdp2']) {
            $failmdp = true;
            $controller = 'client';
            $view = 'update';
            $fonc = 'created';
            require_once File::build_path(array('view', 'view.php'));
        } else {
            $data['mdpClient'] = Security::chiffrer($_POST['mdp']);
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
                $failmail = true;
                $controller = 'client';
                $view = 'update';
                $fonc = 'created';
                require_once File::build_path(array('view', 'view.php'));
            } else {
                $no = $data['nonce'];
                $id = $data['idClient'];
                $mail = "<!DOCTYPE html><body><a href=http://infolimon.iutmontp.univ-montp2.fr/~meghazii/eCommerce/DreamWorkers/index.php?contro=client&action=validate&idClient=$id&nonce=$no>Cliquez ici</a></body>";
                mail($data['emailClient'], 'Verification DreamWorkers', $mail);
                ModelClient::save($data);
                require_once File::build_path(array('view', 'view.php'));
            }
        }
    }

    public function connect() {
        $connectfail = false;
        $controller = 'client';
        $view = 'connect';
        $pagetitle = 'Se connecter';
        require File::build_path(array('view', 'view.php'));
    }

    public function connected() {
        $connectfail = false;
        $controller = 'client';
        $view = 'detail';
        $pagetitle = 'Details du client';
        if (ModelClient::checkPassword($_POST['idClient'], Security::chiffrer($_POST['mdp'])) == true) {
            $sql = "SELECT admin FROM Clients WHERE idClient = :idtag";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array("idtag" => $_POST['idClient']);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_ASSOC);
            $req_prep = $req_prep->fetchAll();
            if ($req_prep[0]['admin'] == 0) {
                $_SESSION['admin'] = false;
            } else {
                $_SESSION['admin'] = true;
            }
            $tableau = ModelClient::select($_POST["idClient"]);
            Session::connect($tableau['idClient'], $tableau['nomClient'], $tableau['prenomClient'], $tableau['dateNaissanceClient'], $tableau['emailClient']);
            require File::build_path(array('view', 'view.php'));
        } else {
            $connectfail = true;
            $view = 'connect';
            $pagetitle = 'Se connecter';
            require_once File::build_path(array('view', 'view.php'));
        }
    }

    public function validate() {
        $sql = "SELECT idClient, nonce FROM Clients WHERE idClient = :idtag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("idtag" => $_GET['idClient']);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_ASSOC);
        $req_prep = $req_prep->fetchAll();
        var_dump($req_prep);
        if (empty($req_prep[0]) || $req_prep[0]['nonce'] != $_GET['nonce']) {
            echo 'error';
        } else {
            $sql = "UPDATE Clients SET nonce=\"NULL\" WHERE idClient = :idtag";
            echo $sql;
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            $controller = 'default';
            $view = 'accueil';
            $pagetitle = 'Accueil';
            require File::build_path(array('view','view.php'));
        }
    }

    public function disconnect() {
        session_unset();
        session_destroy();
        $controller = 'default';
        $view = 'accueil';
        $pagetitle = 'Accueil';
        $message = 'Vous avez bien été déconnecté';
        require File::build_path(array('view', 'view.php'));
    }

    public function ajouterPanier() {
        Panier::addPanier($_GET['idProduit']);
        $controller = 'client';
        $view = 'panier';
        $pagetitle = 'Panier';
        require File::build_path(array('view', 'view.php'));
    }

    public function viderPanier() {
        Panier::deleteAllPanier();
        $controller = 'client';
        $view = 'panier';
        $pagetitle = 'Panier';
        require File::build_path(array('view', 'view.php'));
    }

    public function getTotalPanier() {
        Panier::totalPanier();
        $controller = 'client';
        $view = 'panier';
        $pagetitle = 'Panier';
        require File::build_path(array('view', 'view.php'));
    }

    public function suppProdPanier() {
        Panier::deleteProduitPanier($_GET['idProduit']);
        $controller = 'client';
        $view = 'panier';
        $pagetitle = 'Panier';
        require File::build_path(array('view', 'view.php'));
    }

    public function voirPanier() {
        $controller = 'client';
        $view = 'panier';
        $pagetitle = 'Panier';
        require File::build_path(array('view', 'view.php'));
    }

}

?>