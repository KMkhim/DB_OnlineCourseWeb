<?php
    session_start();
    include_once '../config/db.php';
?>

<!-- ดึงข้อมูลจากฐานข้อมูล -->
<?php
   //echo $_SESSION["student_login"];
   
    if(isset($_SESSION["student_login"])){
        $student_id = $_SESSION["student_login"];
        $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $student_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);    
    }
    
?>
    <!-- สิ้นสุดการดึง -->

    
<?php 
    if($row["email"] != "" && $row["password"] != ""){
        include_once './stu_navbar.php';
    }else{
        include_once './base.php';
    }
?>  
   