<?php
include("../server/user_session.php");
include("../server/db.php");

signup("name", "email", "password", "password_check",  $db_connect, "login.php");