<?php
// include db
include("../server/db.php");
// fetch data
$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($data) && $data) {
        // verify and change user password
        $user_id = filter_var($data["request_from_id"], FILTER_SANITIZE_SPECIAL_CHARS);
        $user_last_pwd = filter_var($data["user_last_password"], FILTER_SANITIZE_SPECIAL_CHARS);
        $user_new_pwd = filter_var($data["new_password"], FILTER_SANITIZE_SPECIAL_CHARS);
        $user_pwd_repeat = filter_var($data["new_password_repeat"], FILTER_SANITIZE_SPECIAL_CHARS);
        // check password
        // if both new passwords match
        if ($user_new_pwd == $user_pwd_repeat) {
            if(isset($user_id)) {
                // declare query for fetching password hash
                $fetch_matching_pwd = "SELECT user_pwd FROM users WHERE ID = '$user_id'";
                $query = $db_connect->query($fetch_matching_pwd);
                $row = $query->fetch_assoc();
                // verify password hash
                if(password_verify($user_last_pwd ,$row["user_pwd"])){
                     // check db if the old password enterered matches db records
                    //  if password matches recors, hash the new one
                    $hashed_pwd = password_hash($user_new_pwd, PASSWORD_DEFAULT);
                    //  query update
                    $query_update = "UPDATE users SET user_pwd = '$hashed_pwd' WHERE ID = '$user_id' ";
                    $query = $db_connect->query($query_update);
                    if($query){
                        $response = [
                            "request_status" => "succeed",
                            "message" => "Votre mot de passe a ete mise a jour"
                        ];
                        echo json_encode($response);
                    }
                }else{
                    $response = [
                        "request_status" => "failed",
                        "message" => "Votre mot de passe actuel ne correspond a aucune donnee stockee sur nos serveur. Reinitialisez votre mot de passe si vous l'avez oublie"
                    ];
                    echo json_encode($response);
                }
            }else{
                $response = [
                    "request_status" => "failed",
                    "message" => "Utilisateur non defini. Etes vous connectes ?"
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                "request_status" => "failed",
                "message" => "Les mots de passe ne correspondent pas. 
                Verifiez bien que votre nouveau mot de passe est exactement ce que vous avez entrez au deuxieme champ"
            ];
            echo json_encode($response);
        }
    }
} else {
    header("Location: ../index.php");
}
