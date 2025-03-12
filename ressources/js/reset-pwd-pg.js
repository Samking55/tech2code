// function for creating popup
function set_popup(msg, bgColor, timeout) {
    const divPopup = document.createElement("div")
    const popupMsgContainer = document.createElement("div")
    // set id to popup
    divPopup.id = "popup";
    // set message
    popupMsgContainer.textContent = msg
    divPopup.style.backgroundColor = bgColor
    // append child
    document.body.appendChild(divPopup)
    divPopup.appendChild(popupMsgContainer)
    setTimeout(function () {
        divPopup.classList.add("hide-popup")
    }, timeout - 900)
    setTimeout(function () {
        divPopup.remove()
    }, timeout)
}

const success_popup_bgColor = "#3BB472"
const failed_popup_bgColor = "#E11515"


// async function for sending post request to backend server
async function send_data(data, file, spin, form) {
    try {
        spin.style.display = "flex"
        const request = await fetch(file, {
            headers: { "Content-Type": "application/json" },
            method: "POST",
            body: JSON.stringify(data)
        })
        if (!request.ok) {
            throw new Error(request.status)
        }
        const response = await request.json()
        if (response.request_status == "success") {
            // display popup
            set_popup(response.request_msg, success_popup_bgColor, 6000)
            // call back function for a specify case
        } else if (response.request_status == "failed") {
            set_popup(response.request_msg, failed_popup_bgColor, 6000)
        }
    } catch (error) {
        console.log(error)
    } finally {
        // call last function
        spin.style.display = "none"
        form.reset()
    }
}



// create function for sending request to check if email exits
const rset_pwd_email_form = document.getElementById("reset-email-pwd-request")
if (rset_pwd_email_form) {
    rset_pwd_email_form.onsubmit = function (el) {
        // prevent reload
        el.preventDefault()
        // call loading function
        // disable pwd
        // verify if email input field contains more than one char
        if (document.getElementById("email").value !== "") {
            // send data to php backend
            send_data
                (
                    {
                        "request": "request_reset_link", "email": document.getElementById("email").value
                    },
                    "handle-pwd-rset-request.php",
                    document.getElementById("loader-container"),
                    rset_pwd_email_form
                )
        } else {
            set_popup("No entry", failed_popup_bgColor, 6000)
        }
    }
}

// function for setting new pwd reset
const pwd_reset_form = document.getElementById("new-pwd-setup-form")
// check if element exists
if (pwd_reset_form) {
    pwd_reset_form.onsubmit = function (el) {
        el.preventDefault()
        // fetch token, email, and token status from url
        const pageUrlParams = new URLSearchParams(window.location.search)
        const token = pageUrlParams.get("token")
        const reset_pwd_for = pageUrlParams.get("email")
        const token_state = pageUrlParams.get("token_alive")
        // check if pwd form first input is equal to sencond and has value
        if (document.getElementById("new-pwd-setup-field").value !== "" && document.getElementById("r-new-pwd-setup-field").value !== "") {
            if (document.getElementById("new-pwd-setup-field").value === document.getElementById("r-new-pwd-setup-field").value) {
                // fetch pwd data from form input
                const new_pwd_input = document.getElementById("new-pwd-setup-field").value
                const r_new_pwd_input = document.getElementById("r-new-pwd-setup-field").value
                // send data to php
                send_data({
                    "request": "set_new_pwd",  // set up request name
                    "token": token, //send token to php backend from the get link
                    "r_set_pwd_for": reset_pwd_for, //send email address from which the link has been clicked
                    "get_token_state": token_state, //token state
                    "new_pwd": new_pwd_input, //send new password
                    "r_new_pwd": r_new_pwd_input //send new password repeat

                },
                    "handle-pwd-rset-request.php", //set the backend php file
                    document.getElementById("loader-container"),
                    pwd_reset_form
                )
            } else {
                // if the passwords dont match send a popup
                set_popup("Vos mots de passe ne sont pas similaire.", failed_popup_bgColor, 6000)
            }
        } else {
            set_popup("No entry", failed_popup_bgColor, 6000)
        }
    }
}
