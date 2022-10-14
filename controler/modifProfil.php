<?php
session_start();

require_once "../modele/fonctions.php";


$pseudoModif = filter_input(INPUT_POST, 'pseudoModif', FILTER_SANITIZE_STRING);
$emailModif = filter_input(INPUT_POST, 'emailModif', FILTER_SANITIZE_EMAIL);

if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
    $tailleMax = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if ($_FILES['avatar']['size'] <= $tailleMax) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if (in_array($extensionUpload, $extensionsValides)) {
            $chemin = "../img/avatars/" . $_SESSION['id'] . "." . $extensionUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
            if ($resultat) {
                updateProfil($pseudoModif, $emailModif, $_SESSION['id'], $_SESSION['id'] . "." . $extensionUpload);
                $info = getInfoUser($_SESSION['id']);

                foreach ($info as $value) {
                    $_SESSION['pseudo'] = $value->Pseudo;
                    $_SESSION['email'] = $value->Email;
                    $_SESSION['pdp'] = $value->photoProfil;
                }

                header("Location: ../profil.php");
            } else {
                $msg = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    } else {
        $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}
