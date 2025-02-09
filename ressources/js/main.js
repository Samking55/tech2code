//display the profile box on click of the btn
const profile_btn = document.querySelector(".profile-btn")
const profile_section_container = document.getElementById("profile-section-container")
profile_btn.addEventListener("click", function(){
    remove_hide_class(profile_section_container, "hide")
})












//sets of functions
function remove_hide_class(el, class_name){
    el.classList.toggle(class_name)
}

function redirect(target_page){
    window.location.href = target_page
}