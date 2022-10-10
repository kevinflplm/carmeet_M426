<?php

//Session Start
session_start();

// Appel de la connexion à la bdd
require_once "classes/fonctions.php";

$modify = filter_input(INPUT_GET, 'modify', FILTER_VALIDATE_INT);

$Inscriptions = getInscriprtion($_SESSION['id']);

$nbInscription = count($Inscriptions);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page profil</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php

  include("modele/header.php");

  ?>

  <main class="profil-main">
    <div class="profil-content">
      <div class="profil-img">
        <div class="avatar">
          <img src="img/profil/avatar.jpg">
        </div>
        <div class="profil-name">
          <h2>Admin</h2>
        </div>
      </div>
      <div class="profil-details">
        <div class="profil-list" id="scroll">
          <h2><i class="fa-solid fa-calendar-days"></i> Mes inscription</h2>
          <?php if ($nbInscription > 0) { ?>
            <ul>
              <?php
              foreach ($Inscriptions as $value) {
              ?>
                <li class="meet-item">
                  <img src="img/cover/<?= $value->idCategorie ?>.jpg" style="width:130px; height: 80px;">
                  <div>
                    <span><?= $value->titre ?></span><br>
                    <span><?= $value->date ?></span>
                  </div>
                  <a href="desinscription.php?id=<?= $value->idEvenement ?>" class="btn-desinscrire">Se désinscrire</a>
                </li>
              <?php }  ?>
            </ul>
          <?php } else { ?>
            <div class="not-meet">
              <h2>Vous n'êtes inscrits à aucun événement</h2>
            </div>
          <?php } ?>
        </div>
        <div class="profil-info">
          <?php
          if ($modify == 0 || $modify == null) {
          ?>
            <a href="profil.php?modify=1" class="btn-modify"><i class="fa-regular fa-pen-to-square"></i> Modifier mon profil</a>
          <?php
          } else {
          ?>
            <div class="modify-title">
              <h2>Mode Modification</h2>
            </div>
            <div class="modify-content">
              <form method="post">
                <div class="modify-item">
                  <label>Pseudo :
                    <input type="text">
                  </label>
                </div><br>
                <div class="modify-item">
                  <label>Email :
                    <input type="email">
                  </label>
                </div><br>
                <div class="modify-item">
                  <label>
                    Cover :
                    <input type="file" name="cover">
                  </label>
                </div>
              </form>
            </div>
            <div class="btns-modify">
              <a href="profil.php?modify=0" class="btn-sauv">Sauvegarder les modifications</a>
              <a href="profil.php?modify=0" class="btn-annuler">Annuler les modifications</a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>

  </main>
</body>

</html>