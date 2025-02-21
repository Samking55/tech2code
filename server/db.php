<?php
$db_hostname = "localhost";
$db_u_name = "root";
$db_pwd = "";
$db_name = "db";

try{
    $db_connect = new mysqli($db_hostname, $db_u_name, $db_pwd, $db_name);
}catch(mysqli_sql_exception $e){
    echo "Failed connexion";
    die;
}

