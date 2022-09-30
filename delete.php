<?php 
session_start();

require_once "classes/fonctions.php";

$idMeet = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);

removeMeet($idMeet);

header("Location: adminpage.php");