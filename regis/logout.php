<?php
    session_start();
    unset($_SESSION["student_login"]);
    unset($_SESSION["course_manager_login"]);
    unset($_SESSION["instructor_login"]);
    header("location: ../page/home.php");
    
?>