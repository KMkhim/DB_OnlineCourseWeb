<?php 

session_start();
include_once '../config/db.php';
if(!isset($_SESSION["instructor_login"]) && !$_SESSION["course_manager_login"]){
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
    header("location: ../regis/signin.php");
    
}
if(isset($_SESSION["course_manager_login"])){
    $courseManager_id = $_SESSION["course_manager_login"];
    $stmt = $conn->query("SELECT * FROM Course_Manager WHERE user_id =  $courseManager_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);   
    $manager_id = $row["cm_id"];

}



if (isset($_POST['submit_lesson_name'])){
    $lesson_name = $_POST['lesson_name'];
    $lesson_id = $_POST['submit_lesson_name'];
    
    $sql = "UPDATE Lessons
            SET lesson_name = '$lesson_name' , updated_at = CURRENT_TIME()
            WHERE lesson_id = $lesson_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The Lesson Name <b>" . $lesson_name .  "</b> has been updated successfully.";
        
        
        if($_SESSION["course_manager_login"]){
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt_1 = $conn->query($sql);
            $stmt_1->execute();
            $row = $stmt_1->fetch(PDO::FETCH_ASSOC);  
            $course_id = $row['course_id'];

            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'Change lesson Name',CURRENT_TIME())";
            $conn->query($sql);

            header("location: ../page/course_manager.php");
       }else{
    
            // ต้องมีห้ามลบ
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt = $conn->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  
            //
            header("location: ../edit_lesson/lesson_index.php?course_id=".$row['course_id']."1234");
        }  
       
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_lesson_index.php");
    }
}

if (isset($_POST['submit_content'])){
    $content = $_POST['content'];
    $lesson_id = $_POST['submit_content'];
    
    $sql = "UPDATE Lessons
            SET content = '$content' , updated_at = CURRENT_TIME()
            WHERE lesson_id = $lesson_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The Content <b>" . "</b> has been updated successfully.";
        if($_SESSION["course_manager_login"]){
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt_1 = $conn->query($sql);
            $stmt_1->execute();
            $row = $stmt_1->fetch(PDO::FETCH_ASSOC);  
            $course_id = $row['course_id'];

            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'Change Lesson Content',CURRENT_TIME())";
            $conn->query($sql);

            header("location: ../page/course_manager.php");
       }else{
    
            // ต้องมีห้ามลบ
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt = $conn->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  
            //
            header("location: ../edit_lesson/lesson_index.php?course_id=".$row['course_id']."1234");
        }  
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_lesson_index.php");
    }
}

if (isset($_POST['submit_video_url'])){
    $video_url = $_POST['video_url'];
    $lesson_id = $_POST['submit_video_url'];
    
    $sql = "UPDATE Lessons
            SET video_url = '$video_url' , updated_at = CURRENT_TIME()
            WHERE lesson_id = $lesson_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "The Video Url <b>" . "</b> has been updated successfully.";
        if($_SESSION["course_manager_login"]){
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt_1 = $conn->query($sql);
            $stmt_1->execute();
            $row = $stmt_1->fetch(PDO::FETCH_ASSOC);  
            $course_id = $row['course_id'];

            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'Change Lesson Video URL',CURRENT_TIME())";
            $conn->query($sql);

            header("location: ../page/course_manager.php");
       }else{
    
            // ต้องมีห้ามลบ
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt = $conn->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  
            //
            header("location: ../edit_lesson/lesson_index.php?course_id=".$row['course_id']."1234");
        }  
    } else {
        $_SESSION['statusMsg'] = "Cannot updated, please try again.";
        header("location: ./edit_lesson_index.php");
    }
}




if (isset($_POST['submit_delete'])){
    $lesson_id = $_POST['submit_delete'];
    echo $lesson_id . "from delete";
    $sql = "DELETE FROM Lessons
            WHERE lesson_id = $lesson_id
            ";
    $insert = $conn->query($sql);
    if ($insert) {
        $_SESSION['statusMsg'] = "lesson <b> has been delete .";
        if($_SESSION["course_manager_login"]){
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt_1 = $conn->query($sql);
            $stmt_1->execute();
            $row = $stmt_1->fetch(PDO::FETCH_ASSOC);  
            $course_id = $row['course_id'];

            $sql = "INSERT INTO Manage_CoursesAndLesson(manager_id,course_id,Action ,time)
                    VALUES($manager_id,$course_id,'Delete lesson',CURRENT_TIME())";
            $conn->query($sql);

            header("location: ../page/course_manager.php");
       }else{
    
            // ต้องมีห้ามลบ
            $sql = "SELECT * FROM Lessons WHERE lesson_id = $lesson_id";
            $stmt = $conn->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  
            //
            header("location: ../edit_lesson/lesson_index.php?course_id=".$row['course_id']."1234");
        }  
    } else {
        $_SESSION['statusMsg'] = "Cannot delete, please try again.";
        header("location: ./edit_lesson_index.php");
    }
    
}
