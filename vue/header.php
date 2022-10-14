<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <nav>
        <div class="sidebar">
            <div class="logo-details">
                <!-- <i class="fa-solid fa-hand-middle-finger icon"></i> -->
                <img src="img/logo.png" class="icon" width="100px">
                <div class="logo_name">Car-Meet</div>
                <i class="fa-solid fa-bars" id="btn"></i>

            </div>

            <ul class="nav_list">
                <!-- <li>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="search...">
                </li> -->
                <li>
                    <a href="index.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="links_name">Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="listmeet.php">
                    <i class="fa-solid fa-car-rear"></i>
                        <span class="links_name">Tous les meeting</span>
                    </a>
                </li>
                <li>
                    <a href="profil.php?modify=0">
                        <i class="fa-solid fa-user"></i>
                        <span class="links_name">Profil</span>
                    </a>
                </li>
                <?php
                if ($_SESSION['role'] == "admin") {
                ?>
                    <li>
                        <a href="adminpage.php">
                            <i class="fa-solid fa-table-columns"></i>
                            <span class="links_name">Admin Menu</span>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <div class="log-out">
                <a href="controler/destroy.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </nav>

    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/4b95889e0a.js" crossorigin="anonymous"></script>
</body>

</html>