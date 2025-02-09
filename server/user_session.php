<?php
function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}

function login($user_mail, $user_pwd, $db_request, $to)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $mail = filter_input(INPUT_POST, "$user_mail", FILTER_SANITIZE_SPECIAL_CHARS);
        $pwd = filter_input(INPUT_POST, "$user_pwd", FILTER_SANITIZE_SPECIAL_CHARS);
        //get all the rows
        $query = "SELECT * FROM tech2code WHERE u_email = '$mail'";
        $fetch_row = $db_request->query($query);
        if ($data = $fetch_row->fetch_assoc()) {
            if (password_verify($pwd, $data["u_password"])) {
                session_regenerate_id();
                $_SESSION["user_id"] = $data["id"];
                $_SESSION["user_name"] = $data["u_name"];
                $_SESSION["user_mail"] = $data["u_email"];
                header("Location: $to");
            }else{
                exit;
            }
        } else {
            exit;
        }
    }
}

function signup($user_name, $user_mail, $user_pwd, $user_pwd_check, $db, $to)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $name = filter_input(INPUT_POST, "$user_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $mail = filter_input(INPUT_POST, "$user_mail", FILTER_SANITIZE_SPECIAL_CHARS);
        $pwd = filter_input(INPUT_POST, "$user_pwd", FILTER_SANITIZE_SPECIAL_CHARS);
        $pwd_check = filter_input(INPUT_POST, "$user_pwd_check", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($pwd === $pwd_check) {
            $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $query = "INSERT INTO tech2code(u_name, u_email, u_password)
            VALUES ('$name', '$mail', '$hashed_pwd')";
            if ($db->query($query)) {
                header("Location: $to");
            }
        }else{
            exit;
        }
    }
}
