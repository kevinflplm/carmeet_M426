<?php 
session_start();

require_once "../modele/fonctions.php";

$idMeet = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);

removeMeet($idMeet);

header("Location: ../adminpage.php");