<form method="post" action="index.php?contro=Client&action=connected" id="login">
    <fieldset>
        <p>
            <label for="log_id">idClient / Login :</label> <br>
            <input type="text" name="idClient" id="log_id" required/>
            <br>
            <label for="mdp_id">Password :</label> <br>
            <input type="password" name="mdp" id="mdp_id" required/>
            <br> 
            <?php
                if($connectfail == true){
                    echo '<p id="warning"> Identifiant/Mot de passe incorrect</p>';
                }
            ?>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>


