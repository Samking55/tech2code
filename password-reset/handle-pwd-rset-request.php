<?php
// import db
include("../server/db.php");
// disable auto commit
$db_connect->autocommit(false);
// fetch request form js
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    // request for generating token, verify if email exist, and send email address for the reset link
    if (isset($data["request"]) && $data["request"] == "request_reset_link") {
        // fetch email from request and sanitize
        $email = filter_var($data["email"], FILTER_SANITIZE_EMAIL);
        // verify if email addrr exists in db
        if ($email) {
            // create query
            $query_check_email = "SELECT user_mail FROM users WHERE user_mail = '$email' ";
            // query
            $fetch_data = $db_connect->query($query_check_email);
            if ($q_data = $fetch_data->fetch_assoc()) {
                // if email exist create new token and store it into db then send the link via email
                try {
                    $token = bin2hex(random_bytes(60));
                    $q_email = $q_data["user_mail"]; //user email from db query
                    $reset_link = "http://localhost/tech2code/password-reset/reset.password?token=$token&email=$q_email&token_alive=true";
                    // store token data to db
                    $query_store_token = "INSERT INTO reset_pwd_token(token, email, token_alive_state) VALUES('$token', '$q_email', '1')";
                    // send email to user for
                    // set variables
                    $mail_service = "Password reset";
                    $recipient_addrr = $q_email;
                    $recipient_name = $q_email;
                    $mail_subject = "Reinitialisation du mot de passe";
                    $mail_body = "Vous avez demande a reiniatiliser votre mot de passe. Cliquez sur le lien ci-dessous. Si ce n'est pas vous
                    ignorez ce mail. $reset_link
                    ";
                    $mail_altbody = "Vous avez demande a reiniatiliser votre mot de passe. Cliquez sur le lien ci-dessous. Si ce n'est pas vous
                    ignorez ce mail. $reset_link
                    ";
                    // include php mailer file for sending mail
                    include("../mailer/mailer.php");
                    $mail->send(); // send email
                    // execute sql in mail has been sent
                    $db_connect->query($query_store_token);
                    // commit changes
                    $db_connect->commit();
                    // send result
                    echo json_encode([
                        "request_status" => "success",
                        "request_msg" => "Verifiez votre boite mail"
                    ]);
                } catch (Exception $e) {
                    // rollback transaction
                    $db_connect->rollback();
                    echo json_encode([
                        "request_status" => "failed",
                        "request_msg" => "Desole une erreur s'est produite. Veuillez reesayer plus tard"
                    ]);
                }
            } else {
                // send error response if the email addrr does not exists
                echo json_encode([
                    "request_status" => "failed",
                    "request_msg" => "Cette addresse email n'existe pas. Veuillez creer un compte pour nous rejoiundre"
                ]);
            }
        }
        $db_connect->close();
    } else if (isset($data["request"]) && $data["request"] == "set_new_pwd") {
        if (isset($data["token"], $data["r_set_pwd_for"], $data["get_token_state"], $data["new_pwd"], $data["r_new_pwd"]) && $data["get_token_state"] == "true") {
            // password reset data function
            // handle password reset, get token, email, token state, token alive state
            $token = filter_var($data["token"], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($data["r_set_pwd_for"], FILTER_SANITIZE_EMAIL);
            $token_alive = filter_var($data["get_token_state"], FILTER_SANITIZE_SPECIAL_CHARS);
            $new_pwd = filter_var($data["new_pwd"], FILTER_SANITIZE_SPECIAL_CHARS);
            $r_new_pwd = filter_var($data["r_new_pwd"], FILTER_SANITIZE_SPECIAL_CHARS);
            // verify db for token
            $query_verify_token = "SELECT token FROM reset_pwd_token WHERE token = '$token' AND email = '$email' AND token_alive_state = '1'";
            $fetch_data = $db_connect->query($query_verify_token);
            if ($q_data = $fetch_data->fetch_assoc()) {
                // if token exists in db, fetch password, password repeat, compare them and if they match, update user pwd with email addrr
                if ($new_pwd === $r_new_pwd) {
                    $hashed_pwd = password_hash($new_pwd, PASSWORD_DEFAULT); //pwd hashed
                    $query_set_new_pwd = "UPDATE users SET user_pwd = '$hashed_pwd' WHERE user_mail = '$email'"; //new pwd query
                    try {
                        // disable auto commit
                        //$db_connect->autocommit(false);
                        // include and set mailer
                        $mail_service = "Password reset";
                        $recipient_addrr = $email;
                        $recipient_name = $email;
                        $mail_subject = "Vous avez changer votre mot de passe";
                        $mail_body = "Vous avez change votre mot de passe";
                        $mail_altbody = "Vous avez change votre mot de passe";
                        include("../mailer/mailer.php");
                        $mail->send(); // send email
                        // set query then set send email
                        $db_connect->query($query_set_new_pwd);
                        // set the user token to false
                        $query_disable_token = "UPDATE reset_pwd_token SET token_alive_state = '0' WHERE token = '$token' ";
                        $db_connect->query($query_disable_token);
                        // commit info
                        $db_connect->commit();
                        // send response back to user
                        echo json_encode([
                            "request_status" => "success",
                            "request_msg" => "succes de la mise a jour"
    
                        ]);
                    } catch (Exception $e) {
                        // rollback transaction
                        $db_connect->rollback();
                        // send error notificatiion
                        echo json_encode([
                            "request_status" => "failed",
                            "request_msg" => "$e"
    
                        ]);
                    }
                } else {
                    echo json_encode([
                        "request_status" => "failed",
                        "request_msg" => "Vos mots de passe ne sont pas similaire. Reclamez un nouveau mot de passe et reesayez"

                    ]);
                }
            } else {
                echo json_encode([
                    "request_status" => "failed",
                    "request_msg" => "Impossible de proceder a une reiniatialisation. Votre lien devrait etre invalide ou a expire"

                ]);
            }
        } else {
            echo json_encode([
                "request_status" => "failed",
                "request_msg" => "Impossible de proceder a une reiniatialisation. Votre lien devrait etre invalide ou expire"

            ]);
        }
    } else {
        echo json_encode([
            "request_status" => "failed",
            "request_msg" => "Echec"
        ]);
        $db_connect->close();
    }
}

// echo json_encode(["request_status" => "success", 
// "request_msg" => "Verifiez votre boite mail"]);