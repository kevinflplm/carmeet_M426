<?php

session_start();

require_once "modele/fonctions.php";

$meet = filter_input(INPUT_GET, 'meet', FILTER_VALIDATE_INT);
$userId = $_SESSION["id"];

$verifInscription = verifDejaInscrit($meet, $userId);

$meetById = meetSelectById($meet);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/carousel.css">
    <style>
        .meet-main {
            margin-left: 200px;
        }
    </style>
</head>

<body>
    <?php
    include("vue/header.php");
    ?>
    <main class="meet-main">
        <?php foreach ($meetById as $info) { ?>
            <p><?= $info->titre ?></p>
            <h3>Adresse :</h3>
            <p><?= $info->adresse ?></p>
            <h3>Date :</h3>
            <p><?= $info->date ?></p>
        <?php } ?>
        <br>
        <?php
        if (count($verifInscription) == 0) { ?>
            <a href="controler/inscriptionMeet.php?meet=<?= $meet ?>" class="btn-sauv">S'inscrire</a>
        <?php } else { ?>
            <a href="controler/inscriptionMeet.php?meet=<?= $meet ?>" style="pointer-events: none" class="btn-sauv">Déjà inscrit</a>
        <?php }
        ?>
    </main>
</body>

</html>