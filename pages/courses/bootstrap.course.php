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
$lang = strtoupper("bt");
$query = "SELECT * FROM course WHERE subject = '$lang'";
$course = $db_connect->query($query);
$text = "Bootstrap";
// text to display in case there are no courses yet
$error_no_course = "Desole nous n'avons pas encore ajoute de cours Bootstrap";
// page title for the view
$pg_title = "Tutoriel Bootstrap";
?>
<!-- include pages view page for course -->
 <?php 
 include("../../ressources/views/course.page.view.php");
 
 ?>