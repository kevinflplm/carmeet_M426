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
            <div class="meet-content">
                <div class="meet-cover">
                    <div class="cover" style="background-image: url(img/cover/<?= $info->idCategorie?>);">
                    </div>
                    <div class="meet-title">
                        <h2><?= $info->titre ?></h2>
                    </div>
                </div>
                <div class="meet-details">
                    <div class="meet-info">
                        
                    </div>
                    <div class="inscription-list" id="scroll">
                        <h2><i class="fa-solid fa-calendar-days"></i> Participants à cette événement</h2>
                        <ul>
                            <li class="meet-item">
                                <img src="img/cover/.jpg" style="width:130px; height: 80px;">
                                <div>
                                    <span></span><br>
                                    <span></span>
                                </div>
                                <a href="controler/desinscription.php?id=" class="btn-desinscrire">Se désinscrire</a>
                            </li>
                        </ul>
                        <div class="not-meet">
                            <h2>Aucune personne inscrite à cette événement</h2>
                        </div>
                    </div>
                </div>
            </div>

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