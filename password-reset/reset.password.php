<?php
// import db
include("../server/db.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ressources/css/password-reset.css">
    <script src="../ressources/js/reset-pwd-pg.js" defer></script>
    <title>Reinitailiser mot de passe</title>
</head>

<body>
    <main>
        <!-- create get condition for resting pwd -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET"): ?>
            <?php if (isset($_GET["token"]) && isset($_GET["email"]) && !empty($_GET["token"]) && isset($_GET["token_alive"]) && $_GET["token_alive"] === "true"): ?>
                <!-- form for reseting pwd -->
                <form action="" method="post" id="new-pwd-setup-form">
                    <div class="form-container">
                        <input type="password" name="new-pwd-setup-field" id="new-pwd-setup-field" required>
                        <input type="password" name="r-new-pwd-setup-field" id="r-new-pwd-setup-field" required>
                        <button type="submit" class="set-up-new-pwd-btn" name="set-up-new-pwd-btn" value="new-pwd-sent-request">Mettre a jour mon mot de passe</button>
                    </div>
                </form>
            <?php else: ?>
                <!-- create form for connecting to db and verify if email for resetting password exists in case the requested form for setting new pwd has not been sent-->
                <form action="" method="post" id="reset-email-pwd-request">
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse email" required>
                    <button type="submit" class="submit-email-lookup" name="email-lookup" value="verify-email-reset">Reinitailiser</button>
                </form>
                <!-- end for form -->
            <?php endif; ?>
        <?php endif; ?>
        <!-- spin container for if page is loading-->
        <div id="loader-container">
            <span class="loader-bar-1"></span>
            <span class="loader-bar-2"></span>
            <span class="loader-bar-3"></span>
            <span class="loader-bar-4"></span>
            <span class="loader-bar-5"></span>
        </div>
    </main>
</body>

</html>