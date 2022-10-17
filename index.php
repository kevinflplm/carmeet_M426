<?php

// //Session Start
session_start();

// Appel de la connexion à la bdd
require_once "modele/fonctions.php";

$infosNextFiveMeet = nextFiveCarMeet();

if (!empty($_SESSION["id"])) {


?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projet</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/carousel.css">
    </head>

    <body>
        <?php

        include("vue/header.php");

        ?>
        <div class="banner">
            <h2>Bienvenue <?= $_SESSION['pseudo'] ?> sur Car-Meet Switzerland</h2>
            <img src="img/swiss.png" width="70px" height="70px">
        </div>
        <main>
            <h1 class="title">📅 • 𝑷𝒓𝒐𝒄𝒉𝒂𝒊𝒏𝒔 𝒆́𝒗𝒆̀𝒏𝒆𝒎𝒆𝒏𝒕𝒔 • 🔥</h1>
            <section id="slider">
                <input type="radio" name="slider" id="s1" checked>
                <input type="radio" name="slider" id="s2">
                <input type="radio" name="slider" id="s3">
                <input type="radio" name="slider" id="s4">
                <input type="radio" name="slider" id="s5">
                <?php
                $count = 1;
                foreach ($infosNextFiveMeet as $meet) {
                ?>
                    <label for="s<?= $count ?>" id="slide<?= $count ?>">
                        <div class="card-caroussel">
                            <img src='img/cover/<?= $meet->idCategorie ?>.jpg' alt='' style='width:100%; height: 269px;'>
                            <div class="container-list">
                                <h4 style="font-size: large; margin-bottom: 25px;"><b><?= $meet->titre ?></b></h4>
                                <div class="container-info">
                                    <p>Adresse : <?= $meet->adresse ?></p>
                                    <?php 
                                    $newDate = date("d M Y", strtotime($meet->date));
                                    ?>
                                    <p>Date : <?= $newDate ?></p>
                                    <p>Participants max : <?= $meet->partcipantsMax ?></p>
                                </div>
                                <a href="meetdetails.php?meet=<?= $meet->idEvenement ?>" class="btn-carousel" style="margin-top: 25px;">Voir Plus</a>
                            </div>
                        </div>
                    </label>
                    <?php
                    $count++;
                    ?>
                <?php }
                ?>
            </section>
        </main>
        <?php
        include("vue/footer.html");
        ?>
        <script src="js/script.js"></script>
        <script src="https://kit.fontawesome.com/4b95889e0a.js" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
}
?>