<?php
//initialize sessions
// to page will be defined in the target file for the redirection page in case the user is not connected or hsa not any active session

function check_session($to_page)
{
    session_start();
    global $user_session_id, $user_session_name, $user_session_mail;

    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_mail"])) {
        $user_session_id = $_SESSION["user_id"];
        $user_session_name = $_SESSION["user_name"];
        $user_session_mail = $_SESSION["user_mail"];
    } else {
        header("Location: $to_page");
    }
}
