<?php

require_once("classes/fonctions.php");

session_start();

$userId = $_SESSION["id"];
$meetIdString = filter_input(INPUT_GET, "meet", FILTER_SANITIZE_STRING);
$meetId = intval($meetIdString);


if(verifInscription($meetId, $userId)) {
    inscriptionMeet($meetId, $userId);
}

// header("location: meetdetails.php");

