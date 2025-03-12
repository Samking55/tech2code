<?php
// check if user is connected 
require("../server/phpsession.php");
check_session("../account/login.php");
//define variables for the header and menu
$h_page_link = "../index.php";
$html_pg_link = "courses/html.course.php";
$css_pg_link = "courses/css.course.php";
$js_pg_link = "courses/js.course.php";
$bt_pg_link = "courses/bootstrap.course.php";
$to_profile_page = "profile.php";
$logout_pg = "../account/logout.php";
$bc_teacher = "";
//connect db
include("../server/db.php");
// fetch user info
$user_query = "SELECT * FROM users WHERE ID='$user_session_id'";
$user_info = $db_connect->query($user_query);
if ($user_info = $user_info->fetch_assoc()) {
    $profile_mail = $user_info["user_mail"];
    $profile_name = $user_info["user_profile_name"];
}

?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profil et informatiions lies au compte">
    <link rel="stylesheet" href="../ressources/css/main.css">
    <link rel="stylesheet" href="../ressources/css/profile-pg.css">
    <script src="../ressources/js/main.js" defer></script>
    <script src="../ressources/js/profile-pg.js" defer></script>
    <script src="https://kit.fontawesome.com/41d964378d.js" crossorigin="anonymous"></script>
    <title>Profile TECH2CODER</title>
</head>

<body>
    <!--include header-->
    <?php include("../element/header.php"); ?>
    <!-- end header -->
    <!-- main -->
    <main>
        <!-- section for displaying user info -->
        <div id="profile-info">
            <i class="fa-solid fa-user"></i>
            <p class="profile-name"><?php echo $profile_name; ?></p>
            <p class="profile-mail"><i class="fa-solid fa-envelope"></i><?php echo $profile_mail; ?></p>
        </div>
        <!-- user-info end -->

        <!-- profile settings -->
        <div id="profile-settings">
            <!-- change password -->
            <div class="modify-pwd">
                <h4>Changer de mot de passe</h4>
                <form id="modify-pwd-form">
                    <input type="password" name="current-pwd" id="current-pwd" placeholder="Mot de passe actuel">
                    <input type="password" name="new-pwd" id="new-pwd" placeholder="Nouveau mot de passe">
                    <input type="password" name="r-new-pwd" id="r-new-pwd" placeholder="Confirmez votre mot de passe">
                    <button class="save-new-pwd" data-account-id="<?php echo htmlspecialchars($user_session_id) ?>">Modifier</button>
                </form>
            </div>
            <!-- change password end -->

            <!-- dark-mode -->
            <div class="dark-mode">
                <h4>Dark mode</h4>
                <!-- darkmode switch -->
                 <p class="switch">
                    <input type="checkbox"> 
                    <span class="slider"></span>
                </p>
            </div>
            <!-- dark-mode end -->
        </div>
        <!-- utility -->
        <div id="utility">
            <p class="become-premium">Devenir utilisateur premium <i class="fa-solid fa-chevron-right"></i></p>
            <p class="contact-admin">Contacter l'administrateur <i class="fa-solid fa-chevron-right"></i></p>
            <p class="become-teacher">Devenir enseignant <i class="fa-solid fa-chevron-right"></i></p>
            <p class="account-status">Status du compte <i class="fa-solid fa-chevron-right"></i></p>
            <p class="faq">Foire Aux Questions <i class="fa-solid fa-chevron-right"></i></p>
            <p class="close-account" style="color: #EE0709;">Quitter la plateforme <i class="fa-solid fa-chevron-right"></i></p>
        </div>
        <!-- utility end -->
        <!-- warning popup for confirm box -->
         <div class="confirm-box-container hide-popup-warning">
            <div class="confirmbox">
                <section class="warning-msg"></section>
                <section class="action-button-container">
                    <button class="action-btn confirm-btn">OK</button> <button class="action-btn deny-btn">ANNULER</button>
                </section>
            </div>
         </div>
        <!-- message box -->
         <div id="popup" class="hide-popup">
            <p class="popup-msg">
                
            </p>
         </div>
    </main>
</body>

</html>
