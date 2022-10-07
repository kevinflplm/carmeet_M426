<?php

//Session Start
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
  <title>Page profil</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php

  include("plug/header.php");

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
          <ul>
            <li class="meet-item">
              <img src="img/profil/avatar.jpg" style="width:85px">
              <div>
                <span>Racing Meet</span><br>
                <span>22.09.2022</span>
              </div>
            </li>

            <li class="meet-item">
              <img src="img/profil/avatar.jpg" style="width:85px">
              <div>
                <span>Racing Meet</span><br>
                <span>22.09.2022</span>
              </div>
            </li>

            <li class="meet-item">
              <img src="img/profil/avatar.jpg" style="width:85px">
              <div>
                <span>Racing Meet</span><br>
                <span>22.09.2022</span>
              </div>
            </li>
            <li class="meet-item">
              <img src="img/profil/avatar.jpg" style="width:85px">
              <div>
                <span>Racing Meet</span><br>
                <span>22.09.2022</span>
              </div>
            </li>
            <li class="meet-item">
              <img src="img/profil/avatar.jpg" style="width:85px">
              <div>
                <span>Racing Meet</span><br>
                <span>22.09.2022</span>
              </div>
            </li>
          </ul>
        </div>
        <div class="profil-info">
        <a href="#" class="button"><i class="fa-regular fa-pen-to-square"></i> Modifier mon profil</a>
        </div>
      </div>
    </div>

  </main>
</body>

</html>