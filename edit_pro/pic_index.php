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
    <title>PHP Upload Image System</title>
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
                        
                    ?>
                </div>
            <?php } ?>
    </div>
    
    <div class="container">
    <br>
    <br>
    <br>
    <button onclick="window.location.href='../page/instructor.php'" class="btn btn-sm btn-secondary ">
    ← ย้อนกลับ
    </button> 
    <br>
    <br>
    <h3>Edit Profile</h3>
    <hr>  
        <div class="row mt-5">
            <div class="col-12">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tutorname" class="form-label">Tutorname</label>
                        <input type="text" class="form-control" name="submit_tutorname" ><br>
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Change Tutor name</button>
                    </div>
                </form>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="submit_description"><br>
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Change Description</button>
                    </div>
                </form>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Select <strong>Profile</strong>  Image</label>
                        <input type="file" name="file" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                    </div>
                    
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="submit" name="submit" value="submit" class="btn btn-sm btn-primary mb-3">
                    </div>
                </form>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="description" class="form-label">Select<strong> Cover</strong> Image</label>
                        <input type="file" name="file_name2" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                        <!-- <input type="submit_file2" name="submit" value="upload" class="btn btn-sm btn-primary mb-3"> -->
                    </div>
                    
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="submit" name="submit_1" value="submit" class="btn btn-sm btn-primary mb-3">
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
                        header('location: ../page/instructor.php');
                    ?>
                </div>
            <?php } ?>
        </div>
           
        
    
</body>
</html>