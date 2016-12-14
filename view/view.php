<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" href="stylesheet/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="navbar">
                <a href="index.php">Accueil</a>
                <a href="?contro=Produit&action=readAll">Découvrir nos produits</a>
                <?php
                if (Session::is_connected()) {
                    echo <<< EOT
                    <a href="?contro=Client&action=voirPanier">Panier</a>
EOT;
                }             
                if (Session::is_admin()) {
                    echo <<< EOT
                    <a href="?contro=Client&action=readAll">Tous les Clients</a>
                    <a href="?contro=Produit&action=create">Ajouter un Produit</a>
                    <a href="?contro=Commande&action=readAll">Toutes les commandes</a>
EOT;
                }
                if (Session::is_connected()) {
                    echo <<< EOT
              <a href="?contro=Client&action=read&idClient=$_SESSION[id]">Profil</a>
              <a href="?contro=Client&action=disconnect">Deconnexion</a>
EOT;
                } else {
                    echo <<< EOT
              <a href="?contro=Client&action=create">Inscription</a>
              <a href="?contro=Client&action=connect">Connexion</a>
EOT;
                }
                ?>
            </div>
        </header>
        <img id='logo' alt="Logo" src="img/Logo.png">
        <main>
            <div id="message">
                <?php
                if (Session::is_connected()) {
                    echo "Bienvenue $_SESSION[nom] $_SESSION[prenom]";
                } else {
                    echo "
                <h1>Enregistreur de rêve</h1>
                <div id='text'>
                <p>Fieri, inquam, Triari, nullo pacto potest, ut non dicas, quid non probes eius, a quo dissentias. quid enim me prohiberet Epicureum esse, si probarem, quae ille diceret? cum praesertim illa perdiscere ludus esset. Quam ob rem dissentientium inter se reprehensiones non sunt vituperandae, maledicta, contumeliae, tum iracundiae, contentiones concertationesque in disputando pertinaces indignae philosophia mihi videri solent.</p>
                </div>";
                }
                ?> 
            </div>
            <?php
            require_once File::build_path(array("view", $controller, "$view.php"));
            ?>
        </main>
        <footer>
            <div>
                <p>Ceci est un paragraphe du footer</p>
            </div>
            <div>
                <address>Fait le 31 Février 1540<br>dreamworkers.iut@gmail.com</address>
            </div>
            <div>
                <p>Ceci est un paragraphe du footer</p>
            </div>
            <div>
                <p>
                    <a href='https://www.facebook.com/DreamWorkers-840456772764057/?skip_nax_wizard=true'>
                        <img alt = "Facebook" id='fb'  src="img/fb.png">
                    </a>
                </p>
            </div>
            <div>
                <p>
                    <a href='https://twitter.com/IutDream'><img id='twitter' alt ="Twitter" src="img/tw.ico">
                    </a>
                </p>
            </div>
        </footer>
    </body>
 </html>
