//toggle the nav bar containing course list on click
function remove_hide_class(el, class_name) {
    el.classList.toggle(class_name)
}

const btn_nav_toggle = document.querySelector(".chapter-list-btn").addEventListener("click", function () {
    remove_hide_class(document.getElementById("course-nav-bar"), "hide-course-list-nav")
})
//collapse the course list nav bar on click
const nav_header = document.querySelector(".section-header-nav")

const close_menu_section_nav = nav_header.querySelector("i").addEventListener("click", function () {
    remove_hide_class(document.getElementById("course-nav-bar"), "hide-course-list-nav")
})


//sent course requests to the server for fetching course data
async function course_request_read(data) {
    try {
        const requests = await fetch("../../courseList/course.access.php",
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            if(!requests.ok){
                throw new Error('Error' + requests.status)
            }
            //open the section for displaying course chosen then close the nav for course list
            remove_hide_class(document.getElementById("course-nav-bar"), "hide-course-list-nav")
            remove_hide_class(document.getElementById("display-course"), "hide-course-banner")
            //get the response from the server, store it into the reponse_data variable in jsom format
            const response = await requests.json()
            //display banner is the container for displaying the fetched data
            const display_course_banner = document.getElementById("display-course")
            //display course title into the header section
            display_course_banner.querySelector(".course-banner-title").innerHTML = response.course_title.toUpperCase()
            // display course content
            display_course_banner.querySelector(".course-banner-intro-content").innerHTML = response.course_content
             // display course module video
             display_course_banner.querySelector(".video-module-content").src = response.media_link
            //  display information about teacher who uploaded this course
            // teacher name
            //display_course_banner.querySelector(".uploaded-by-name").innerHTML = response.from_teacher_name
            // teahcer mail
            //display_course_banner.querySelector(".uploaded-by-mail").innerHTML = response.from_teacher_mail
            // teacher mobile num
            //display_course_banner.querySelector(".uploaded-by-num").innerHTML = response.from_teacher_phone_num
    } catch (error) {
        console.error(error)
    }
}

const start_course_btn_action = document.querySelectorAll(".start-course-btn")

start_course_btn_action.forEach(btn=>{
    btn.addEventListener("click", function(){
        const course_id = this.getAttribute("data-course-id")
        course_request_read({courseid: course_id})
    })
})

//course display banner header button for closing the section and return back to the lecon list
const display_course_banner = document.getElementById("display-course")
const close_course_banner =  display_course_banner.querySelector("i").addEventListener("click", function(){
    //close it back to reopen the menu
    remove_hide_class(display_course_banner, "hide-course-banner")
    remove_hide_class(document.getElementById("course-nav-bar"), "hide-course-list-nav")
})