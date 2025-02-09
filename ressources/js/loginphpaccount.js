//select  element overlay
const login_overlay_btn = document.querySelector(".login-overlay-btn")
login_overlay_btn.addEventListener("click", function(){
    toggle_overlay('[data-overlay-form=signup]', "overlay-closed")
    toggle_overlay('[data-overlay-form=login]', "overlay-closed")
})

const register_overlay_btn = document.querySelector(".register-overlay-btn")
register_overlay_btn.addEventListener("click", function(){
    toggle_overlay('[data-overlay-form=signup]', "overlay-closed")
    toggle_overlay('[data-overlay-form=login]', "overlay-closed")
})


function toggle_overlay(overlay, class_name){
    document.querySelector(overlay).classList.toggle(class_name)
}

//verify password match on input

const pwd_field_check = document.querySelectorAll("[data-pwd]")
const state = document.querySelector(".pwd_state")
pwd_field_check.forEach(function(el){
    el.addEventListener("input", function(){
        const pwd_field = document.getElementById("password-field-signup").value
        const pwd_field_check = document.getElementById("password-repeat-signup").value
        if(pwd_field)
        if(pwd_field !== "" && pwd_field_check !== ""){
            if(pwd_field !== pwd_field_check){
                state.innerHTML = "Votre mot de passe ne correspond pas"
                state.style.color = "red"
            }else{
                state.innerHTML = "<i class='fa-solid fa-circle-check'></i>"
                state.style.color = "green"
            }
        }else{
            state.innerHTML = ""
        }
    })
})