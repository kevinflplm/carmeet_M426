<?php
session_start();

require_once("../classes/fonctions.php");

$pseudo = filter_input(INPUT_GET, 'pseudo', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);

updateProfil($pseudo, $email, $_SESSION['id']);
$info = getInfoUser($_SESSION['id']);

foreach ($info as $value) {
    $_SESSION['pseudo'] = $value->Pseudo;
    $_SESSION['email'] = $value->Email;
}

header("Location: ../profil.php");
// if ($message == "") {
//     header("Location: ../profil.php");
// }
