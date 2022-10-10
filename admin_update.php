<?php
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

$idMeet = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$meet = getTableById($idMeet);
$message = "";


$titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
$participantsMax = filter_input(INPUT_POST, "participantsMax", FILTER_SANITIZE_STRING);
$idCategorie = filter_input(INPUT_POST, "categorie", FILTER_SANITIZE_STRING);
$adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING);

$buttonModifier = filter_input(INPUT_POST, "btnModify", FILTER_DEFAULT);

if ($buttonModifier == "Modifier") {
    modifierMeetById($idMeet, $titre, $participantsMax, $idCategorie, $adresse, $date);
    $message = modifierMeetById($idMeet, $titre, $participantsMax, $idCategorie, $adresse, $date);
    if ($message == "") {
        header("Location: adminpage.php");
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            color: white;
        }
    </style>
</head>

<body>
    <?php

    include("modele/header.php");

    ?>
    <main class="add-main">
        <div class="add-form">
            <form method="post" enctype="multipart/form-data">
                <h1>Modifier</h1>
                <div class="form-addItem">
                    <label>
                        Titre :
                        <input type="text" name="titre" class="add-item" value="<?= $meet->titre ?>">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Participants Max :
                        <input type="number" name="participantsMax" class="add-item" value="<?= $meet->partcipantsMax ?>">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Catégorie :
                        <select name="categorie" id="categorie" class="add-item">
                            <option value="1" <?= ($meet->idCategorie === 1) ? "selected" : "" ?>>Sportive</option>
                            <option value="2" <?= ($meet->idCategorie === 2) ? "selected" : "" ?>>Supersportive</option>
                            <option value="3" <?= ($meet->idCategorie === 3) ? "selected" : "" ?>>Muscles Car</option>
                            <option value="4" <?= ($meet->idCategorie === 4) ? "selected" : "" ?>>JDM</option>
                            <option value="5" <?= ($meet->idCategorie === 5) ? "selected" : "" ?>>SUV</option>
                            <option value="6" <?= ($meet->idCategorie === 6) ? "selected" : "" ?>>Classique 90s</option>
                        </select>
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Adresse :
                        <input type="texte" name="adresse" class="add-item" value="<?= $meet->adresse ?>">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Date :
                        <input type="date" name="date" class="add-item" value="<?= $meet->date ?>" placeholder="Utilisez le format yyyy-mm-dd">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <input type="submit" name="btnModify" class="btn-add" value="Modifier">
                </div>
                <?php
                if ($message != "") {
                    echo $message;
                }
                ?>
            </form>
        </div>
    </main>
    <?php
    include("modele/footer.html");
    ?>
</body>

</html>