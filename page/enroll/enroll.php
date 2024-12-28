<?php 

session_start();
include_once '../../config/db.php';
if(!isset($_SESSION["student_login"])){
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
    header("location: ../../regis/signin.php");
}





if(isset($_SESSION["student_login"])){
    $user_id = $_SESSION["student_login"];
    //echo $user_id;
    $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $user_id");
    $stmt->execute();
    $row_user = $stmt->fetch(PDO::FETCH_ASSOC);  
    
    $stmt_2 = $conn->query("SELECT * FROM STUDENT WHERE user_id = $user_id ");
    //echo $stmt;
    $stmt_2 -> execute();
    $row_student = $stmt_2->fetch(PDO::FETCH_ASSOC); 
    $stu_id = $row_student['stu_id'];

    $stmt_2 = $conn->query("SELECT * FROM Enrollment WHERE stu_id = $stu_id ");
    $stmt_2 -> execute();
    $row_enroll = $stmt_2->fetch(PDO::FETCH_ASSOC); 
    $enroll_id = $row_enroll['enroll_id'];
    
   
}

echo "khim";

if (isset($_POST['submit_enroll'])){
    
    $course_id = $_POST['submit_enroll'];
    
    echo $stu_id;

    
    // เตรียมคำสั่ง SQL เพื่อตรวจสอบข้อมูลใน Enrollment
    $stmt_4 = $conn->prepare("SELECT payment_status FROM Enrollment WHERE stu_id = :stu_id AND payment_status = 0");
    $stmt_4->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
    $stmt_4->execute();

    $rowCount = $stmt_4->rowCount();
    $stmt_4->fetch(PDO::FETCH_ASSOC);

    $stmt_5 = $conn->prepare("SELECT course_id FROM Enrollment WHERE stu_id = :stu_id AND payment_status > 0 AND course_id = $course_id ");
    $stmt_5->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
    $stmt_5->execute();

    $rowCount1 = $stmt_5->rowCount();
    $stmt_5->fetch(PDO::FETCH_ASSOC);

    
    if ($rowCount > 0 || $rowCount1 > 0) {
        $_SESSION['statusMsg'] = "Sorry ลงทะเบียนมากสุด 1 คอร์ส.". $rowCount1;
        header("location: ./enrollment_index.php");
    }else{
        $sql = "INSERT INTO Enrollment(stu_id,course_id)
                    VALUES($stu_id , $course_id)";
            
        $insert =$conn->query($sql);
        

        if ($insert) {
            $_SESSION['statusMsg'] = "The enroll <b>"  .$rowCount1. "</b> has been updated successfully.";
            header("location: ./enrollment_index.php");
        } else {
            $_SESSION['statusMsg'] = "Cannot updated, please try again.";
            header("location: ./enrollment_index.php");
        }
    
    
    
    }

   
   
}

if (isset($_POST['submit_delete'])){
    $course_id = $_POST['submit_delete'];
    echo $course_id;
    $sql_2  = "DELETE FROM `Enrollment`
                     WHERE `course_id` = $course_id AND payment_status = 0";
                                       
    
    $insert =$conn->query($sql_2);
    echo "khim4";
    
   

    if ($insert) {
        $_SESSION['statusMsg'] = "Course <b> has been delete .";
        header("location: ./enrollment_index.php");
    } else {
        $_SESSION['statusMsg'] = "Cannot delete, please try again.";
        header("location: ./enrollment_index.php");
    }
    
}