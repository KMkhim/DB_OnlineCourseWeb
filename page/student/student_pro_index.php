<?php 

    session_start();
    include_once '../../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>


<div class="row">
    <?php  if (!empty($_SESSION['statusMsg'])) { ?>
         <div class="alert alert-success" role="alert">
        <?php 
            echo $_SESSION['statusMsg']; 
            unset($_SESSION['statusMsg']);
            //header('location: ../page/instructor.php');
        ?>
        </div>
    <?php } ?>
</div>

    <?php
        
        $length = strlen($text);
        $stu_id = substr($_GET['stu_id'],0,$length-4);
        //echo $stu_id;
        //$editUrl = "edit_course.php?course_id=" . $courseId;
   
        if(isset($_SESSION["student_login"])){
            $user_id = $_SESSION["student_login"];
            $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  
            
        }
    ?>
   
<div class="container">
   
    <br>
    <button onclick="window.location.href='../student.php'" class="btn btn-sm btn-secondary mb-3">
    ← ย้อนกลับ
    </button>

    <br>
    <h3>Edit Profile</h3>
    <hr>
    <form action="student_pro.php" method="post" enctype="multipart/form-data">
        <!-- First Name Section -->
        <div class="form-row">
            <div>
                <label for="fname" class="form-label">Change First Name: <?php echo $row['fname']; ?></label>
                <input type="text" class="form-control mb-2" name="fname">
                <button type="submit" name="submit_fname" class="btn btn-sm btn-primary mt-2">Change First Name</button>
            </div>
        </div>
         <!-- END First Name Section -->
        <hr>
        
        <!-- Last Name Section -->
        
        <div class="form-row">
            <div>
                <label for="lname" class="form-label">Change  Last Name: <?php echo $row['lname']; ?></label>
                <input type="text" class="form-control mb-2" name="lname">
                <button type="submit" name="submit_lname" class="btn btn-sm btn-primary mt-2">Change Last Name</button>
            </div>
        </div>
        <!-- END Last Name Section -->
        <hr>
    </form>  
        <!-- Profile Picture Section -->
        <form action="student_pro.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Select <strong>Profile</strong>  Image</label>
                        <input type="file" name="file" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                    </div>
                    
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="submit" name="submit" value="submit" class="btn btn-sm btn-primary mb-3">
                    </div>
        </form>
       
                
        
        <!-- <div class="form-row">
            <div>
                <label for="file" class="form-label">Select <strong>Profile</strong> Image</label>
                <input type="file" name="file" class="form-control mb-2" accept="image/gif, image/jpeg, image/png">
                <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                <input type="submit" name="submit" value="Change Profile Picture" class="btn btn-sm btn-primary mb-3">
                
            </div>
        </div> -->


    <hr>
    <br>
</div>




           
        
    
</body>
</html>


