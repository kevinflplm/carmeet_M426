<?php

//Session Start
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

$filter = filter_input(INPUT_POST, 'filter', FILTER_VALIDATE_INT);

if ($filter == null) {
    $filter =  7;
}

$allCategorie = getCategorie();
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
</head>

<body>
    <?php
    include("plug/header.php");
    ?>
    <main class="main-list">
        <div class="list-head">
            <h2>Liste de tous les meetings</h2>
        </div>
        <div class="list-filter">
            <form method="POST">
                Filtrer :
                <select name="filter">
                    <?php foreach ($allCategorie as $categorie) { ?>
                        <option value="<?= $categorie->idCategorie ?>" <?= ($categorie->label === "Tous") ? "cheked" : "" ?>><?= $categorie->label ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Filtrer">
            </form>
        </div>
        <div class="list-meet">
            <?php foreach ($allMeets as $meet) { ?>
                <div class="card">
                    <img src="img/cover/<?= $meet->idCategorie ?>.jpg" alt="" style="width:100%; height: 200px;">
                    <div class="container-list">
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
    </main>
    <?php
    include("plug/footer.html");
    ?>
</body>

</html>