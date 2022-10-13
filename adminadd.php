<?php

session_start();

// Appel de la connexion à la bdd
require_once "modele/fonctions.php";

$message = "";
$output = "";

$nomMeet = filter_input(INPUT_POST, 'nomMeet', FILTER_SANITIZE_STRING);
$categorie = filter_input(INPUT_POST, 'categorie', FILTER_VALIDATE_INT);
$nbPartMax = filter_input(INPUT_POST, 'nbParticipants', FILTER_VALIDATE_INT);
$adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$btnAdd = filter_input(INPUT_POST, 'btnAdd', FILTER_SANITIZE_STRING);

if (isset($btnAdd)) {
    $message = addMeet($nomMeet, $nbPartMax, $categorie, $adresse, $date);
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
    <title>Document</title>
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

    include("vue/header.php");

    ?>
    <main class="add-main">
        
        <div class="add-form">
            <form method="post" enctype="multipart/form-data">
                <h1>Ajouter un meet</h1>
                <div class="form-addItem">
                    <label>
                        Nom du meet :
                        <input type="text" name="nomMeet" class="add-item">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Catégorie :
                        <select name="categorie" class="add-item">
                            <option value="1">Sportives</option>
                            <option value="2">Supersportives</option>
                            <option value="3">Muscles Car</option>
                            <option value="4">JDM</option>
                            <option value="5">SUV</option>
                            <option value="6">Classique 90s</option>
                        </select>
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Participants Max :
                        <input type="number" name="nbParticipants" class="add-item">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Adresse :
                        <input type="text" name="adresse" class="add-item">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Date :
                        <input type="date" name="date" class="add-item">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <input type="submit" name="btnAdd" class="btn-add" value="Ajouter">
                </div>
                <?php
                if ($message != "") {

                    $output .= "<div class=\"alert-admin\">";
                    $output .= "<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>";
                    $output .= "<strong>Erreur !</strong> " . $message;
                    $output .= "</div>";

                    echo $output;
                }
                ?>
                <a href="adminpage.php"><i class="fa-solid fa-angles-left"></i> Revenire à la page admin</a>
            </form>
        </div>
    </main>
    <?php
    include("vue/footer.html");
    ?>
</body>

</html>