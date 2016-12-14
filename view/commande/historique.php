
<?php

echo '<h1 id="listeTitre">Historique des Commandes :</h1>';
echo "<div id='liste'>";
if (!empty($tableau)) {
    foreach ($tableau as $v) {
        $vgetidCommandeHTML = htmlspecialchars($v->getIdCommande());
        $vgetidCommandeURL = urlencode($v->getIdCommande());
        $vgetDateCommande = htmlspecialchars($v->getDateCommande());
        $vgetIdClientHTML = htmlspecialchars($v->getIdClient());
        $vgetIdClientURL = urlencode($v->getIdClient());
        $vgetMontantCommande = htmlspecialchars($v->getMontantCommande());
        echo <<< EOT
        <fieldset>
        <div>
        <br>
        IdCommande :
        <a href="index.php?action=read&contro=Commande&idCommande=$vgetidCommandeURL">$vgetidCommandeHTML</a>
        <br><br>
        idClient :
        <a href="index.php?action=read&contro=Client&idClient=$vgetIdClientURL">$vgetIdClientHTML</a>
        <p> Montant:  $vgetMontantCommande </p>
        <p> Date : $vgetDateCommande </p>
        </div>
        </fieldset>
    
EOT;
    }
} else {
    echo 'Aucune Commande pour le moment.';
}
echo "</div>";
?>
        