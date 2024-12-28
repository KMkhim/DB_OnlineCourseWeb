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
    <title>PHP Upload Course </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
<?php
    if(isset($_SESSION["student_login"])){
        $stu_id = $_SESSION["student_login"];
        $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $stu_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);    
        }
        $user_id = $row['user_id'];
         
        $length = strlen($text);
        $enrollId = substr($_GET['enroll_id'],0,$length-4);
        // echo $enrollId;
        
        // $sql = "SELECT * FROM enrolls WHERE  enroll_id = $enrollId  ORDER BY updated_at DESC
        //         ";
             
        // $stmt = $conn->query($sql);
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);  
?>

<div class="container mt-5" style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <h3 class="text-center mb-4">Payment Information</h3> <!-- ชื่อฟอร์ม -->
    <div class="row">
        <div class="col-12">
            <form action="payment.php" method="post" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" required>
                </div>

                <div class="mb-4">
                    <label for="time" class="form-label">Time</label>
                    <input type="time" class="form-control" name="time" required>
                </div>

                <div class="mb-4">
                    <label for="file" class="form-label">Select <strong>Transaction</strong> Image</label>
                    <input type="file" name="file" class="form-control" accept="image/gif, image/jpeg, image/png" required>
                    <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                </div> 

                <div class="d-sm-flex justify-content-end mt-4">
                    <input type="hidden" name="submit" value="<?php echo $enrollId ?>"> 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


                    
        
        
        
        
        
        
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
           
        
    
</body>
</html>