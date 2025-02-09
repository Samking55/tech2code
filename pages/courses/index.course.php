<?php
session_start();

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_mail"])) {
    $user_session_id = $_SESSION["user_id"];
    $user_session_name = $_SESSION["user_name"];
    $user_session_mail = $_SESSION["user_mail"];
}else{
    header("Location: ../../index.php");
}
