<?php
$db_hostname = "localhost";
$db_u_name = "sam";
$db_pwd = "lucsamuel";
$db_name = "tech2code";

try{
    $db_connect = new mysqli($db_hostname, $db_u_name, $db_pwd, $db_name);
}catch(mysqli_sql_exception $e){
    echo "Failed connexion";
    die;
}

