<?php 
session_start();

require_once "../modele/fonctions.php";

$idMeet = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
$idParticipant = filter_input(INPUT_GET, 'idUser', FILTER_VALIDATE_INT);

removeInscription($idMeet, $idParticipant);

header("Location: ../meetdetails.php?meet=" .$idMeet);