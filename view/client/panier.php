<?php

echo '<h1>Contenu actuel de votre panier :</h1>';
if (isset($_SESSION['panier'])) {
    $tab_panier = unserialize($_SESSION['panier']);
    $MontantTotal = Panier::totalPanier();
    foreach ($tab_panier as $v) {
        $p = ModelProduit::select($v);
        $vgetidProduitHTML = htmlspecialchars($p['idProduit']);
        $vgetidProduitURL = urlencode($p['idProduit']);
        $vgetnomProduitHTML = htmlspecialchars($p['nomProduit']);
        $vgetprixProduitHTML = htmlspecialchars($p['prixProduit']);
        $date = htmlspecialchars(date("Y-m-d"));
        $totalPanierHTML = htmlspecialchars(Panier::totalPanier());
        echo <<< EOT
        <fieldset>
        <div>
        <br>
        Id :
        <a href="index.php?action=read&contro=produit&idProduit=$vgetidProduitURL">$vgetidProduitHTML</a>
        <p> Nom : $vgetnomProduitHTML </p>
        <p> Prix :  $vgetprixProduitHTML </p>
                <a href="index.php?action=suppProdPanier&contro=client&idProduit=$vgetidProduitHTML"><button type="button" onclick=>Supprimer</button></a>
        </fieldset>
        <a href=""></a>
EOT;
    }
    echo <<< EOT
    <a href="index.php?action=viderPanier&contro=client"><button type="button" onclick=>Vider le panier</button></a>
    <a href="index.php?action=created&contro=commande&dateCommande=$date&idClient=$_SESSION[id]&montantCommande=$totalPanierHTML"><button type="button" onclick=>Commander</button></a>
        </div>
    <br>
    <h2>Montant total de la commande = $MontantTotal</h2>
EOT;
} else {
    echo '<h3 id="panierVide">Votre Panier est vide</h3>';
}
