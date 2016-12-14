
<?php

if (Session::is_admin()) {
    echo '<h1 id="listeTitre">Liste des clients :</h1>';
    echo "<div id='liste'>";
    foreach ($tab_v as $v) {
        $vgetidClientHTML = htmlspecialchars($v->getidClient());
        $vgetidClientURL = urlencode($v->getidClient());
        $vgetnomClient = htmlspecialchars($v->getnomClient());
        $vgetprenomClient = htmlspecialchars($v->getprenomClient());
        echo <<< EOT
        <fieldset>
        <div>
        <br>
        Id :
        <a href="index.php?action=read&contro=client&idClient=$vgetidClientURL">$vgetidClientHTML</a>
        <p> Nom : $vgetnomClient </p>
        <p> Prenom :  $vgetprenomClient </p>
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
        