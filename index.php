<?php
//initialize sessions
session_start();

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_mail"])) {
    $user_session_id = $_SESSION["user_id"];
    $user_session_name = $_SESSION["user_name"];
    $user_session_mail = $_SESSION["user_mail"];
}

if (isset($user_session_id) && $user_session_id) {
    $action_btn = "Acceder au cours";
    $to_page = "pages/courses/index.course.php";
} else {
    $action_btn = "S'inscrire au cours";
    $to_page = "account/login.php";
}

$overlay = "
<div class='overlay'>
    <p class='overlay-tag'> < /> </p>
    <p>TECH2CODE</p>
</div>";

$to_profile_page = "pages/profile.php";
$h_page_link ="index.php";
$html_pg_link = "pages/courses/html.course.php";
$css_pg_link ="";
$js_pg_link = "";
$bt_pg_link = "";

$active = true;
if ($active) {
    $state = "active";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagde d'acceuil tech to code pour la liste des exercices">
    <title>Tech2Code</title>
    <link rel="stylesheet" href="ressources/css/main.css">
    <link rel="stylesheet" href="ressources/css/index.css">
    <script src="https://kit.fontawesome.com/41d964378d.js" crossorigin="anonymous"></script>
    <script src="ressources/js/main.js" defer></script>
</head>

<body>
    <header id="index-header">
        <section class="site-name">
            <p>TECH2CODE</p>
        </section>
        <?php include("element/nav.php"); ?>
        <div id="user-section">
            <!--display the profile info in the info profile section-->
            <button class="profile-btn">
                <i class="fa-solid fa-user"></i>
            </button>
            <div id="profile-section-container" class="hide">
                <?php if (isset($user_session_id) && isset($user_session_name) && isset($user_session_mail)) { ?>
                    <ul class="profile-info-container">
                        <li class="profile_name">
                        <i class="fa-solid fa-user"></i> <?php echo $user_session_name ?>
                        </li>
                        <li class="profile_email">
                        <i class="fa-solid fa-envelope"></i> <?php echo $user_session_mail ?>
                        </li>
                        <li onclick="redirect('account/logout.php')"><i class="fa-solid fa-right-from-bracket"></i></li>
                    </ul>
                <?php } else { ?>
                    <p class="profile-login" onclick="redirect('account/login.php')">Connexion</p>
                <?php } ?>
            </div>
        </div>
    </header>
    <!--Here will be the main content of the page-->
    <main id="index-content">
        <!--course card container-->
        <div class="section-title" title="Liste des cours">
            <h3>Liste des cours</h3>
        </div>
        <div class="course-list-container">
            <!--Html course card-->
            <div class="course-card" data-course-name="html">
                <div class="course-card-img ">
                    <!--add overlay-->
                    <?php echo $overlay; ?>
                    <img src="https://img.icons8.com/color/500/html-5--v1.png" alt="logo html">
                </div>
                <div class="course-card-text">
                    <p>Developpez vos skills en HTML avec des cours tailles a la perfection pour vous</p>
                </div>
                <div class="course-card-actionbtn">
                    <button onclick="redirect('<?php echo $to_page; ?>')"> <?php echo $action_btn; ?> </button>
                </div>
            </div>
            <!--Html course card close-->

            <!--css course card-->
            <div class="course-card" data-course-name="css">
                <div class="course-card-img ">
                    <!--add overlay-->
                    <?php echo $overlay; ?>
                    <img src="https://img.icons8.com/color/500/css3.png" alt="logo css">
                </div>
                <div class="course-card-text">
                    <p>Stylise ton site comme un pro avec CSS</p>
                </div>
                <div class="course-card-actionbtn">
                    <button onclick="redirect('<?php echo $to_page; ?>')"> <?php echo $action_btn; ?> </button>
                </div>
            </div>
            <!--css course card close-->

            <!--js course card-->
            <div class="course-card" data-course-name="js">
                <div class="course-card-img ">
                    <!--add overlay-->
                    <?php echo $overlay; ?>
                    <img src="https://img.icons8.com/color/500/javascript--v1.png" alt="logo js">
                </div>
                <div class="course-card-text">
                    <p>Utilise JavaScript pour un contenu plus dynamique</p>
                </div>
                <div class="course-card-actionbtn">
                    <button onclick="redirect('<?php echo $to_page; ?>')"> <?php echo $action_btn; ?> </button>
                </div>
            </div>
            <!--js course card close-->

            <!--bt course card-->
            <div class="course-card" data-course-name="bt">
                <div class="course-card-img ">
                    <!--add overlay-->
                    <?php echo $overlay; ?>
                    <img src="https://img.icons8.com/color/500/bootstrap--v1.png" alt="bootstrap logo">
                </div>
                <div class="course-card-text">
                    <p>Apprend BOOTSTRAP et passe au niveau superieur en terme de stylisation</p>
                </div>
                <div class="course-card-actionbtn">
                    <button onclick="redirect('<?php echo $to_page; ?>')"> <?php echo $action_btn; ?> </button>
                </div>
            </div>
            <!--bt course card close -->
        </div>
        <!--course card container end-->
    </main>
    <footer class="index-footer">
        <!--create caroussel-->
        <div class="caroussel-container">
            <div class="caroussel-card caroussel-active"></div>
        </div>
        <!--Services listing-->
        <div class="services">
            <p>Tech2code Descript goes here</p>
        </div>
        <!--Social-->
        <div class="socials">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-whatsapp"></i>
            <i class="fa-solid fa-envelope"></i>
        </div>
    </footer>
</body>

</html>