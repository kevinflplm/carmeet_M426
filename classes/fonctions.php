<?php
require_once "config.php";

function db()
{
    static $db = null;

    if ($db === null) {
        $dbString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
        $db = new PDO($dbString, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    return $db;
}

function meetSelectAllAdmin() {
    // Préparation de la requete
    $query = db()->prepare("SELECT * FROM meet INNER JOIN categorie ON meet.idCategorie = categorie.idCategorie");
    // Execution de la requete
    $query->execute();

    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_OBJ);

    // Retourne le tableau avec les données
    return $recordMeet;
}

function removeMeet($idMeet) {
    $query = db()->prepare("DELETE FROM meet WHERE idEvenement = ?;");

    $query->execute([$idMeet]);

    return $query;
}

