<?php 

session_start();
include_once '../../config/db.php';
if(!isset($_SESSION["student_login"])){
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
    header("location: ../regis/signin.php");
}



if(isset($_SESSION["student_login"])){
        $user_id = $_SESSION["student_login"];
        $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);  
        
        $stmt1 = $conn->query("SELECT * FROM STUDENT WHERE user_id = $user_id");
        $stmt1->execute();
        $row_student = $stmt1->fetch(PDO::FETCH_ASSOC);   
}

$stu_id = $row_student['stu_id'];



if (isset($_POST['submit_fname'])){
    $fname = $_POST['fname'];
    $sql = "UPDATE Users
            SET fname = '$fname'
            WHERE user_id = $user_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The firstname <b>" . $fname .  "</b> has been updated successfully.";
        header("location: ../../page/student.php");
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./student_pro_index.php");
    }
}

if (isset($_POST['submit_lname'])){
    $lname = $_POST['lname'];
    $sql = "UPDATE Users
            SET lname = '$lname'
            WHERE user_id = $user_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The surname <b>" . $lname .  "</b> has been updated successfully.";
        header("location: ../../page/student.php");
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./student_pro_index.php");
    }
}

$targetDir = 'stu_pic/';
echo "hi1";
if (isset($_POST['submit'])) { 
    echo "hi2";// ตรวจสอบว่าปุ่ม submit ถูกกด
    echo "khim";
    if (!empty($_FILES["file"]["name"])) { // ตรวจสอบว่ามีการเลือกไฟล์หรือไม่
        $fileName = basename($_FILES["file"]["name"]); // รับชื่อไฟล์
        $targetFilePath = $targetDir . $fileName; // กำหนดพาธที่จะจัดเก็บไฟล์
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // รับประเภทไฟล์
        
        // ประเภทไฟล์ที่อนุญาต
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($fileType, $allowTypes)) {
            // ย้ายไฟล์ไปยังตำแหน่งที่กำหนด
            
            if (copy($_FILES['file']['tmp_name'], $targetFilePath)) {
                $k = 1;
                $sql = "UPDATE STUDENT
                        SET filename = '$fileName' 
                        WHERE user_id = $user_id ";
                 $insert = $conn->query($sql);

                $_SESSION['statusMsg'] = "The file <b>" . $fileName .  "</b> has been uploaded successfully.";
                header("location: ../page/student_pro.php");
                exit(); // หยุดการทำงานหลังจากรีไดเร็กต์
            } else {
                
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file." ;
                header("location: ./student_pro_index.php");
                exit();
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: ./student_pro_index.php");
            exit();
        }
    } else {
        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: ./student_pro_index.php");
        exit();
    }
}



