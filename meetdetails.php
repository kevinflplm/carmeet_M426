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
                    if ($nbInscrits < $info->partcipantsMax) {
                        if (count($verifInscription) == 0) { ?>
                            <a href="controler/inscriptionMeet.php?meet=<?= $meet ?>" class="btn-sauv">S'inscrire</a>
                        <?php } else { ?>
                            <p class="btn-block">Déjà inscrit</p>
                        <?php }
                    } else {
                        ?>
                        <p class="btn-block">Evènement complet !</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="meet-details">
                    <div class="meet-info">
                        <h2><i class="fa-solid fa-circle-info"></i> Informations</h2>
                        <table>
                            <tr>
                                <td>Catégorie</td>
                                <td>:</td>
                                <td><?= $info->label ?></td>
                            </tr>
                            <tr>
                                <?php
                                $newDate = date("d M Y", strtotime($info->date));
                                ?>
                                <td>Date</td>
                                <td>:</td>
                                <td><?= $newDate ?></td>
                            </tr>
                            <tr>
                                <td>Adresse</td>
                                <td>:</td>
                                <td><?= $info->adresse ?></td>
                            </tr>
                            <tr>
                                <td>Participants</td>
                                <td>:</td>
                                <td><?= $nbInscrits ?> / <?= $info->partcipantsMax ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="inscription-list" id="scroll">
                        <h2><i class="fa-solid fa-user-group"></i> Participants à cette événement</h2>
                        <?php
                        if ($nbInscrits > 0) {
                        ?>
                            <ul>
                                <?php


                                foreach ($allInscription as $value) {
                                ?>
                                    <li class="meet-item">
                                        <img src="img/avatars/<?= $value->photoProfil ?>" class="img-participant">
                                        <div>
                                            <h3><?= $value->Pseudo ?></h3>
                                        </div>
                                        <?php
                                        if ($_SESSION['role'] == "admin") {
                                        ?>
                                            <a href="controler/desinscriptionAdmin.php?id=<?= $meet ?>&idUser=<?= $value->idUser ?>" class="btn-desinscrire">Retirer le participant</a>
                                        <?php } ?>
                                    </li>
                                <?php  }
                                ?>
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
        <?php } ?>
    </main>
</body>

</html>