// nav form button variables
const nav_form_login_btn = document.querySelector(".login-form-btn-nav")
const nav_form_signup_btn = document.querySelector(".signup-form-btn-nav")
// forms
const login_form = document.getElementById("login-form")
const signup_form = document.getElementById("signup-form")
// classList
const active_nav_btn_class = "active-menu-option"
const active_form_class = "disable-form"
// create function to toggle class for form selected
// function select_form(nav_el, form_el, nav_class, form_class){

// }

nav_form_login_btn.onclick = function () {
    this.classList.add(active_nav_btn_class)
    nav_form_signup_btn.classList.remove(active_nav_btn_class)
    login_form.classList.remove(active_form_class)
    signup_form.classList.add(active_form_class)
    // when user as chosen login section
    document.getElementById("side-panel-form").style.transition = "0.2s"
    display_text_side_pannel("Se connecter")
}

nav_form_signup_btn.onclick = function () {
    nav_form_login_btn.classList.remove(active_nav_btn_class)
    this.classList.add(active_nav_btn_class)
    login_form.classList.add(active_form_class)
    signup_form.classList.remove(active_form_class)
    display_text_side_pannel("S'inscrire")
}

// function for showing txt into the side pannel
const side_panel = document.getElementById("side-panel-form")
if(side_panel){
    function display_text_side_pannel(text){
        side_panel.querySelector("div").innerText = text
    }
    if(nav_form_login_btn.classList.contains(active_nav_btn_class)){
        display_text_side_pannel("Se connecter")
    }else{
        display_text_side_pannel("S'inscrire")
    }
}

// disable form button by default validating button login/register
const forms = document.querySelectorAll("form")
forms.forEach(form => {
    form.querySelector("button").disabled = true
})

//
// function for displaying warns
function display_warning_form(el, color, msg) {
    el.textContent = msg
    el.style.color = color
}
// login condition
login_form.oninput = function () {
    if (this.checkValidity()) {
        // verify pwd length
        if (this.querySelector("#password-field-login").value.length >= 8) {
            display_warning_form(this.querySelector(".field-warning-login"), "green", "Connectez vous")
            login_form.querySelector("button").disabled = false
        } else {
            display_warning_form(this.querySelector(".field-warning-login"), "red", "Votre mot de passe doit etre de 8 caratere minimun")
        }
    } else {
        display_warning_form(this.querySelector(".field-warning-login"), "red", "Remplissez les champs pour vous connecter")
    }
}

// signup field condition

const name_regex = /[^0-9]/ //add a regex exception for field  name, user name

signup_form.oninput = function () {
    // check form validity
    if (this.checkValidity()) {
        display_warning_form(this.querySelector(".field-warning-signup"), "green", "Cliquez sur le bouton ci-dessous pour vous inscrire")
        this.querySelector("button").disabled = false
    } else {
        display_warning_form(this.querySelector(".field-warning-signup"), "red", "Formulaire non valide. Remplissez tous les champs")
    }
}
