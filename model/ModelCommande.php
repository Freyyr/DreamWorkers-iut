<?php

class ModelCommande extends Model {

    private $idCommande;
    private $dateCommande;
    private $idClient;
    private $montantCommande;
    protected static $primary = "idCommande";
    protected static $object = "Commande";

    function __construct($idCommande = null, $dateCommande = null, $idClient = null, $montantCommand = null) {
        if (!is_null($idCommande) && !is_null($dateCommande) && !is_null($idClient) && !is_null($montantCommand)) {
            $this->idCommande = $idCommande;
            $this->dateCommande = $dateCommande;
            $this->idClient = $idClient;
            $this->montantCommande = $montantCommande;
        }
    }

    function getIdCommande() {
        return $this->idCommande;
    }

    function getDateCommande() {
        return $this->dateCommande;
    }

    function getIdClient() {
        return $this->idClient;
    }

    function getMontantCommande() {
        return $this->montantCommande;
    }

    function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    function setDateCommande($dateCommande) {
        $this->dateCommande = $dateCommande;
    }

    function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    function setMontantCommande($montantCommande) {
        $this->montantCommande = $montantCommande;
    }

    static function getHistoCommande($idClient) {
        $tab_name = ucfirst(static::$object);
        $class_name = "Model$tab_name";
        $tab_name = $tab_name . 's';
        $sql = "SELECT * FROM $tab_name WHERE idClient=:idtag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("idtag" => $idClient);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_name = $req_prep->fetchAll();
        return $tab_name;
    }

}

?>