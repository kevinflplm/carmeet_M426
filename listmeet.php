<?php

//Session Start
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

$filter =  7;

$allMeets = meetSelectAllIndex($filter);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des meetings</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/test.css">
</head>

<body>
    <?php
    include("plug/header.php");
    ?>
    <div class="list-head">

    </div>
    <div class="list-meet">
        <?php foreach ($allMeets as $meet) { ?>
            <div class="card">
                <img src="img/cover/<?= $meet->idCategorie ?>.jpg" alt="" style="width:100%; height: 200px;">
                <div class="container">
                    <h4><b><?= $meet->titre ?></b></h4>
                    <div class="container-info">
                        <p><?= $meet->label ?></p>
                        <p><?= $meet->date ?></p>
                        <p>0/<?= $meet->partcipantsMax ?></p>
                        <p><?= $meet->adresse ?></p>
                    </div>
                    <button>Voir plus</button>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
    include("plug/footer.html");
    ?>
</body>

</html>