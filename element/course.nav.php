<!-- this page is the navigation bar for seeing differents chapters uploaded on the platform -->
<!-- class="hide-course-list-nav" -->
<nav id="course-nav-bar" class="hide-course-list-nav">
    <div class="section-header-nav"><h3>Liste des cours</h3><i class="fa-solid fa-xmark"></i></div>
    <div class="course-navbar-content">
        <?php
        if ($course->num_rows > 0):
            while ($course_data = $course->fetch_assoc()):
        ?>
                <div id="course-card">
                    <section class="course-card-title"> <h3><?php echo strtoupper(htmlspecialchars($course_data["course_title"])); ?></h3></section>
                        <div class="action-btn-container">
                            <button class="start-course-btn" data-course-id="<?php echo htmlspecialchars($course_data["ID"]); ?>">Commencer</button>
                            <span class="btn-svg-indicator"><i class="fa-regular fa-circle-play"></i></span>
                        </div>
                    <span class="bg-card bg-1" ></span>
                </div>
            <?php
            endwhile;
        else: ?>
            <div> <?php echo $error_no_course; ?> </div>
        <?php endif; ?>
    </div>
</nav>