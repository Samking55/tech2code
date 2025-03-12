// user password modify function
// popup container
const popup_container = document.getElementById("popup")
// color for success ord failed message
const success_popup_color = "#3BB472"
const failed_popup_color = "#EE0709"
// function for displaying popup for the profile settings
function display_popup(popup, message_popup_content, classname, popup_msg_container, popup_color, time){
    popup.style.backgroundColor = popup_color
    popup.classList.remove(classname)
    popup_msg_container.textContent = message_popup_content
    setTimeout(function(){
        popup.classList.add(classname)
    }, time)
}
// query to server for send password modification info
async function change_pwd(data) {
    try {
        const request = await fetch("../profile_settings/change-pwd-account.php", {
            headers: { "Content-Type": "application/json" },
            method: "POST",
            body: JSON.stringify(data)
        })
        if (!request.ok) {
            console.log(request.status)
            throw new Error(request.status)
        }

        const response = await request.json()
        // reponses variables
        if (response.request_status == "succeed") {
            let request_ms = response.message
            display_popup(popup_container, request_ms, "hide-popup", document.querySelector(".popup-msg"), success_popup_color, 6000)
        } else if (response.request_status == "failed") {
            let request_ms = response.message
            display_popup(popup_container, request_ms, "hide-popup", document.querySelector(".popup-msg"), failed_popup_color, 6000)
            
        }

    } catch (error) {
        console.error("Error happened" + error.message)
    }

}

// check pwd inputs
function check_pwd_input() {
    // inputs variables
    const old_pwd_field = document.getElementById("current-pwd")
    // user password new input field
    const new_pwd_field = document.getElementById("new-pwd")
    // repeat pwd
    const new_pwd_field_r = document.getElementById("r-new-pwd")
    document.querySelector(".save-new-pwd").disabled = true
    // check if there is input
    if (!old_pwd_field.value == "" && !new_pwd_field.value == "" && !new_pwd_field_r.value == "") {
        if (new_pwd_field.value == new_pwd_field_r.value) {
            document.querySelector(".save-new-pwd").disabled = false
        } else {
            document.querySelector(".save-new-pwd").disabled = true
        }
    } else {
        document.querySelector(".save-new-pwd").disabled = true
    }
}
check_pwd_input()
document.getElementById("current-pwd").oninput = function () {
    check_pwd_input()
}
document.getElementById("new-pwd").oninput = function () {
    check_pwd_input()
}
document.getElementById("r-new-pwd").oninput = function () {
    check_pwd_input()
}

// toggole on click event
// form
const modify_pwd_form = document.getElementById("modify-pwd-form")

modify_pwd_form.onsubmit = function (el) {
    el.preventDefault()
}
document.querySelector(".save-new-pwd").onclick = function () {
    // check if new and last password matche
    if (document.getElementById("new-pwd").value == document.getElementById("r-new-pwd").value) {
        change_pwd({
            "request_from_id": this.getAttribute("data-account-id"),
            "user_last_password": document.getElementById("current-pwd").value,
            "new_password": document.getElementById("new-pwd").value,
            "new_password_repeat": document.getElementById("r-new-pwd").value
        })
        modify_pwd_form.reset()
    } else {
        alert("Vos mot de passe ne correspondent pas")
    }
}

// dark mode

// dark mode end

// popup warning for showing warnings to user before redirecting them to another link
function toggle_warning(popup_warning, text_popup_warning, classname, warning_popup_msg_container){
    popup_warning.classList.remove(classname)
    warning_popup_msg_container.textContent = text_popup_warning
}
const warning_box_container = document.querySelector(".confirm-box-container")
document.querySelector(".become-teacher").onclick = function(){
    const warning_text = "En cliquant sur OK vous quitterez la plateforme LearnSkillNow. Voulez-vous continuer ?"
    toggle_warning(warning_box_container, warning_text, "hide-popup-warning", document.querySelector(".warning-msg"))
    document.querySelector(".confirm-btn").onclick = function(){
        window.open("https://jobs.learnskillnow.space")
        window.location.href = "../account/logout.php"
        warning_box_container.classList.add("hide-popup-warning")
    }
    document.querySelector(".deny-btn").onclick = function(){
        warning_box_container.classList.add("hide-popup-warning")
    }
}
