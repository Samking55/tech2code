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
//define varaibles in the target files 
//they will trigger the function redirect from JS where the page link will be defined in the script, so before loading the script
//make sure to define all the required variables, as given below
//$h_page_link for home page link, $html_pg_link to access the HTML course, $css_pg_link link to access css page course
//$js_pg_link to access Javascript page course, $bt_pg_link to acceess bootstrap page course $to_profile_page for the profile page
//to profile link will be the profile page
/*
$h_page_link = "";
$html_pg_link = "";
$css_pg_link = "";
$js_pg_link = "";
$bt_pg_link = "";
$to_profile_page = "";
$logout_pg= "";
*/
?>

<header id="main-header">
    <div id="header-inner">
        <section class="site-name">
            <p>TECH2CODE</p>
        </section>
        <nav id="main_nav" class="hide-main-nav">
            <ul class="main-menu">
                <li onclick="redirect('<?php echo $h_page_link; ?>')" class="menu-item" data-item-menu="home_item">
                    <p>Acceuil</p>
                </li>
                <li class="menu-item" data-item-menu="list_course_item">
                    <p>Cours <i class="fa-solid fa-caret-down" style="position:relative; left:20%; font-size: 20px;"></i></p>
                    <ol class="dropdown-menu hide-dropdown" data-item-menu="dropdown">
                        <li onclick="redirect('<?php echo $html_pg_link; ?>')" class="dropdown-item">HTML</li>
                        <li onclick="redirect('<?php echo $css_pg_link; ?>')" class="dropdown-item">CSS</li>
                        <li onclick="redirect('<?php echo $js_pg_link; ?>')" class="dropdown-item">JavaScript</li>
                        <li onclick="redirect('<?php echo $bt_pg_link; ?>')" class="dropdown-item">BOOTSTRAP</li>
                    </ol>
                </li>
                <li class="menu-item" data-item-menu="question_item">
                    <p>FAQ</p>
                </li>
                <li class="menu-item" data-item-menu="login-profile-section" onclick="redirect('<?php echo $to_profile_page; ?>')">
                    <p>Espace Tech2Coder</p>
                </li>
            </ul>
        </nav>
        <div id="user-section" class="hide-user-section">
            <!--display the profile info in the info profile section-->
            <?php if (isset($user_session_id) && isset($user_session_name) && isset($user_session_mail)) { ?>
                    <button onclick="redirect('<?php echo $logout_pg; ?>')" class="profile-logout-btn">
                        Deconnexion
                    </button>
            <?php } else { ?>
                <div class="profile-login-container"><button class="profile-login" onclick="redirect('<?php echo $login_pg; ?>')">Connexion</button></div>
            <?php } ?>
        </div>
        <div class="btn-header-section">
            <button class="toggle-menu-mobile"><i class="fa-duotone fa-solid fa-bars"></i></button>
            <button class="profile-btn">
                <i class="fa-solid fa-user"></i>
            </button>
        </div>
    </div>
</header>