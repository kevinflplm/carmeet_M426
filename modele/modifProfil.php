<?php
session_start();

require_once("../classes/fonctions.php");

$pseudo = filter_input(INPUT_GET, 'pseudo', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
$pdp = filter_input(INPUT_GET, 'pdp', FILTER_SANITIZE_STRING);

updateProfil($pseudo, $email, $_SESSION['id'], $pdp);
$info = getInfoUser($_SESSION['id']);

foreach ($info as $value) {
    $_SESSION['pseudo'] = $value->Pseudo;
    $_SESSION['email'] = $value->Email;
    $_SESSION['pdp'] = $value->photoProfil;
}

header("Location: ../profil.php");