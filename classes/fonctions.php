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

/**
 * @param Categorie
 * @return Enregistrement selon la catégorie
 */
function meetSelectByCategorie($idCategorie)
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

/**
 * @param
 * @return Tous les meetings enregistré dans la base de données
 */
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

/**
 * Function qui ajoute un film
 * @param Titre, Nombres de Participants maximum, Categorie, Adresse, Date
 * @return Un messages null, Un message d'erreur
 */
function addMeet($titre, $nbPartMax, $categorie, $adresse, $date)
{
    $message = "";
    if (!empty($titre) && !empty($adresse) && !empty($categorie) && is_numeric($categorie) && !empty($nbPartMax) && is_numeric($nbPartMax)) {
        $query = db()->prepare("INSERT INTO meet(titre, partcipantsMax, idCategorie, adresse, date) VALUES (?, ?, ?, ?, ?)");

        // Execution de la requete
        $query->execute([$titre, $nbPartMax, $categorie, $adresse, $date]);

        return $message;
    } else {
        $message = "Veuillez verifier tous les champs";
        return $message;
    }
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

// Fonction qui récupère les catégorie
function getCategorie() {

    $queryGenre = db()->prepare("SELECT * FROM categorie");

    $queryGenre->execute();

    // Récuperation des données s'il y en a 
    $record = $queryGenre->fetchAll(PDO::FETCH_OBJ);

    return $record;
}

function meetSelectById($idMeet) {

    // Préparation de la requete
    $query = db()->prepare("SELECT * FROM meet INNER JOIN categorie ON meet.idCategorie = categorie.idCategorie WHERE idEvenement = ?");
    // Execution de la requete
    $query->execute([$idMeet]);

    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_OBJ);

    // Retourne le tableau avec les données
    return $recordMeet;

}

function countCarMeet() {
    // Préparation de la requete
    $query = db()->prepare("SELECT idEvenement FROM meet");
    // Execution de la requete
    $query->execute();
    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_ASSOC);
    // Retourne le tableau avec les données
    $nombremeet = count($recordMeet);
    return $nombremeet;
}

function nextFiveCarMeet() {
    // Préparation de la requete
    $query = db()->prepare("SELECT * from meet order by `date`  ASC LIMIT 5;");
    // Execution de la requete
    $query->execute();
    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_OBJ);
    // Retourne le tableau avec les données
    return $recordMeet;
}

function inscriptionMeet($idEvenement, $idUser) {
        $query = db()->prepare("INSERT INTO inscription(idEvenement, idUser) VALUES (?, ?)");
        // Execution de la requete
        $query->execute([$idEvenement, $idUser]);
}

function getInfosIncription() {
    // Préparation de la requete
    $query = db()->prepare("SELECT * FROM inscription");
    // Execution de la requete
    $query->execute();
    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_ASSOC);
    // Retourne le tableau avec les données
    return $recordMeet;
}

// $idEvenement $idUser
function verifInscription() {
    $tableInscription = getInfosIncription();

    foreach ($tableInscription as $key => $value) {
        foreach ($value as $key2 => $value2) {
            
        }
    }
    var_dump($value2);
    

function getInscriprtion($idUser) {

    // Préparation de la requete
    $query = db()->prepare("SELECT * FROM inscription INNER JOIN meet ON inscription.idEvenement = meet.idEvenement WHERE idUser = ?");
    // Execution de la requete
    $query->execute([$idUser]);
    // Récuperation des données s'il y en a 
    $recordInscription = $query->fetchAll(PDO::FETCH_OBJ);
    // Retourne le tableau avec les données
    
    return $recordInscription;
}