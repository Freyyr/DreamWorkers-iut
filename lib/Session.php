<?php

class Session {

    public static function is_user($login){
        return (!empty($_SESSION['id'] && $_SESSION['id']==$login));
    }
    
    public static function is_admin() {
        return (!empty($_SESSION['admin']) && $_SESSION['admin']==1);
    }
    
    public static function connect($id, $nom,$prenom,$dateNaissance,$email) {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom']  = $prenom;
        $_SESSION['dateNaissance'] = $dateNaissance;
        $_SESSION['email'] = $email;
    }
    
    public static function is_connected() {
        return (!empty($_SESSION['connected']) && $_SESSION['connected']);
    }
    
    public static function get_nbItems(){
        return Panier::countArticles();
    }
}
