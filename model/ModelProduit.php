<?php

class ModelProduit extends Model {

    private $idProduit;
    private $nomProduit;
    private $prixProduit;
    protected static $primary = "idProduit";
    protected static $object = "Produit";

    function __construct($idProduit = NULL, $nomProduit = NULL, $prixProduit = NULL) {
        if (!is_null($idProduit) && !is_null($nomProduit) && !is_null($prixProduit)) {
            $this->idProduit = $idProduit;
            $this->nomProduit = $nomProduit;
            $this->prixProduit = $prixProduit;
        }
    }

    function getIdProduit() {
        return $this->idProduit;
    }

    function getNomProduit() {
        return $this->nomProduit;
    }

    function getPrixProduit() {
        return $this->prixProduit;
    }

    function setIdProduit($idProduit) {
        $this->idProduit = $idProduit;
    }

    function setNomProduit($nomProduit) {
        $this->nomProduit = $nomProduit;
    }

    function setPrixProduit($prixProduit) {
        $this->prixProduit = $prixProduit;
    }
}
?>