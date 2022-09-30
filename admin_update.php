<?php
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";


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

   include("plug/header.php");

   ?>
   <main class="add-main">
      <div class="add-form">
         <form method="post" enctype="multipart/form-data">
            <h2>Modifier</h2>
            <div class="form-addItem">
               <label>
                  Nom du film :
                  <input type="text" name="nomFilm" class="add-item" value="<?= $film->Titre ?>">
               </label>
            </div><br>
            <div class="form-addItem">
               <label>
                  Descritpion :
                  <input type="text" name="description" class="add-item" value="<?= $film->Description ?>">
               </label>
            </div><br>
            <div class="form-addItem">
               <label>
                  Catégorie :
                  <!-- <select name="genre">
                     <option value="1" <?= ($film->idGenre === 1) ? "selected" : "" ?>>Action</option>
                     <option value="2" <?= ($film->idGenre === 2) ? "selected" : "" ?>>Horreur</option>
                     <option value="3" <?= ($film->idGenre === 3) ? "selected" : "" ?>>Animation</option>
                     <option value="4" <?= ($film->idGenre === 4) ? "selected" : "" ?>>Comédie</option>
                     <option value="5" <?= ($film->idGenre === 5) ? "selected" : "" ?>>Drame</option>
                     <option value="6" <?= ($film->idGenre === 6) ? "selected" : "" ?>>Aventure</option>
                  </select> -->
               </label>
            </div>
            <div class="form-addItem">
               <label>
                  Durée (en min) :
                  <input type="number" name="duree" class="add-item" value="<?= $film->duree ?>">
               </label>
            </div><br>
            <div class="form-addItem">
               <label>
                  Date de sortie :
                  <input type="date" name="dateSortie" class="add-item" value="<?= $film->DateSortie ?>">
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
                  <input type="submit" name="btnModify" class="btn-add" value="Modifier">
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