<?php
// check if user is connected
session_start();
if(isset($_SESSION["user_id"])){
    header("Location: ../index.php");
}
include("../server/db.php");
// check login or register from user_session
include("../server/user_session.php");
// error variable for login / registering
$err = null;
// error msg
$err_msg = "";
// form submition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "login") {
        // if all has been set, call login function from user_session.php
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            // store user info into variables
            $user_email = $_POST["email"];
            $user_pwd = $_POST["password"];
            login($user_email, $user_pwd, $db_connect, "../index.php", $err, $err_msg);
        } else {
            // display error
        }
    } elseif (isset($_POST["action"]) && $_POST["action"] == "register") {
        //  if all has been set, call signup function from user_session.php
        if (isset($_POST["name"]) && isset($_POST["second-name"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_check"])) {
            $name = $_POST["name"] . " " . $_POST["second-name"];
            $email_address = $_POST["email"];
            $username = $_POST["username"];
            $pwd = $_POST["password"];
            $pwd_check = $_POST["password_check"];
            signup($name, $email_address, $username, $pwd, $pwd_check, $db_connect, $err, $err_msg);
        }
    } else {
        echo "error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Connexion au compte tech2code ou Inscription a la plateforme">
    <script src="https://kit.fontawesome.com/41d964378d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../ressources/css/login_page.css">
    <script src="../ressources/js/loginphpaccount.js" defer></script>
    <title>Connexion / Inscription</title>
</head>

<body>
    <!-- main content page -->
    <main>
        <!-- nav form for swtiching to login or signup form -->
        <div id="nav-form">
            <p class="login-form-btn-nav active-menu-option">Se connecter</p>
            <p class="signup-form-btn-nav">S'inscrire</p>
        </div>
        <!-- nav end -->

        <!-- hold forms for signup and login -->
        <div id="form-container">
            <!-- create side pannel for showing some text according to the form chosen -->
            <div id="side-panel-form">
                <div>
                </div>
            </div>
            <!-- end side panel -->

            <!-- form inner will hold forms for login and signup -->
            <div id="form-inner">
                <!-- login form container will contain the form for logging in -->
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" data-form-content="login" id="login-form">
                    <label for="email-field-login">Email</label>
                    <input type="email" name="email" id="email-field-login" data-input="input-field" placeholder="email@exemple.com" required>
                    <label for="password-field-login">Mot de passe</label>
                    <input type="password" name="password" id="password-field-login" data-input="input-field" placeholder="Mot de passe" required>
                    <span class="field-warning-login"></span>
                    <button type="submit" id="submit-form-login" class="form-btn" name="action" value="login">Connexion</button>
                </form>
                <!-- end login form -->
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" data-form-content="signup" id="signup-form" class="disable-form">
                    <input type="text" name="name" id="name-field-signup" data-input="input-field" placeholder="Nom" maxlength="50" required>
                    <input type="text" name="second-name" id="s-name-field-signup" data-input="input-field" placeholder="Prenom" maxlength="50" required>
                    <input type="email" name="email" id="email-field-signup" data-input="input-field" placeholder="email@exemple.com" maxlength="50" required>
                    <input type="text" name="username" id="username" data-input="input-field" placeholder="Nom d'utilisateur" maxlength="30" required>
                    <input type="password" name="password" id="password-field-signup" data-input="input-field" autocomplete="off" placeholder="Mot de passe" data-pwd="pwd" required>
                    <input type="password" name="password_check" id="password-repeat-signup" data-input="input-field" autocomplete="off" placeholder="Repetez votre mot de passe" data-pwd="pwd-check" required>
                    <span class="field-warning-signup"></span>
                    <button type="submit" id="submit-form-signup" class="form-btn" name="action" value="register">Inscription</button>
                </form>
            </div>
        </div>
        <!-- form container end -->
    </main>
    <footer>
        <div class="forgotten-pwd">
            <!-- for requestong forgotten pwd -->
            <p><a href="../password-reset/reset.password.php">Avez vous oublie votre mot de passe ?</a></p>
        </div>
    </footer>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php if (isset($err) && $err == true): ?>
            <script>
                // create element for displaying popup
                function display_popup(msg, timeout) {
                    const popup_container = document.createElement("div")
                    popup_container.id = "popup-container"
                    const popup_msg_inner = document.createElement("div")
                    popup_msg_inner.textContent = msg
                    // bind element together
                    document.body.appendChild(popup_container)
                    popup_container.appendChild(popup_msg_inner)
                    // hide popup
                    setTimeout(function() {
                        // add class for hiding popup
                        popup_container.classList.add("hide-popup")
                    }, timeout - 900)
                    // remove element 
                    setTimeout(function() {
                        popup_container.remove()
                    }, timeout)
                }
                display_popup("<?php echo $err_msg; ?>", 6000)
            </script>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>
<?php
