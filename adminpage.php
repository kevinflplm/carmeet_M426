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
                <button class="new-meet"><a href="adminadd.php">Ajouter un meet</a></button>
                <div class="table-admin">
                    <table class="admin-panel">
                        <tr class="admin-info">
                            <th>id</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Personne Max</th>
                            <th>Adresse</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        <?php foreach ($allMeets as $meet) { ?>
                            <tr>
                                <td><?= $meet->idEvenement ?></td>
                                <td><?= $meet->titre ?></td>
                                <td><?= $meet->label ?></td>
                                <td><?= $meet->partcipantsMax ?></td>
                                <td><?= $meet->adresse ?></td>
                                <td><?= $meet->date ?></td>
                                <td><a href="" class="info-meet"><i class="fa-solid fa-circle-info"></i></a><a href="admin_update.php?id=<?= $meet->idEvenement ?>" class="mod-meet"><i class="fa-solid fa-pen"></i></a><a href="delete.php?id=<?= $meet->idEvenement ?>" class="delete-meet"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("plug/footer.html");
    ?>
</body>

</html>