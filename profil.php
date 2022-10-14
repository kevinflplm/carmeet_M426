<?php

//Session Start
session_start();

// Appel de la connexion à la bdd
require_once "modele/fonctions.php";

$modify = filter_input(INPUT_GET, 'modify', FILTER_VALIDATE_INT);
$btnModif = filter_input(INPUT_POST, 'modifProfil', FILTER_SANITIZE_STRING);

$Inscriptions = getInscriprtion($_SESSION['id']);

$nbInscription = count($Inscriptions);

$pseudo = strtoupper($_SESSION['pseudo']);

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

  include("vue/header.php");

  ?>

  <main class="profil-main">
    <div class="profil-content">
      <div class="profil-img">
        <div class="avatar">
          <img src="img/avatars/<?= $_SESSION['pdp']?>">
        </div>
        <div class="profil-name">
          <h2><?= $pseudo ?></h2>
        </div>
      </div>
      <div class="profil-details">
        <div class="profil-list" id="scroll">
          <h2><i class="fa-solid fa-calendar-days"></i> Mes inscriptions</h2>
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
                  <a href="controler/desinscription.php?id=<?= $value->idEvenement ?>" class="btn-desinscrire">Se désinscrire</a>
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
              <form method="post" enctype="multipart/form-data" action="../controler/modifProfil.php">
                <div class="modify-item">
                  <label>Pseudo :
                    <input type="text" value="<?= $_SESSION['pseudo'] ?>" name="pseudoModif">
                  </label>
                </div><br>
                <div class="modify-item">
                  <label>Email :
                    <input type="email" value="<?= $_SESSION['email'] ?>" name="emailModif">
                  </label>
                </div><br>
                <div class="modify-item">
                  <label>
                    Photo de profil :
                    <input type="file" name="avatar">
                  </label>
                </div>
                <div class="btns-modify">
                  <input type="submit" value="Sauvegarder les modifications" class="btn-sauv" name="modifProfil">
                  <a href="profil.php?modify=0" class="btn-annuler">Annuler les modifications</a>
                </div>
              </form>
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