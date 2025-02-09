<?php
include("../server/phpsession.php");
check_session("../account/login.php");
$to_profile_page = "profile.php";
$active = false;
$state = null;
if ($active) {
    $state = "active";
}
//define variables for the header
$login_pg = "../account/login.php";
$logout_pg = "../account/logout.php";
$h_page_link ="../index.php";
$html_pg_link = "courses/html.course.php";
$css_pg_link ="";
$js_pg_link = "";
$bt_pg_link = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profil et informatiions lies au compte">
    <link rel="stylesheet" href="../ressources/css/main.css">
    <script src="../ressources/js/main.js" defer></script>
    <script src="https://kit.fontawesome.com/41d964378d.js" crossorigin="anonymous"></script>
    <title>Profile TECH2CODER</title>
</head>

<body>
    <!--include header-->
    <?php 
    //define variables for the header
    include("../element/header.php"); 
    ?>
</body>

</html>