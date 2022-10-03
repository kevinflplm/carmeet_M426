<?php

//Session Start
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

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
        <link rel="stylesheet" href="css/test.css">
    </head>

    <body>
        <?php

        include("plug/header.php");

        ?>
        <div class="banner">
            <h2>Bienvenue <?= $_SESSION['pseudo'] ?> sur Car-Meet Switzerland</h2>
            <img src="img/swiss.png" width="70px" height="70px">
        </div>
        <?php
        include("plug/footer.html");
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