<?php 

session_start();
include_once '../config/db.php';
if(!isset($_SESSION["instructor_login"]) && !isset($_SESSION["course_manager_login"]) ){
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบ"; 
    header("location: ../regis/signin.php");

}    if(isset($_SESSION["course_manager_login"])){
        $courseManager_id = $_SESSION["course_manager_login"];
        echo $courseManager_id;
        $stmt = $conn->query("SELECT * FROM Course_Manager WHERE user_id =  $courseManager_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);   
        $manager_id = $row["cm_id"];
        echo $manager_id;

    }






if (isset($_POST['submit_title'])){
    $title = $_POST['title'];
    $course_id = $_POST['submit_title'];
   
    $sql = "UPDATE Courses
            SET title = '$title' , updated_at = CURRENT_TIME()
            WHERE course_id = $course_id
            ";
   
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The Title <b>" . $title .  "</b> has been updated successfully.";
        if($_SESSION["course_manager_login"]){
           
            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'edit_COURSE_title',CURRENT_TIME())";
            
            $conn->query($sql);
           
        echo "khim";   
            header("location: ../page/course_manager.php");
        }else{
        
            header("location: ../page/instructor.php");
        } 
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_course_index.php");
    }
}

if (isset($_POST['submit_desc'])){
    $desc = $_POST['description'];
    $course_id = $_POST['submit_desc'];
    $sql = "UPDATE Courses
            SET description = '$desc' , updated_at = CURRENT_TIME()
            WHERE course_id = $course_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The Description <b>" . $description .  "</b> has been updated successfully.";
        if($_SESSION["course_manager_login"]){
            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'edit_COURSE_description',CURRENT_TIME())";
            $conn->query($sql);
           header("location: ../page/course_manager.php");
        }else{
            echo "not khim";
           header("location: ../page/instructor.php");
        }
           
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_course_index.php");
    }
}

if (isset($_POST['submit_category'])){
    echo "khim";
   
    $category = $_POST['category'];
    echo $category;
    $course_id = $_POST['submit_category'];
    $sql = "UPDATE Courses
            SET category = '$category' , updated_at = CURRENT_TIME()
            WHERE course_id = $course_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The Category <b>" . $category .  "</b> has been updated successfully.";
        if($_SESSION["course_manager_login"]){
            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'edit_COURSE_Category',CURRENT_TIME())";
            $conn->query($sql);
           header("location: ../page/course_manager.php");
        }else{
             echo "not khim";
           header("location: ../page/instructor.php");
       }
           
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_course_index.php");
    }
}

if (isset($_POST['submit_duration'])){
    $duration = $_POST['duration'];
    $course_id = $_POST['submit_duration'];
    $sql = "UPDATE Courses
            SET duration = '$duration' , updated_at = CURRENT_TIME()
            WHERE course_id = $course_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The Duration <b>" . $duration .  "</b> has been updated successfully.";
        if($_SESSION["course_manager_login"]){
            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'edit_COURSE_Duration',CURRENT_TIME())";
            $conn->query($sql);
           header("location: ../page/course_manager.php");
        }else{
            echo "not khim";
           header("location: ../page/instructor.php");
       }
           
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_course_index.php");
    }
}

if (isset($_POST['submit_price'])){
    $price = $_POST['price'];
    $course_id = $_POST['submit_price'];
    $sql = "UPDATE Courses
            SET price = '$price' , updated_at = CURRENT_TIME()
            WHERE course_id = $course_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The price <b>" . $price .  "</b> has been updated successfully.";
        if($_SESSION["course_manager_login"]){
            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'edit_COURSE_Price',CURRENT_TIME())";
            $conn->query($sql);
           header("location: ../page/course_manager.php");
            }else{
            echo "not khim";
           header("location: ../page/instructor.php");
       }
           
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_course_index.php");
    }
}


$targetDir = 'course_pro/';

if (isset($_POST['submit_image'])) {

    $course_id = $_POST['submit_image'];
    

    if (!empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        echo $targetFilePath;


        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        if (in_array($fileType, $allowTypes)) {
            if ((move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) ) {
                // echo gettype($user_id) . " ";
                echo '".$fileName."';
               

        
                $sql = "UPDATE Courses
                        SET file_name = '$fileName' , updated_at = CURRENT_TIME()
                        WHERE course_id = $course_id
                        ";
                
                $insert = $conn->query($sql);
                
                if ($insert) {
                    $_SESSION['statusMsg'] = "The file <b>" . $fileName .  "</b> has been uploaded successfully.";
                    if($_SESSION["course_manager_login"]){
                        $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                                VALUES($manager_id,$course_id,'edit_COURSE_image',CURRENT_TIME())";
                        $conn->query($sql);
                       header("location: ../page/course_manager.php");
                    }else{
                        
                       header("location: ../page/instructor.php");
                   }
                } else {
                    $_SESSION['statusMsg'] = "File upload failed, please try again.";
                    header("location: ./edit_course_index.php");
                }
            } else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("location: ./edit_course_index.php");
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: ./edit_course_index.php");
        }
    } else {
        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: ./edit_course.php");
    }
}



if (isset($_POST['submit_delete'])) {
    $course_id = $_POST['submit_delete'];
    echo $course_id . "from delete";

    $sql = "DELETE FROM Courses
            WHERE course_id = $course_id
            ";
    echo $sql;
    $insert = $conn->query($sql);

    echo "khim";
    if ($insert) {
        $_SESSION['statusMsg'] = "course <b> has been delete .";
        if($_SESSION["course_manager_login"]){

            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'Delete Course',CURRENT_TIME())";
            $conn->query($sql);
            header("location: ../page/course_manager.php");
        }else{
            echo "not khim";
            header("location: ../page/instructor.php");
        }
       
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_course_index.php");
    }
}

