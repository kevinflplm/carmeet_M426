<?php

session_start();

require_once "modele/fonctions.php";

$meet = filter_input(INPUT_GET, 'meet', FILTER_VALIDATE_INT);
$userId = $_SESSION["id"];

$verifInscription = verifDejaInscrit($meet, $userId);

$meetById = meetSelectById($meet);

$allInscription = getAllInscription($meet);

$nbInscrits = count($allInscription);

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
                    <div class="cover" style="background-image: url(img/cover/<?= $info->idCategorie ?>);">
                    </div>
                    <div class="meet-title">
                        <h2><?= $info->titre ?></h2>
                    </div>
                    <?php
                    if (count($verifInscription) == 0) { ?>
                        <a href="controler/inscriptionMeet.php?meet=<?= $meet ?>" class="btn-sauv">S'inscrire</a>
                    <?php } else { ?>
                        <p class="btn-block">Déjà inscrit</p>
                        <!-- <a href="controler/inscriptionMeet.php?meet=<?= $meet ?>" class="btn-block">Déjà inscrit</a> -->
                    <?php }
                    ?>
                </div>
                <div class="meet-details">
                    <div class="meet-info">

                    </div>
                    <div class="inscription-list" id="scroll">
                        <h2><i class="fa-solid fa-calendar-days"></i> Participants à cette événement</h2>
                        <?php
                        if ($nbInscrits > 0) {
                        ?>
                            <ul>
                                <?php
                                if ($_SESSION['role'] == "admin") {

                                    foreach ($allInscription as $value) {
                                ?>

                                        <li class="meet-item">
                                            <img src="img/avatars/<?= $value->photoProfil ?>" style="width:130px; height: 80px;">
                                            <div>
                                                <span><?= $value->Pseudo ?></span><br>
                                                <span></span>
                                            </div>
                                            <a href="controler/desinscription.php?id=" class="btn-desinscrire">Retirer le participant</a>
                                        </li>

                                <?php  }
                                } ?>
                            </ul>
                        <?php
                        } else {
                        ?>
                            <div class="not-inscrit">
                                <h2>Aucune personne inscrite à cette événement</h2>
                            </div>
                    </div>
                <?php
                        }
                ?>
                </div>
            </div>

            <p><?= $info->titre ?></p>
            <h3>Adresse :</h3>
            <p><?= $info->adresse ?></p>
            <h3>Date :</h3>
            <p><?= $info->date ?></p>
        <?php } ?>
    </main>
</body>

</html>