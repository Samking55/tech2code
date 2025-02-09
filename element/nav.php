<?php 
//define varaibles in the target files 
//they will trigger the function redirect from JS where the page link will be defined in the script, so before loading the script
//make sure to define all the required variables, as given below
//$h_page_link for home page link, $html_pg_link to access the HTML course, $css_pg_link link to access css page course
//$js_pg_link to access Javascript page course, $bt_pg_link to acceess bootstrap page course $to_profile_page for the profile page
//to profile link will be the profile page

?>

<nav id="main_nav">
    <ul class="menu">
        <li onclick="redirect('<?php echo $h_page_link; ?>')" class="menu-item <?php echo $state ?>" data-item-menu="home_item">
            <p>Acceuil</p>
        </li>
        <li class="menu-item" data-item-menu="list_course_item"> <p>Cours</p>
            <ol class="dropdown-menu">
                <li onclick="redirect('<?php echo $html_pg_link; ?>')" class="dropdown-item">HTML</li>
                <li onclick="redirect('<?php echo $css_pg_link; ?>')" class="dropdown-item">CSS</li>
                <li onclick="redirect('<?php echo $js_pg_link; ?>')" class="dropdown-item">JavaScript</li>
                <li onclick="redirect('<?php echo $bt_pg_link; ?>')" class="dropdown-item">BOOTSTRAP</li>
            </ol>
        </li>
        <li class="menu-item" data-item-menu="question_item"><p>FAQ</p></li>
        <li class="menu-item" data-item-menu="login-profile-section" onclick="redirect('<?php echo $to_profile_page; ?>')"><p>Espace Tech2Coder</p></li>
    </ul>
</nav>