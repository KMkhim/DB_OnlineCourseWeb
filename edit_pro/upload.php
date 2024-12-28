<?php 

session_start();
include_once '../config/db.php';

if(isset($_SESSION["instructor_login"])){
    $instructure_id = $_SESSION["instructor_login"];
    $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $instructure_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);    



    $stmt1 = $conn->query("SELECT * FROM INSTRUCTOR WHERE user_id = $instructure_id");
    $stmt1->execute();
    $row_tutor = $stmt1->fetch(PDO::FETCH_ASSOC);    
}

$user_id = $row['user_id'];
$inst_id = $row_tutor['inst_id'];
echo $inst_id;



if (isset($_POST['submit_tutorname'])){
    
    $tutorname = $_POST['submit_tutorname']; 
    $sql = "UPDATE INSTRUCTOR
            SET tutorname = '$tutorname' 
            WHERE inst_id = $inst_id
            ";
    $insert = $conn->query($sql);

    if ($insert) {
        $_SESSION['statusMsg'] = "The tutorname <b>" . $tutorname .  "</b> has been change successfully.";
        header("location: ../page/instructor.php");
    } else {
        $_SESSION['statusMsg'] = "File upload failed, please try again.";
        header("location: ./pic_index.php");
    }
}


if (isset($_POST['submit_description'])){
    
    $description = $_POST['submit_description']; 
    $sql = "UPDATE INSTRUCTOR
            SET description = '$description' 
            WHERE inst_id = $inst_id
            ";
    $insert = $conn->query($sql);

    if ($insert) {
        $_SESSION['statusMsg'] = "The description  has been change successfully.";
        header("location: ../page/instructor.php");
    } else {
        $_SESSION['statusMsg'] = "File upload failed, please try again.";
        header("location: ./pic_index.php");
    }
}


$targetDir = 'uploads/';

if (isset($_POST['submit'])) { // ตรวจสอบว่าปุ่ม submit ถูกกด
    if (!empty($_FILES["file"]["name"])) { // ตรวจสอบว่ามีการเลือกไฟล์หรือไม่
        $fileName = basename($_FILES["file"]["name"]); // รับชื่อไฟล์
        $targetFilePath = $targetDir . $fileName; // กำหนดพาธที่จะจัดเก็บไฟล์
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // รับประเภทไฟล์
        
        // ประเภทไฟล์ที่อนุญาต
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        
        // ตรวจสอบประเภทไฟล์
        if (in_array($fileType, $allowTypes)) {
            // ย้ายไฟล์ไปยังตำแหน่งที่กำหนด
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {

                $sql = "UPDATE INSTRUCTOR
                        SET file_name = '$fileName' 
                        WHERE inst_id = $inst_id ";
                 $insert = $conn->query($sql);





                $_SESSION['statusMsg'] = "The file <b>" . $fileName .  "</b> has been uploaded successfully.";
                header("location: ../page/instructor.php");
                exit(); // หยุดการทำงานหลังจากรีไดเร็กต์
            } else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("location: ./pic_index.php");
                exit();
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: ./pic_index.php");
            exit();
        }
    } else {
        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: ./pic_index.php");
        exit();
    }
}


// upload.php
if (isset($_POST['submit_1'])) { // ตรวจสอบว่าปุ่ม submit ถูกกด
    if (!empty($_FILES["file_name2"]["name"])) { // ตรวจสอบว่ามีการเลือกไฟล์หรือไม่
        $fileName = basename($_FILES["file_name2"]["name"]); // รับชื่อไฟล์
        $targetFilePath = $targetDir . $fileName; // กำหนดพาธที่จะจัดเก็บไฟล์
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // รับประเภทไฟล์
        
        // ประเภทไฟล์ที่อนุญาต
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        
        // ตรวจสอบประเภทไฟล์
        if (in_array($fileType, $allowTypes)) {
            // ย้ายไฟล์ไปยังตำแหน่งที่กำหนด
            if (move_uploaded_file($_FILES['file_name2']['tmp_name'], $targetFilePath)) {

                $sql = "UPDATE INSTRUCTOR
                        SET file_name2 = '$fileName' 
                        WHERE inst_id = $inst_id ";
                 $insert = $conn->query($sql);





                $_SESSION['statusMsg'] = "The file <b>" . $fileName .  "</b> has been uploaded successfully.";
                header("location: ../page/instructor.php");
                exit(); // หยุดการทำงานหลังจากรีไดเร็กต์
            } else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("location: ./pic_index.php");
                exit();
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: ./pic_index.php");
            exit();
        }
    } else {
        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: ./pic_index.php");
        exit();
    }
}



?>

