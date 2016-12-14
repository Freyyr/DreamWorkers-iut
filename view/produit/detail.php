
<?php

echo '<h2 id="listeTitre">Details du produit :</h2>';
echo '<div id="liste">';
echo '<fieldset>';
if (isset($_SESSION['id'])) {
    $d = htmlspecialchars($_SESSION['id']);
    $p = htmlspecialchars($tableau['idProduit']);
}
foreach ($tableau as $cle => $valeur) {
    $v = htmlspecialchars($valeur);
    $c = htmlspecialchars($cle);
    echo <<< EOT
            $c : $v <br>
            
EOT;
}
if (isset($_SESSION['id']) && Session::is_user($d)) {
    echo <<< EOT
    <a href="?action=ajouterPanier&contro=client&idClient=$d&idProduit=$p"><button type="button" onclick=>Ajouter au panier</button></a>
EOT;
} else {
    echo "<p>Inscrivez vous pour commander un produit</p>";
}
if (Session::is_admin()) {
    echo <<< EOT
    <a href="?action=delete&contro=produit&idProduit=$p"><button type="button" onclick=>Supprimer ce produit</button></a>
EOT;
}
echo "</fieldset>";
echo "</div>"
?> 
