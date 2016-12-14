<?php

class Panier {

    public static function addPanier($idProduit) {
        if (isset($_SESSION['panier'])) {
            $panier = unserialize($_SESSION['panier']);
            array_push($panier, $idProduit);
            $_SESSION['panier'] = serialize($panier);
        } else {
            $panier = array($idProduit);
            $_SESSION['panier'] = serialize($panier);
        }
    }

    public static function totalPanier() {
        if (isset($_SESSION['panier'])) {
            $total = 0;
            $panier = unserialize($_SESSION['panier']);
            foreach ($panier as $cle) {
                $p = ModelProduit::select($cle);
                $total = $total + $p['prixProduit'];
            }
            return $total;
        } else {
            return 0;
        }
    }

    public static function deleteAllPanier() {
        if (isset($_SESSION['panier'])) {
            unset($_SESSION['panier']);
        }
    }

    public static function deleteProduitPanier($idProduit) {
        if (isset($_SESSION['panier'])) {
            $panier = unserialize($_SESSION['panier']);
            $newPanier = array();
            $del = false;
            foreach ($panier as $cle) {
                if ($cle == $idProduit && $del == false) {
                    $del = true;
                } else {
                    array_push($newPanier, $cle);
                }
            }
            if (count($newPanier) == 0) {
                unset($_SESSION['panier']);
            } else {
                $_SESSION['panier'] = serialize($newPanier);
            }
        }
    }

}
?>

