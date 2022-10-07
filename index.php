<?php

// //Session Start
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

$nbCarmeet = countCarMeet();

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
        <link rel="stylesheet" href="css/test .css">
    </head>

    <body>
        <?php

        include("plug/header.php");

        ?>
        <div class="banner">
            <h2>Bienvenue <?= $_SESSION['pseudo'] ?> sur Car-Meet Switzerland</h2>
            <img src="img/swiss.png" width="70px" height="70px">
        </div>
        <main>
            <section id="slider">
                <input type="radio" name="slider" id="s1" checked>
                <input type="radio" name="slider" id="s2">
                <input type="radio" name="slider" id="s3">
                <input type="radio" name="slider" id="s4">
                <input type="radio" name="slider" id="s5">

                <label for="s1" id="slide1">
                    <div class="card-caroussel">
                        <img src="img/cover/1.jpg" alt="" style="width:100%; height: 200px;">
                        <div class="container-list">
                            <h4><b>Oue</b></h4>
                            <div class="container-info">
                                <p></p>
                                <p></p>
                                <p>0/20</p>
                                <p></p>
                            </div>
                            <button>Voir plus</button>
                        </div>
                    </div>
                </label>
                <label for="s2" id="slide2">Meet 2</label>
                <label for="s3" id="slide3">Meet 3</label>
                <label for="s4" id="slide4">Meet 4</label>
                <label for="s5" id="slide5">Meet 5</label>
            </section>
        </main>
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