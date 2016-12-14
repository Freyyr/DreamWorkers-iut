<?php
echo <<< EOT
        <div id="inscription">
        <form method="post" action="index.php?contro=Client&action=$fonc">
EOT;
?>
<input type="hidden" name="contro" value="Client"/>
<fieldset>
    <legend>Entrez les informations nécessaires :</legend>
    <p>
    <div id="containerInscription">
        <label for="id_client">Identifiant :</label> 
        <?php
        if ($fonc == 'updated') {
            echo <<< EOT
                <input type="readonly" name="idClient" id="clie_id" value= "$data[idClient]" required/>
EOT;
        } else if ($failmdp == true || $failmail == true) {
            echo <<< EOT
                <input type="text" name="idClient" id="clie_id" value= "$data[idClient]" required/>
EOT;
        } else {
            echo <<< EOT
                <input type="text" name="idClient" id="clie_id" required/>
EOT;
        }
        ?>
        <br>

        <label for = "nom_id">Nom :</label> 
        <input type = "text" name = "nom" id = "nom_id"
        <?php
        if ($fonc == 'updated' || $failmdp == true || $failmail == true) {
            echo <<< EOT
                value= "$data[nomClient]"
EOT;
        }
        ?> required/>
        <br>

        <label for = "pren_id">Prenom :</label> 
        <input type = "text"name = "prenom" id = "pren_id" 
        <?php
        if ($fonc == 'updated' || $failmdp == true || $failmail == true) {
            echo <<< EOT
                value= "$data[prenomClient]"
EOT;
        }
        ?> required/>
        <br>

        <label for = "date_id">Date de naissance :</label> 
        <input type = "date" name = "dateNaissance" id = "date_id"
        <?php
        if ($fonc == 'updated' || $failmdp == true || $failmail == true) {
            echo <<< EOT
                value= "$data[dateNaissanceClient]"
EOT;
        }
        ?> required/>
        <br>

        <label for = "email_id">Email :</label> 
        <input type = "email" name = "email" id = "email_id"
        <?php
        if ($failmail == true) {
            echo <<< EOT
                required/>
                <span id='warning'>Email incorrect</span>
EOT;
        } else if ($fonc == 'updated' || $failmdp == true) {
            echo <<< EOT
                
            value= "$data[emailClient]" required/>
EOT;
        } else {
            echo <<< EOT
                required/>
EOT;
        }
        ?>
               <br>
        <label for = "mdp">Mot de passe :</label> 
        <input type = "password" name = "mdp" id = "mdp_id" required/> 
        <label for = "mdp2">Confirmation :</label> 
        <input type = "password" name = "mdp2" id = "mdp2_id" required/>
        <?php
        if ($failmdp == true) {
            echo "<span id='warning'>Mots de passe incohérent </span><br>";
        }
        if ($fonc == 'updated' && Session::is_admin()) {
            echo <<< EOT
            <br>
                <label for = "choix1">Administrateur</label> :
                <input type="hidden" name="admin" value="0" />
                <input type="checkbox" name="admin" value="1">
EOT;
        }
        ?>
    </div>
    </p>
    <p>
        <input type = "submit" value = "Envoyer" />
    </p>
</fieldset>
</form>
</div>

