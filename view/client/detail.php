
<?php

if (isset($_SESSION['id'])) {
    if (Session::is_admin() || Session::is_user($tableau["idClient"])) {
        echo '<h2 id="listeTitre">Details d\'un client :</h2>';
        echo '<div id="liste"';
        echo '<fieldset>';
        $d = $tableau["idClient"];
        foreach ($tableau as $cle => $valeur) {
            $v = htmlspecialchars($valeur);
            $c = htmlspecialchars($cle);
            if ($cle != 'mdpClient' && $cle != 'nonce')
                echo <<< EOT
           
            $c : $v <br>
            
EOT;
        }
        echo '<br>';
        if (Session::is_user($tableau['idClient']) || Session::is_admin()) {
            echo <<< EOT
    <a href="?action=update&contro=client&idClient=$d"><button type="button" onclick=>Modifier</button></a>
    <a href="?action=delete&contro=client&idClient=$d"><button type="button" onclick=>Supprimer le compte</button></a>
    <a href="?action=histoCommande&contro=commande&idClient=$d"><button type="button" onclick=>Historique des Commandes</button></a>
    </fieldset>
    </div>               
EOT;
        }
    }
} else {
    echo "<p> Vous n'avez pas les droits pour acceder à cette page !</p>";
}
?> 