<?php

session_start();

require_once('classes/fonctions.php');

$output = "";

if (isset($_POST['formInscritpion'])) {

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $defaultPdp = "img/profil/avatar.jpg";
    $role = "user";



    if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        $pseudolenght = strlen($pseudo);

        if ($pseudolenght <= 20) {
            $reqpseudo = db()->prepare("SELECT * FROM users WHERE pseudo = ?");
            $reqpseudo->execute(array($pseudo));
            $pseudoExistant = $reqpseudo->rowCount();

            if ($pseudoExistant == 0) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = db()->prepare("SELECT * FROM users WHERE email = ?");
                    $reqmail->execute(array($email));
                    $emailExistant = $reqmail->rowCount();
                    // REQUETE SQL QUI INSERT LES INFORMATIONS SI ELLE SONT TOUTES CORRECTE
                    if ($emailExistant == 0) {

                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                        $insertUser = db()->prepare("INSERT INTO users(pseudo, email, password, photoProfil, role) VALUES (?, ?, ?, ?, ?)");
                        $insertUser->execute(array($pseudo, $email, $passwordHash, $defaultPdp, $role));

                        //
                        $success = "Votre compte a bien été créer";
                    } else {
                        $erreur = "L'email est déjà utilisé !";
                    }
                } else {
                    $erreur = "Votre email n'est pas valide !";
                }
            } else {
                $erreur = "Le pseudo est déjà utilisé !";
            }
        } else {
            $erreur = "Votre pseudo est trop long !";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs !";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car-Meet Switzerland | Inscription</title>
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
            <button class="createAccount"><a href="login.php">J'ai déjà un compte</a></button>
        </div>
        <div class="login-form">
            <form method="post">
                <h2>Inscription</h2>
                <div class="form-group">
                    <label for="pseudo">
                        Nom d'utilisateur<br>
                        <input type="text" name="pseudo" class="valeur-form" autocomplete="off" value="<?php if (isset($pseudo)) {
                                                                                                            echo $pseudo;
                                                                                                        } ?>">
                    </label>
                </div><br>
                <div class="form-group">
                    <label for="email">
                        Email<br>
                        <input type="email" name="email" class="valeur-form" autocomplete="off" value="<?php if (isset($email)) {
                                                                                                            echo $email;
                                                                                                        } ?>">
                    </label>
                </div><br>
                <div class="form-group">
                    <label for="password">
                        Mot de passe<br>
                        <input type="password" name="password" class="valeur-form" autocomplete="off">
                    </label>
                </div><br>
                <div class="form-group">
                    <br>
                    <div class="form-group">
                        <input type="submit" name="formInscritpion" class="button-connexion" value="S'inscrire">
                    </div>
                    <?php
                    if (isset($erreur)) {
                        $output .= "<div class=\"alert\">";
                        $output .= "<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>";
                        $output .= "<strong>Erreur !</strong> " . $erreur . ".";
                        $output .= "</div>";

                        echo $output;
                    }
                    if (isset($success)) {
                        $output .= "<div class=\"alert success\">";
                        $output .= "<span class=\"closebtn\">&times;</span>";
                        $output .= "<strong>Succès !</strong> " . $success . ". <a href='login.php' class='goLogin'>Se connecter</a>";
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