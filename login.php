<?php
/////////////////////////////////////////////////////////
//Nom : Filipe Almeida 
//Prénom : Kevin
//Date : 22.12.2021
//Projet : SneakersFy (Projet perso atelier application)
//Details : Page de connexion
/////////////////////////////////////////////////////////

session_start();

require_once('classes/fonctions.php');

$output = "";

if (isset($_POST['formConnect'])) {

    $pseudoconnect = htmlspecialchars($_POST['pseudoConnect']);
    $passwordconnect = filter_input(INPUT_POST, 'passwordConnect', FILTER_SANITIZE_STRING);

    if (!empty($pseudoconnect) && !empty($passwordconnect)) {

        $reqpass = db()->prepare("SELECT * FROM users WHERE pseudo = ?");
        $reqpass->execute([$pseudoconnect]);
        $pass = $reqpass->fetch(PDO::FETCH_OBJ);
        
        if (password_verify($passwordconnect, $pass->Password)) {  
            $_SESSION['id'] = $pass->idUser;
            $_SESSION['pseudo'] = $pass->Pseudo;
            $_SESSION['email'] = $pass->Email;

            header("Location:index.php");
        } else {
            $erreur = "Pseudo ou mot de passe incorrect !";
        }
    } else {
        $erreur = "Tous les champs doivent être compléter !";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car-Meet Switzerland | Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <main class="main-login">
        <div class="login-info">
            <p><i class="fa-solid fa-newspaper"></i><span>Rejoignez</span> la plus grande communauté automobile suisse</p>
            <p><i class="fa-solid fa-star"></i><span>Accédez</span> à la plus large séléction de catégories automobiles.</p>
            <p><i class="fa-solid fa-crosshairs"></i><span>Soyez</span> le premier à être informé des nouveautés.</p>
        </div>
        <div class="button-go">
        <button class="createAccount"><a href="inscription.php">Céer un compte ?</a></button>
        </div>
        <div class="login-form">
            <form method="post">
                <h2>Connexion</h2>
                <div class="form-group">
                    <label for="prenom">
                        Pseudo<br>
                        <input type="text" name="pseudoConnect" class="valeur-form" autocomplete="off" value="<?php if (isset($pseudoconnect)) {
                                                                                                                    echo $pseudoconnect;
                                                                                                                } ?>">
                    </label>
                </div><br>
                <div class="form-group">
                    <label for="prenom">
                        Mot de passe<br>
                        <label class="lable-password">
                            <input type="password" name="passwordConnect" class="valeur-form" autocomplete="off">
                        </label>
                    </label>
                </div><br>
                <div class="form-group">
                    <input type="submit" name="formConnect" class="button-connexion" value="Connexion">
                </div>
                <?php
                // S'IL Y A UNE ERREURE ON L'AFFICHE
                if (isset($erreur)) {

                    $output .= "<div class=\"alert\">";
                    $output .= "<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>";
                    $output .= "<strong>Erreur!</strong> " . $erreur;
                    $output .= "</div>";

                    echo $output;
                }
                ?>
            </form>

        </div>
    </main>
    <script src="https://kit.fontawesome.com/4b95889e0a.js" crossorigin="anonymous"></script>
</body>

</html>