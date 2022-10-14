<?php

session_start();

require_once "modele/fonctions.php";

$meet = filter_input(INPUT_GET, 'meet', FILTER_VALIDATE_INT);
// $sinscrire = filter_input(INPUT_POST, 'sinscrire', FILTER_SANITIZE_STRING);

// if (!empty($sinscrire)) {
//     echo "1esdhfuhesofiheishfeisofh";
// }

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
        <?php } ?>
<<<<<<< Updated upstream
        <a href="controler/inscriptionMeet.php" class="btn-sauv">S'inscrire</a>
=======
        <br>
        <a href="inscriptionMeet.php?meet=<?= $meet ?>" class="btn-sauv">S'inscrire</a>
>>>>>>> Stashed changes
    </main>
</body>

</html>