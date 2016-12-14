
<?php

echo '<h1>Liste des produits :</h1>';
echo "<div id='prod'>";
foreach ($tab_v as $v) {
    $vgetidProduitHTML = htmlspecialchars($v->getidProduit());
    $vgetidProduitURL = urlencode($v->getidProduit());
    $vgetPrixProduit = htmlspecialchars($v->getPrixProduit());
    $vgetNomProduit = htmlspecialchars($v->getnomProduit());
    echo <<< EOT
        <div><img id='jc' src="img/jc.jpeg">
        <br>
        idProduit:
        <a href="index.php?action=read&contro=produit&idProduit=$vgetidProduitURL">$vgetidProduitHTML</a>
        <br>
        <p> Nom du Produit : $vgetNomProduit </p>
        <br>
        <p> Prix :  $vgetPrixProduit </p>
        </div>
        
    
EOT;
}
echo "</div>";
?>
            
    