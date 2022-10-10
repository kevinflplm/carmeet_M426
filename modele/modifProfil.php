<?php
session_start();

require_once("../classes/fonctions.php");

$pseudo = filter_input(INPUT_GET, 'pseudo', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);

updateProfil($pseudo, $email, $_SESSION['id']);
$message = updateProfil($pseudo, $email, $_SESSION['id']);
// if ($message == "") {
//     header("Location: ../profil.php");
// }
