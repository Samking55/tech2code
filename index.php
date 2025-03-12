<?php
//initialize sessions
session_start();


if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_mail"])) {
    $user_session_id = $_SESSION["user_id"];
    $user_session_name = $_SESSION["user_name"];
    $user_session_mail = $_SESSION["user_mail"];
}
//set button redirect page to allow or deny acces only on the index page
if (isset($user_session_id) && $user_session_id) {
    $action_btn = "Acceder au cours";
    $to_page = "pages/courses/index.course.php";
} else {
    $action_btn = "S'inscrire au cours";
    $to_page = "account/login.php";
}

//define header variables
$to_profile_page = "pages/profile.php";
$h_page_link = "index.php";
$html_pg_link = "pages/courses/html.course.php";
$css_pg_link = "pages/courses/css.course.php";
$js_pg_link = "pages/courses/js.course.php";
$bt_pg_link = "pages/courses/bootstrap.course.php";
$login_pg = "account/login.php";
$logout_pg = "account/logout.php";
$bc_teacher = "dashboard/teacherspace.php";
//connect to db
include("server/db.php");

//request course to display in the recent added course
$query = "SELECT course_title, subject, YEAR(added_date) as added_year, MONTH(added_date) as added_month FROM course ORDER BY added_date DESC";
$course = $db_connect->query($query);

?>

