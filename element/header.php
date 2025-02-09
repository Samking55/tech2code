<?php 
//header element uses the nav element so the scriot must only be included into another file only from the header
//define all the variables listed in the nav element into the target files, the same goes for here
//set up variables to be defined in the target file
//$login_pg for the login page link, $logout_pg for the logout pg link
//define them all in the target files
//below are the variables for the nav and their roles
//$h_page_link for home page link, $html_pg_link to access the HTML course, $css_pg_link link to access css page course
//$js_pg_link to access Javascript page course, $bt_pg_link to acceess bootstrap page course
//to profile link will be the profile page

?>

<header>
    <section class="site-name">TECH2CODE</section>
    <?php include("nav.php"); ?>
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
                    <li onclick="redirect('<?php echo $logout_pg; ?>')"><i class="fa-solid fa-right-from-bracket"></i></li>
                </ul>
            <?php } else { ?>
                <p class="profile-login" onclick="redirect('<?php echo $login_pg; ?>')">Commexio</p>
            <?php } ?>
        </div>
    </div>
</header>