<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Connexion au compte tech2code ou Inscription a la plateforme">
    <script src="https://kit.fontawesome.com/41d964378d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../ressources/css/login_page.css">
    <script src="../ressources/js/loginphpaccount.js" defer></script>
    <script src="../ressources/js/main.js" defer></script>
    <title>Connexion / Inscription</title>
</head>

<body>
    <main id="form-container">
        <div class="back-btn" onclick="redirect('../index.php')"><i class="fa-solid fa-chevron-left"></i></div>
        <!--login forn-->
        <div id="login-form" data-form="form">
            <h3>Connexion</h3>
            <div class="login-form-socials">
                <i class="fa-brands fa-google"></i>
                <i class="fa-brands fa-linkedin"></i>
            </div>
            <form action="" method="post" data-form-content="login">
                <input type="email" name="email" id="email-field" data-input="input-field" placeholder="email@exemple.com" required>
                <input type="password" name="password" id="password-field" data-input="input-field" placeholder="Mot de passe" required>
                <button type="submit" id="submit-form-login" class="form-btn">Connexion</button>
            </form>
            <div id="overlay" class="overlay-closed" data-overlay-form="login">
                <button class="login-overlay-btn">Connexion</button>
            </div>
        </div>
        <!--login forn close-->

        <!--sign up forn-->
        <div id="signup-form" data-form="form">
            <h3>Inscription</h3>
            <div class="signup-form-socials">
                <i class="fa-brands fa-google"></i>
                <i class="fa-brands fa-linkedin"></i>
            </div>
            <form action="signup.php" method="post" data-form-content="signup">
                <input type="text" name="name" id="name-field-signup" data-input="input-field" placeholder="Nom et prenom" required>
                <input type="email" name="email" id="email-field-signup" data-input="input-field" placeholder="email@exemple.com" required>
                <input type="password" name="password" id="password-field-signup" data-input="input-field" autocomplete="off" placeholder="Mot de passe" data-pwd="pwd" required>
                <input type="password" name="password_check" id="password-repeat-signup" data-input="input-field" autocomplete="off" placeholder="Repetez votre mot de passe" data-pwd="pwd-check" required>
                <div class="pwd_state" style="margin: 10px 0 0 0;"></div>
                <button type="submit" id="submit-form-signup" class="form-btn">Inscription</button>
            </form>
            <div id="overlay" data-overlay-form="signup">
                <button class="register-overlay-btn">Inscription</button>
            </div>
        </div>
    </main>


</body>

</html>

<?php
//import db
include("../server/db.php");
include("../server/user_session.php");

login("email", "password", $db_connect, "../index.php");
