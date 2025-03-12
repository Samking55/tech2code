// toggle menu on click
const menu_btn = document.querySelector(".toggle-menu-mobile").addEventListener("click", function () {
    //check if the profile is toggle
    if (!document.getElementById("user-section").classList.contains("hide-user-section")) {
        document.getElementById("user-section").classList.add("hide-user-section")
    }
    toggle_class(document.getElementById("main_nav"), "hide-main-nav")
})

// toggle the profile section onclick
const profile_btn = document.querySelector(".profile-btn").addEventListener("click", function () {
    if (!document.getElementById("main_nav").classList.contains("hide-main-nav")) {
        document.getElementById("main_nav").classList.add("hide-main-nav")
    }
    toggle_class(document.getElementById("user-section"), "hide-user-section")
})

// if scrolling and either the nav or the profile section is toggled check and  toggle them off
window.addEventListener("scroll", function () {
    let pos = document.body.scrollTop || document.documentElement.scrollTop
    if (pos > 15) {
        if (!document.getElementById("main_nav").classList.contains("hide-main-nav")) {
            document.getElementById("main_nav").classList.add("hide-main-nav")
        }
        if (!document.getElementById("user-section").classList.contains("hide-user-section")) {
            document.getElementById("user-section").classList.add("hide-user-section")
        }
    }
})

// toggle dropdown menu onclick
document.querySelector("[data-item-menu='list_course_item']").addEventListener("click", () => {
    toggle_class(document.querySelector("[data-item-menu='dropdown']"), "hide-dropdown")
})

//sets of functions
//toggle class function will toggle element on click
function toggle_class(el, class_name) {
    el.classList.toggle(class_name)
}

function redirect(target_page) {
    window.location.href = target_page
}

//add function to check if the user clicks outsite the menu or profile section

// slides function
const slides = document.querySelectorAll(".slide")
// check if slides element exists
if (slides.length > 0) {

    var slideIndex = 0
    function updateSlides() {
        slides.forEach(slide => {
            slide.classList.remove("active")
        })
        slides[slideIndex].classList.add("active")
        // increment slides
        slideIndex++
        if (slideIndex >= slides.length) {
            slideIndex = 0
        }
    }

    updateSlides()
    setInterval(updateSlides, 7000)
}
