<?php
//Session Start
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

$allMeets = meetSelectAllAdmin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Car-Meet Switzerland | Admin Menu</title>
</head>

<body>
    <?php

    include("plug/header.php");

    ?>
    <main class="admin-main">
        <div class="container">
            <div class="product-display">
                <button class="new-film"><a href="adminadd.php">Ajouter un meet</a></button>
                <table class="admin-panel">
                    <tr class="admin-info">
                        <th>id</th>
                        <th>Titre</th>
                        <th>Personne Max</th>
                        <th>Adresse</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($allMeets as $meet) { ?>
                        <tr>
                            <td><?= $meet->idEvenement ?></td>
                            <td><?= $meet->titre ?></td>
                            <td><?= $meet->partcipantsMax ?></td>
                            <td><?= $meet->adresse ?></td>
                            <td><?= $meet->date ?></td>
                            <td><a href="delete.php?film=<?= $meet->idEvenement ?>" class="info-meet"><i class="fa-solid fa-circle-info"></i></a><a href="admin_update.php?id=<?= $meet->idEvenement ?>" class="mod-meet"><i class="fa-solid fa-pen"></i></a><a href="delete.php?film=<?= $meet->idEvenement ?>" class="delete-film"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </main>

</body>

</html>