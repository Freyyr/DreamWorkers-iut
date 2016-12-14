<?php

echo 'Details d\'une commande :';
echo '<fieldset>';
$d = htmlspecialchars($_SESSION['id']);
$p = htmlspecialchars($tableau['idCommande']);
foreach ($tableau as $cle => $valeur) {
    $v = htmlspecialchars($valeur);
    $c = htmlspecialchars($cle);
    echo <<< EOT
            $c : $v <br>
            
EOT;
}
echo <<< EOT
<a href="index.php?action=delete&contro=commande&idCommande=$p"><button type="button" onclick=>Supprimer</button></a>
EOT;
?>