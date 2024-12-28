<?php 

    session_start();
    include_once '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Upload Course </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>


<?php 
     $length = strlen($text);
     $courseId = substr($_GET['course_id'],0,$length-4);
     //echo $courseId;
    
     if(isset($_SESSION["instructor_login"])){

        $sql = "SELECT * FROM Courses WHERE  course_id = $courseId  
                ORDER BY updated_at DESC
                ";
            $stmt = $conn->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  
            $rowCount = $stmt->rowCount();

     }  
  
  ?>

    <div class="container">
        
        <div class="row mt-5">
            <div class="col-12">
                <form action="add_lesson.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="lesson_name" class="form-label">Lesson name</label>
                        <input type="text" class="form-control" name="lesson_name" >
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="video_url" class="form-label">Video URL</label>
                        <input type="text" class="form-control" name="video_url" >
                    </div>

                    <div class="my-4"></div>


                    
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit" value="<?php echo $courseId?>"> <button type="submit" class="btn btn-sm btn-primary mb-3">Submit</button>
                    </div>
                   
                </form>
            </div>
        </div>



        <div class="row">
            <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['statusMsg']; 
                        unset($_SESSION['statusMsg']);
                        header('location: ./add_lesson_index.php');
                    ?>
                </div>
            <?php } ?>
        </div>
           
        
    
</body>
</html>