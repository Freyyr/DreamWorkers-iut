<?php

require_once File::build_path(array('config', 'Conf.php'));

class Model {

    public static $pdo;

    public static function Init() {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectAll() {
        $tab_name = ucfirst(static::$object);
        $class_name = "Model$tab_name";
        $tab_name = $tab_name . 's';
        $req_prep = Model::$pdo->query("SELECT * FROM $tab_name");
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_name = $req_prep->fetchAll();
        return $tab_name;
    }

    public static function select($primary_value) {
        $tab_name = ucfirst(static::$object);
        $class_name = "Model$tab_name";
        $tab_name = $tab_name . 's';
        $primary_key = static::$primary;
        $sql = "SELECT * FROM $tab_name WHERE " . $primary_key . "=:id;";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("id" => $primary_value);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_ASSOC);
        $req_prep = $req_prep->fetchAll();
        return $req_prep[0];
    }

    public static function delete($primary_value) {
        $primary_key = static::$primary;
        $tab_name = ucfirst(static::$object) . 's';
        $sql = "DELETE FROM " . $tab_name . " WHERE " . $primary_key . "=:id;";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("id" => $primary_value);
        $req_prep->execute($values);
    }

    public static function update($data) {
        $primary_key = static::$primary;
        $tab_name = ucfirst(static::$object) . "s";
        $sql = "UPDATE " . $tab_name . " SET ";
        foreach ($data as $cle => $valeur) {
            $sql = $sql . "$cle = '$valeur' ,";
        }
        $sql = rtrim($sql, ',');
        $sql = $sql . "WHERE $primary_key = " . $data['idClient'] . ";";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($data);
    }

    public static function save($data) {
        $primary_key = static::$primary;
        $tab_name = ucfirst(static::$object) . "s";
        $sql = "INSERT INTO $tab_name (";
        foreach ($data as $cle => $valeur) {
            $sql = $sql . "$cle,";
        }
        $sql = rtrim($sql, ',');
        $sql = $sql . ') VALUES (';
        foreach ($data as $cle => $valeur) {
            $sql = $sql . ":$cle,";
        }
        $sql = rtrim($sql, ',');
        $sql = $sql . ');';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($data);
    }

}

Model::Init();
?>
