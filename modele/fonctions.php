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
 * Function qui ajoute un meet
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

/**
 * Function qui supprime un meet
 * @param L'id d'un meeting
 * @return Query delete
 */
function removeMeet($idMeet)
{
    $query = db()->prepare("DELETE FROM meet WHERE idEvenement = ?;");

    $query->execute([$idMeet]);

    return $query;
}

/**
 * Function qui récupère les meets via leur ID
 * @param L'id d'un meeting
 * @return recrods de la base de données
 */
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

/**
 * Function qui modifie un meet
 * @param Titre, Nombres de Participants maximum, Categorie, Adresse, Date
 * @return Un messages null, Un message d'erreur
 */
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

/**
 * Function qui récupère les catégorie
 * @param 
 * @return Toutes les catégories
 */
function getCategorie() {

    $queryGenre = db()->prepare("SELECT * FROM categorie");

    $queryGenre->execute();

    // Récuperation des données s'il y en a 
    $record = $queryGenre->fetchAll(PDO::FETCH_OBJ);

    return $record;
}

/**
 * Function qui récupère un meet selon son ID
 * @param l'id du meet
 * @return Les infos du meet
 */
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

/**
 * Function qui compte le nombre d'évènements
 * @param
 * @return Le nombre de meet
 */
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

/**
 * Function qui récupère les prochains évènements
 * @param 
 * @return Les prochains meetings
 */
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

/**
 * Function qui inscrit une personne
 * @param l'id du meet, l'id de l'utilisateur
 * @return
 */
function inscriptionMeet($idEvenement, $idUser) {
        $query = db()->prepare("INSERT INTO inscription(idEvenement, idUser) VALUES (?, ?)");
        // Execution de la requete
        $query->execute([$idEvenement, $idUser]);
}

/**
 * Function qui récupère les inscriptipons
 * @param 
 * @return L'utilisateur inscrit
 */
function getInfosIncription() {
    // Préparation de la requete
    $query = db()->prepare("SELECT * FROM inscription");
    // Execution de la requete
    $query->execute();
    // Récuperation des données s'il y en a 
    $recordMeet = $query->fetchAll(PDO::FETCH_OBJ);
    // Retourne le tableau avec les données
    return $recordMeet;
}

function verifInscription($idEvenement, $idUser) {
    $tableInscription = getInfosIncription();

    foreach ($tableInscription as $value) {
        if ($idEvenement == $value->idEvenement && $idUser == $value->idUser) {
            return false;
        }
        else {
            return true;
        }
    }
}

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

function removeInscription($idMeet, $idUser) {

    $query = db()->prepare("DELETE FROM inscription WHERE idEvenement = ? AND idUser = ?");

    $query->execute([$idMeet, $idUser]);

    return $query;
}

/**
 * Function qui modifie un profil
 * @param Un pseudo, un email, une photo de profil, l'id de l'utilisateur
 * @return L'utilisateur inscrit
 */
function updateProfil($pseudo, $email, $idUser, $pdp) {
    
    $query = db()->prepare("UPDATE users SET Pseudo = ?, Email = ?, photoProfil = ? WHERE idUser = ?");

    $query->execute([$pseudo, $email, $pdp, $idUser]);

}

/**
 * Function qui récupère les info d'un utilisateur
 * @param l'id de l'utilisateur
 * @return Les infos de l'utilisateur
 */
function getInfoUser($idUser) {

    $query = db()->prepare("SELECT * FrOM users WHERE idUser = ?");

    $query->execute([$idUser]);

    $recordUser = $query->fetchAll(PDO::FETCH_OBJ);

    return $recordUser;
}

/**
 * Function qui vérifie si l'utilisateur est inscrits ou pas
 * @param l'id du meet, l'id de l'utilisateur
 * @return L'utilisateur inscrit
 */
function verifDejaInscrit($idMeet, $idUser) {
    $query = db()->prepare("SELECT * FROM inscription WHERE idEvenement = ? AND idUser = ?");

    $query->execute([$idMeet, $idUser]);

    $recordUser = $query->fetchAll(PDO::FETCH_OBJ);

    return $recordUser;
}

/**
 * Function qui récupère toutes les inscriptions
 * @param l'id du meet
 * @return Toutes les inscriptions
 */
function getAllInscription($idMeet) {

    $query = db()->prepare("SELECT * FROM inscription INNER JOIN users ON inscription.idUser = users.idUser WHERE idEvenement = ? ");

    $query->execute([$idMeet]);

    $recordInscription = $query->fetchAll(PDO::FETCH_OBJ);

    return $recordInscription;
}