<!DOCTYPE html>
<html lang="fr-FR">

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
    <!--Insert header-->
    <?php include("element/header.php"); ?>
    <!--Close header-->
    <!--Here will be the main content of the page-->
    <main id="index-page-content">
        <!--web banner-->
        <?php if (isset($user_session_id)): ?>
            <div class="carousel">
                <!-- carousel inner containing all the carousel tabs -->
                <div class="slide tab-1 ">
                    <img src="https://images.pexels.com/photos/4143800/pexels-photo-4143800.jpeg?auto=compress&cs=tinysrgb&w=1080" alt="slide img">
                    <p class="slide-tab-text">
                        Apprenez de nouveaux skills, saisissez l'opportunite de donner le meilleur de qui vous etes
                    </p>

                </div>
                <div class="slide tab-2">
                    <img src="https://images.pexels.com/photos/8199557/pexels-photo-8199557.jpeg?auto=compress&cs=tinysrgb&w=1080" alt="slide img">
                    <p class="slide-tab-text">
                        Soyez un modele pour une generation
                    </p>
                </div>
                <div class="slide tab-3 ">
                    <img src="https://images.pexels.com/photos/5537941/pexels-photo-5537941.jpeg?auto=compress&cs=tinysrgb&w=1080" alt="slide img">
                    <p class="slide-tab-text">
                        Consacrez du temps pour assurer un avenir meilleur
                    </p>
                </div>
                <div class="slide tab-4">
                    <img src="https://images.pexels.com/photos/3184163/pexels-photo-3184163.jpeg?auto=compress&cs=tinysrgb&w=1080" alt="slide img">
                    <p class="slide-tab-text">
                        Mais surtout, soyez TECH2CODE
                    </p>
                </div>
                <!-- carousel tabs end -->
            </div>
        <?php else: ?>
            <div id="banner-container">
                <div class="banner banner-text">
                    <p class="banner-dark"><span class="banner-light">Apprenez les bases de la programation</span> <br>
                        avec des cours pensés pour vous et un programme interactif
                    </p>
                    <span class="background-bubble-banner bubble-1"></span>
                </div>
                <div class="banner">
                    <span class="background-bubble-banner bubble-2">
                        <img src="data:image/png;base64,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" alt="learn-more" class="bubble-img b-img-1">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFZklEQVR4nO1bWYwUVRQ9rom7GMcFlUUa1ETRD8UPk/k3Jvrrj3756YdfJvpzb3fTGXDighCVGDUj4IIZo6io8UsnJiaCCwM6RgMiSwszGo0LMyC2ue/d6nrVVlUvVdPdVfRJKkwtr+udU/fed+97D2CAXqC8FKDXAPrZHvwqQEtwaqC8GOBpgGsNxy9WmNyDXrGE6V1g9VUAXQ3Qdr22GfkH69cX4h7K16gVTCP/4CPRAkg8yD14i5LdbkUw5N9XC9jUvD0V1I0OAfQTwC8Exex7UEEjf2MQrALlZU3arggPoCJE9kTY7JDY1Jy8gN9WwtvssFm6DqBP9DeeR/bAKkAroNMB/gvgk8DIAv966Qb9nX3z1s3moEsB3gjQjwAfsH5eWp6uAOY9swD9A6y5yLlW8F2oJ6BLAN4f4pczAF2frgD8nrbZAtDFwOorAfrAv9YT0AbtwIT65BKAx31fTUuAyuUAfRMSPL0ssoUYMi/g75Tsjf41+TpiqnQ8HQGEPO/R9+zSIPinHlttet0z8Le2YxKMPKy9wArAJ5IL0Ei+MoT+Aj+rRD4E6Ar79WVY85KdJAL0PXmBFDQm8of4pvhsXKfjBMgEeQ+0SBObaeuXJmGZ1M5/ZUeK+rMrAV4P0G5HrJ0Ar7VBNHPko2BIaHzgzwG6DKBnbCITGsmF7HGAnsgBeQ+0EODvlczf+u8swE8CxdsAOlePVQCvA3jOESPr5F33kHHaENsPlG5CJIx7aDwRS+gqyovVj6u21OSX0pmnkwrODInHgrlC5PMr1Urm/JiQBJKS8+taRVZ1/nFR40uvjSgzDyYXwZi2/NZT7beRwJi46jwaEm+m7TxEHfyGP08n6sjkJH+k115EIsgoIL8jPt9ym1X67h1dmn9k/fpSXASsopbe8fg5rXd89Lx03x06/XbUVWrGXpShq/7g0vkVoHin/UJyyN9dF+CgawFe9faWTWeNuXhl5hgSwSQ5DS5A94d09D5HnNvTcQE3JY+dfywtB+jXkE5VrSskAa3R31rnXJvSa48A9Kh2csq5/7TeH0n47oJG/kaLOBzCq7zMDhf0m05miHkWknWgPpEpCc4xoHSzveZlgzhNp7qkYyf1+VucYbCFWaVmEF70snKSEWGsB8twPOr7nYjgfYn6fT039w6lMwT2DSpDNq2tm99stAD1e+PAxrOQM/J7AHoOoH+jBTCuMppT8hUdYqUWiLSAFcgHKhHkPURawDhAbwJ0N1C8R//W89yQjxUgLpl5APkgHyuAkxf877zqW4RYR2bJxwkQyAtCzvvWIiptkI8VoMl5IHPci2ySTyKAaxEynPYVeZoKltPzIkDEefemzDYA/CXAXwNMrX354l02/zarx7dmVICSLHoejhiiYsjTgw2BS9YLHwohdCS4P6jpebcF4HecKTOp1ob9uXsuhrfZeoadDRZfpYdtceOmwS4BM/+wsPXzrgpAZ9pFTsnTAxsThlWUL6Ljg7k/47S515bFSQl0V4DztX7/I1ik1MvayfB28iz/bp+RGR4PxTtsXU4/dN6n7rvATn3piCVGFzq7NdZHt6PHfCtwF0REVFlCz4wANKyLGzVd/JxztrbFbE4wY/aYvwkyjYWOng2DJCLsUHc4YQOiuykiChIMZReH6fSB5HOMPRPAnbKWwNgOjNts81PYwKpM1gToFHS2vyojK8atZo25EUAgS+H8sVrCbrtnoF1Im8wKUN9A9Zk/hLYjgiE/6W+6yCxGFmhN0SYRE4Q7EK4vURlq35TrNUXWyXvoVIBcgD+NqC5bOSaQfXCn5PNiBdwhkYEAtYEFYOACNWQffMoHwYnORZD/KTYA0sB/pOqlQMOLNoIAAAAASUVORK5CYII=" alt="external-interactive-blogger-and-influencer-xnimrodx-lineal-xnimrodx" class="bubble-img b-img-2">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD8UlEQVR4nO1aS29NURT+SrUNoh71GniNRCpITEwMvUKVGtASAyI1qsYAI2ufW31EGVRqwE8wEpQ0UgkiUbQYoC8i0Zp4hQStSq6svde597Y99/Tec889PY1+yUna7LX3XWuvtddejw1M4b+DigJqCKCvgHoDqBZANQJWKVA/D5NMkKjzR38B1QrQIaApH+GGzXRkNWBtBugIQM2AejlKsAGATgJUgHDCZtQJtBygM4B6m6ClPsDagckliA2aBqiDgOpN0NDlkGknFUFsNOUDFAHoj8x7CtQuxuQTxAZtAqhf5vYCNauQGc4tBagLoOvBCsKgJQkOoTcDzdBMo1p9AG8FLwiD5gOqI25mns4MXY3vBhXBM9RDgB5kaBXv4w4gLVgloolfQKQYE47IRhMdaJ62pziJ1UfvZFIVQgM6lWAhBelMeA5cm+5CdyBY13hlBqBeyQZXp+LHPxpia4s7LQtBPQAdRmCgXSJI/zixGTOltdGR4sJCT7eBmmXIPnLiLpkqXOg4EtWCHE19bRZCz/kO0HHzY9mEqpTfu5OEoG6BCatpEKC5qS/MmmAhYjFSG0Ar/WLbmU/twYaBhkIHAioTRu4ibbAmRoTkPwF12gSD2YC6L+e4xGnwotjeWY+22+aQPLVm5+yQEl7Pu9g67fa2eM0KgH44CMNmtx++wtorvN5wGGRXqjO5NT4cRKe0thmgPPiCSLGs2eXExBczmFFBICfB8zl99fDvwEcB9clhMBbLZLhr2ot9S6KVj/AFlCfrDWZREIa1L4lGBuALmvJdBKHPZpDV5gd0pWS0Rup8WrvIxbT8OOxj1F9vzEnHb/VBHfYWuWRKEXpQmZv7vZDBhRgwyPVC3COD9xB6KAlROKwfA74/vASNQYPmx4NGmpOEKHaZHUNoQXaA2uJCpMuWrLJnCCdyAOoUQcrHS3WlwmdtQ+hAkuqqDym0Ibi0r7XS6V58CBqUm5DmVqVaDuoTyU8gNCDZYNWdRlOI+xN2gY7WYcJBGwD1W3jamuZkLk/aO+BX/OUFtQvjfRO65GEBNrFYEfsx0DgrC1yOx8NsQLXLhrZn0Gfk3eDATAvzxPwf6MX3KN6Oy7iqyU2WWEusG4isRzBnoleE6PGxvMS7ETMzdgDVxh36DcoV7/Q7bk60yO8fKUhwACzQCx+7rzmAtXNky5oPdlZ779yfGNF95Y5SpbeiBZ8Djp1iYUdUTCldF+sV+tKsTmhYyjMNHV6TqTtxFqfLsHnm03+vlaSIhFbqBHbYQVUT9AJCx2YVpqCsn2NE0/yGJTMtD9ETjoZCU4vlrE3dNA9odEFjSB7VfAbotUlPmUbTJssnpoDJjn8YITiHDZJbTgAAAABJRU5ErkJggg==" alt="timer" class="bubble-img b-img-3">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB/UlEQVR4nO2Yvy9DURTHvwuLSBi6lMViYDDwLxA/Z0zYxMpIzmlVRCTMptZi6YLOtWiFBQPBfyCSitavhATpe6fxaF/fa5V3X9xPcpd3zjv3+33n3ndfC2g0Go1GU3PCnQDvAJQD+F2NQTnR1FGJiaz3wtluZF2aybs2nsA2QEEoAwW/anO+QZaTSiYKRFo+u+JIoYWqwm71aSP/oSPUD9AdEBrxu5GYvEBm/G7k0qwZ7lbYyGoDwEcApUrHqQmgN4CfAar/FksBdGjW8NwIFZbNcel4qFfiByXmOpFYzGMjPCX5z0C4yyZnQcSuFceo3XIAT3pkxPgme3QWwQmpOWoTH3d+GL9mxNgX52Jiq3wuXZt5i21l5ozKvFfASuPP9dXcSF68kXPjMKcYoTPnje/J0qIxqZdw3mf04O7z3JPNzusict75YfCEIq/f/Ku0qFZajPTZ3Hsq90YVOhB5/+v1jTqAnszDcLnZZq60QgeiHdQjtS5QU/jPjUxLrU3420hoAOAMQIOoKax/ISoG/7uO0K2ZmP/rRTWoVYxkXCRzXA6xXbXMRFosX9Jxm6TCCezHQdZfpnzvvaCqR9ZihPbk4ix8A82J5qT14rC06cU0sxSAsiwFxMSrqTk09C2BIgosk/cKx6KNW6MzScX3zL2psagTGo1Go9GgWj4A0o3KKqZz03AAAAAASUVORK5CYII=" alt="laptop-coding" class="bubble-img b-img-4">
                    </span>
                </div>
                <div class="call-to-action">
                    <button class="register-btn" onclick="redirect('account/login.php')">Creer un compte</button>
                    <button class="login-btn" onclick="redirect('account/login.php')">Se connecter</button>
                </div>
            </div>
            <!--module presentation will display the different courses and modules-->
            <div id="course-presentation-container">
                <div class="course-presentation-inner">
                    <div class="course-module-container-text">
                        <p>FORMATIONS BASIQUES</p>
                    </div>
                    <!--Html course presentation-->
                    <div class="course-module">
                        <span class="html-logo course-presentation-container-logo"><img src="https://img.icons8.com/color/48/html-5--v1.png" alt=""></span>
                    </div>
                    <!--CSS course presentation-->
                    <div class="course-module">
                        <span class="css-logo course-presentation-container-logo"><img src="https://img.icons8.com/color/48/css3.png" alt=""></span>
                        <p>Module cours et exercices </p>
                    </div>
                    <!--JS course presentation-->
                    <div class="course-module">
                        <span class="js-logo course-presentation-container-logo"><img src="https://img.icons8.com/fluency/48/javascript.png" alt=""></span>
                        <p>Module cours, et exercices</p>
                    </div>
                    <!--Bootstrap course presentation-->
                    <div class="course-module">
                        <span class="js-logo course-presentation-container-logo"><img src="https://img.icons8.com/color-glass/48/bootstrap.png" alt=""></span>
                        <p>Module cours, et exercices</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div id="recent-course">
            <div class="recent-course-inner">
                <h3>Derniers chapitres</h3>
                <!-- recent added course section displays the four different last course uploaded -->
                <?php
                if ($course->num_rows > 0) :
                    $c = 0;
                    while ($row = $course->fetch_assoc()):
                        // create switch for logo to display logo according to the language
                        switch (strtoupper($row["subject"])):
                            case strtoupper("html"):
                                $logo = "https://img.icons8.com/color/48/html-5--v1.png";
                                break;
                            case strtoupper("css"):
                                $logo = "https://img.icons8.com/color/48/css3.png";
                                break;
                            case strtoupper("js"):
                                $logo = "https://img.icons8.com/fluency/48/javascript.png";
                                break;
                            case strtoupper("bt"):
                                $logo = "https://img.icons8.com/color-glass/48/bootstrap.png";
                                break;
                        endswitch;
                ?>
                        <div class="row-inner-recent-course">
                            <span class="row-course-logo"><img src="<?php echo $logo; ?>" alt="logo for course subject"></span>
                            <span class="row-course-chapter"><?php echo $row["course_title"] ?></span>
                            <span class="row-course-date"><?php echo $row["added_year"]; ?>/<?php echo $row["added_month"]; ?></span>
                            <!-- <img src="<?php // echo $logo; 
                                            ?>" alt="logo for course subject"> -->
                        </div>
                    <?php
                        $c++;
                        if ($c >= 3) {
                            break;
                        }

                    endwhile; ?>
                <?php else: ?>
                    <div class="row-inner-recent-course">Aucun cours ajoutes recemment. </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="blog-section">
            <div class="blog-inner">
                <h3>T2C BLOG</h3>
                <div class="recent-post"></div>
            </div>
        </div>
    </main>
    <!-- footer -->
    <?php include("element/footer.page.php"); ?>
</body>

</html>