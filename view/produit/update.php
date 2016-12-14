<?php
echo <<< EOT
        <div id="Création d'un produit">
        <form method="post" action="index.php?contro=Produit&action=$fonc">
EOT;
?>
<input type="hidden" name="contro" value="Produit"/>
<div id="liste">
<fieldset>
    <legend>Entrez les informations nécessaires :</legend>
    <p>

        <label for="id_Produit">Identifiant</label>
        <input type='text' name = "idProduit" id = "id_Produit" required/>
        <br>

        <label for = "nom_id">Nom du produit</label> :
        <input type = "text" name = "nomProduit" id = "nom_id" required/>
        <br>

        <label for = "prix">Prix</label> :
        <input type = "text" name = "prixProduit" id = "prix" required/>

    </p>
    <p>
        <input type = "submit" value = "Envoyer" />
    </p>
   </form>
</fieldset>
</div>


