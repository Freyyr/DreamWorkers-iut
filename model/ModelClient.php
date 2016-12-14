<?php

class ModelClient extends Model {

    private $idClient;
    private $nonce;
    private $nomClient;
    private $prenomClient;
    private $mdpClient;
    private $dateNaissanceClient;
    private $emailClient;
    protected static $primary = 'idClient';
    protected static $object = 'Client';

    function __construct($idClient = null, $nomClient = null, $prenomClient = null, $mdpClient = null, $dateNaissanceClient = null, $emailClient = null) {
        if (!is_null($idClient) && !is_null($nomClient) && !is_null($prenomClient) && !is_null($mdpClient) && !is_null($dateNaissanceClient) && !is_null($emailClient)) {
            $this->idClient = $idClient;
            $this->login = $login;
            $this->nomClient = $nomClient;
            $this->prenomClient = $prenomClient;
            $this->mdpClient = $mdpClient;
            $this->sexeClient = $sexeClient;
            $this->dateNaissanceClient = $dateNaissanceClient;
            $this->villeClient = $villeClient;
            $this->telephoneClient = $telephoneClient;
            $this->emailClient = $emailClient;
        }
    }

    function getIdClient() {
        return $this->idClient;
    }

    function getNomClient() {
        return $this->nomClient;
    }

    function getPrenomClient() {
        return $this->prenomClient;
    }

    function getMdpClient() {
        return $this->mdpClient;
    }

    function getDateNaissanceClient() {
        return $this->dateNaissanceClient;
    }

    function getEmailClient() {
        return $this->emailClient;
    }

    function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    function setNomClient($nomClient) {
        $this->nomClient = $nomClient;
    }

    function setPrenomClient($prenomClient) {
        $this->prenomClient = $prenomClient;
    }

    function setMdpClient($mdpClient) {
        $this->mdpClient = $mdpClient;
    }

    function setDateNaissanceClient($dateNaissanceClient) {
        $this->dateNaissanceClient = $dateNaissanceClient;
    }

    function setEmailClient($emailClient) {
        $this->emailClient = $emailClient;
    }

    function getAllClients() {
        $rep = Model::$pdo->query("SELECT * FROM Clients");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        $tab_client = $rep->fetchAll();
        return $tab_client;
    }

    function checkPassword($login, $mot_de_passe_chiffre) {
        $sql = "SELECT idClient, nonce FROM Clients WHERE idClient = :idtag AND mdpClient = :mdptag;";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("idtag" => $login, "mdptag" => "$mot_de_passe_chiffre");
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_ASSOC);
        $req_prep = $req_prep->fetchAll();
        if (empty($req_prep) || strcmp($req_prep[0]['nonce'], "NULL") !== 0){
            return false;
        } else {
            return true;
        }
    }

}

?>