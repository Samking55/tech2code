<?php
//sessions
include("../../server/phpsession.php");
//allow only course if the user is connected
check_session("../../account/login.php");
// define page route for the menu
$h_page_link = "../../index.php";
$html_pg_link = "html.course.php";
$css_pg_link = "css.course.php";
$js_pg_link = "js.course.php";
$bt_pg_link = "bootstrap.course.php";
$to_profile_page = "../profile.php";
$logout_pg = "../../account/logout.php";
//import db for fetching course list
include("../../server/db.php");
//fetch course list
//language var
$lang = strtoupper("css");
$query = "SELECT * FROM course WHERE subject = '$lang'";
$course = $db_connect->query($query);
$text = "
Ce cours vise a vous donner le maximum possible pour vous permettre de vous lancer dans vos debuts en tant que
front-end. Mais et surtout vous permettre d'accroitre vos competence en design web. Vous trouverez des cours en module
video concu pour tout type d'apprenant et des exercices pratiques vous permettant de mieux mettre a rude epreuve
vos acquis

";
// text to display in case there are no courses yet
$error_no_course = "Desole nous n'avons pas encore ajoute de cours CSS";
// page title for the view
$pg_title = "Tutoriel CSS";
?>
<!-- include pages view page for course -->
 <?php 
 include("../../ressources/views/course.page.view.php");
 
 ?>