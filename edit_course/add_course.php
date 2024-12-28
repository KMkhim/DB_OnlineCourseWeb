<?php 

session_start();
include_once '../config/db.php';

if(isset($_SESSION["instructor_login"])){
    $instructure_id = $_SESSION["instructor_login"];
    $stmt = $conn->query("SELECT * FROM INSTRUCTOR WHERE user_id = $instructure_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);    
}

$inst_id = $row['inst_id'];


$targetDir = 'course_pro/';

// รับค่า timestamp ปัจจุบัน
$currentTime = time();
//echo gettype($currentTime);

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $duration = (int)$_POST['duration'];
    $price = $_POST['price'];
    
        

    if (!empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
       


        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        if (in_array($fileType, $allowTypes)) {
            if ((move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) ) {
                
              $sql = "INSERT INTO Courses(inst_id,title,description,category,file_name, uploaded_on , duration ,price, created_at,updated_at)
                        VALUES ('$inst_id','$title','$description','$category','".$fileName."', NOW(), $duration ,$price, CURRENT_TIME() ,CURRENT_TIME() )";  
                // $sql = "INSERT INTO tutor_pro(user_id,ttname,fname,lname,description,file_name, uploaded_on , file_name2)
                //         VALUES ('$user_id','$ttname','$fname','$lname','$description','".$fileName."', NOW(), '".$fileName2."')";
                
                echo "khim";
                $insert = $conn->query($sql);
                
                if ($insert) {
                    $_SESSION['statusMsg'] = "The file <b>" . $fileName .  "</b> has been uploaded successfully.";
                    header("location: ../page/instructor.php");
                } else {
                    $_SESSION['statusMsg'] = "File upload failed, please try again.";
                    header("location: ./add_course_index.php");
                }
            } else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("location: ./add_course_index.php");
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: ./add_course_index.php");
        }
    } else {
        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: ./add_course_index.php");
    }
}
