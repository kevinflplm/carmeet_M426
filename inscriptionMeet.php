<?php

require_once("classes/fonctions.php");

session_start();

$userId = $_SESSION["id"];
$meetIdString = filter_input(INPUT_GET, "meet", FILTER_SANITIZE_STRING);
$meetId = intval($meetIdString);

inscriptionMeet($meetId, $userId);

verifInscription();

// header("location: meetdetails.php");

