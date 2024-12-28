<?php 

    session_start();
    include_once '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    
    
    if (isset($_POST['submit'])) {
        $course_id = $_POST['submit'];
        $lesson_name = $_POST['lesson_name'];
        $content = $_POST['content'];
        $video_url = $_POST['video_url'];
        
        $sql = "INSERT INTO Lessons(course_id,lesson_name,content,video_url, created_at,updated_at)
                        VALUES ('$course_id','$lesson_name','$content','$video_url', CURRENT_TIME() ,CURRENT_TIME() )";  
        //  $sql = "INSERT INTO Courses(user_id,title,description,category,file_name, uploaded_on , duration , created_at,updated_at)
        //                 VALUES ('$user_id','$title','$description','$category','".$fileName."', NOW(), $duration , CURRENT_TIME() ,CURRENT_TIME() )";  
        
       
        $insert = $conn->query($sql);
        
        if ($insert) {
            $_SESSION['statusMsg'] = "The Lesson <b>" . $lesson_name .  "</b> has been uploaded successfully.";
            header("location: ./lesson_index.php?course_id=" . $course_id . "1234");
        } else {
            $_SESSION['statusMsg'] = "File upload failed, please try again.";
            header("location: ./add_lesson_index.php");
        }
    }
?>
</body>
</html>