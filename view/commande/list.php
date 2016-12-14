
<?php

if (Session::is_admin()) {
    echo '<h1 id="listeTitre">Liste des Commandes:</h1>';
    echo "<div id='liste'>";
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
        Identifiant de la commande :
        <a href="index.php?action=read&contro=client&idCommande=$vgetidCommandeURL">$vgetidCommandeHTML</a><br>
        Identifiant du client :        
        <a href="index.php?action=read&contro=client&idClient=$vgetIdClientURL">$vgetIdClientHTML</a>
        </div>
        </fieldset>
        <br>
    
EOT;
    }
    echo "</div>";
} else {
    echo "<p>Vous n'avez pas les droits pour acceder à cette page ! </p>";
}
?>
        