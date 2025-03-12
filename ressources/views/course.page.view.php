<!-- view page for course display -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Cours HTML complet">
    <link rel="stylesheet" href="../../ressources/css/main.css">
    <link rel="stylesheet" href="../../ressources/css/course.page.css">
    <script src="https://kit.fontawesome.com/41d964378d.js" crossorigin="anonymous"></script>
    <script src="../../ressources/js/main.js" defer></script>
    <script src="../../ressources/js/course.page.js" defer></script>
    <title><?php echo $pg_title; ?></title>
</head>

<body>
    <!--Website header-->
    <?php 
    include("../../element/header.php");
    ?>
    <!--Website header close-->
    <!--Main content-->
    <main id="course-main">
        <div class="chapter-list-btn-container">
            <div class="chapter-list-btn">
                <button>Chapitre</button> <span class="svg-container"><i class="fa-solid fa-chevron-right"></i></span>
            </div>
        </div>
        <!--The course nav bar is going to display the course list and toggled on click event -->
        <!-- include nav for displaying course here -->
        <?php include("../../element/course.nav.php"); ?>
        <!--Content presentation-->
        <div class="course-page-intro">
            <h2>Vu d'ensemble</h2>
            <p>
                <?php echo $text; ?>
            </p>
            <p>
                Cliquez sur le bouton en haut pour voir les differents chapitres. Sachez que la progression est le resultat
                d'un apprentissage constant
            </p>
        </div>
        <div class="course-module-information">
            <div class="course-module-inner">
                <p>Module VIDEO</p>
            </div>

        </div>
        <!--display course section -->
        <?php include("../../element/display.course.banner.php"); ?>
    </main>
    <!-- include footer  -->
    <?php include("../../element/footer.page.php"); ?>
</body>

</html>