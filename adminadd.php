<?php

session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

$erreur = 0;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php

    include("plug/header.php");

    ?>
    <main class="add-main">
        <div class="add-form">
            <form method="post" enctype="multipart/form-data">
                <h2>Ajouter un film</h2>
                <div class="form-addItem">
                    <label>
                        Nom du film :
                        <input type="text" name="nomFilm" class="add-item">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Descritpion :
                        <input type="text" name="description" class="add-item">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Genre :
                        <select name="genre">
                            <option value="1">Action</option>
                            <option value="2">Horreur</option>
                            <option value="3">Animation</option>
                            <option value="4">Comédie</option>
                            <option value="5">Drame</option>
                            <option value="6">Aventure</option>
                        </select>
                    </label>
                </div>
                <div class="form-addItem">
                    <label>
                        Durée (en min) :
                        <input type="number" name="duree" class="add-item   ">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Date de sortie :
                        <input type="date" name="dateSortie" class="add-item">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <label>
                        Cover :
                        <input type="file" name="cover">
                    </label>
                </div><br>
                <div class="form-addItem">
                    <br>
                    <div class="form-addItem">
                        <input type="submit" name="btnAdd" class="btn-add" value="Ajouter">
                    </div>
                </div>
                <?php
                if ($erreur == 1) {
                    echo "Veuillez remplir tous les champs !";
                }
                ?>
            </form>
        </div>
    </main>
    <?php
    include("plug/footer.html");
    ?>
</body>

</html>