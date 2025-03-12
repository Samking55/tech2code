<?php
//connect to db
include("../server/db.php");
//access course request sent from the user, fetch all the details about it
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = json_decode(file_get_contents("php://input"), true);
    $query = "SELECT * FROM course WHERE ID = '$data[courseid]'";
    $course = $db_connect->query($query);
    if($course){
        $course = $course->fetch_assoc();
        echo json_encode($course);
    }
}