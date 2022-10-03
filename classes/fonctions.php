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

function meetSelectAllIndex($idCategorie)
{

    if ($idCategorie == 7) {
        // Préparation de la requete
        $query = db()->prepare("SELECT * FROM meet INNER JOIN categorie ON meet.idCategorie = categorie.idCategorie");
        // Execution de la requete
        $query->execute();
    } else {
        $query = db()->prepare("SELECT * FROM meet INNER JOIN categorie ON meet.idCategorie = categorie.idCategorie WHERE meet.idCategorie = ? ");
        // Execution de la requete
        $query->execute([$idCategorie]);
    }

    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_OBJ);

    // Retourne le tableau avec les données
    return $recordMeet;
}

function meetSelectAllAdmin()
{
    // Préparation de la requete
    $query = db()->prepare("SELECT * FROM meet INNER JOIN categorie ON meet.idCategorie = categorie.idCategorie");
    // Execution de la requete
    $query->execute();

    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_OBJ);

    // Retourne le tableau avec les données
    return $recordMeet;
}

function removeMeet($idMeet)
{
    $query = db()->prepare("DELETE FROM meet WHERE idEvenement = ?;");

    $query->execute([$idMeet]);

    return $query;
}

function getTableById($idMeet)
{

    // Préparation de la requete
    $query = db()->prepare("SELECT * FROM meet WHERE idEvenement=?");

    // Execution de la requete
    $query->execute([$idMeet]);

    // Récuperation des données s'il y en a
    $record = $query->fetch(PDO::FETCH_OBJ);

    return $record;
}

function modifierMeetById($id, $titre, $nbParticipantsMax, $idCategorie, $adresse, $date)
{
    $message = "";
    if ($titre !== "" && is_numeric($nbParticipantsMax) && $idCategorie !== "" && $adresse !== "") {
        $sql = "UPDATE meet SET titre = :titre, partcipantsMax = :nbParticipantsMax, idCategorie = :idCategorie, adresse = :adresse, date = :date where idEvenement = :id";

        $query = db()->prepare($sql);

        $query->execute([":id" => $id, ":titre" => $titre, ":nbParticipantsMax" => $nbParticipantsMax, ":idCategorie" => $idCategorie, ":adresse" => $adresse, ":date" => $date]);

        return $message;
    }
    else {
        $message = "Veuillez verifier tous les champs";
        return $message;
    }
}
