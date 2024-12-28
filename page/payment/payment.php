<?php 

    session_start();
    include_once '../../config/db.php';




if(isset($_SESSION["student_login"])){
    $stu_id = $_SESSION["student_login"];
    $stmt = $conn->query("SELECT * FROM STUDENT WHERE user_id = $stu_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);    
}

if(isset($_SESSION["student_login"])){
    $user_id = $_SESSION["student_login"];
    //echo $user_id;
    $stmt = $conn->query("SELECT * FROM Enrollment
                         WHERE stu_id IN (SELECT stu_id FROM STUDENT
                                        WHERE user_id = $user_id)");

    $stmt->execute();
    $row_enroll = $stmt->fetch(PDO::FETCH_ASSOC);  
    
   

}

$targetDir = 'paypay/';

if (isset($_POST['submit'])) {

    $date = $_POST['date'];
    $time = $_POST['time'];
    $enroll_id = $_POST['submit'];
    //echo $enroll_id;
    
    if (!empty($_FILES["file"]["name"])) {
       
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        //echo $targetFilePath;
        //echo $fileName;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        
        if (in_array($fileType, $allowTypes)) {
            if ((move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) ) {
                    $sql = "INSERT INTO Payment(enroll_id, Ddate , Ttime , file_name, uploaded_on)
                            VALUES ('$enroll_id','$date','$time','".$fileName."', NOW())";  
                        
                    $conn->query($sql);
                    
                    $sql = "UPDATE Enrollment
                            SET payment_status = 2
                            WHERE enroll_id = $enroll_id ";
                    $insert = $conn->query($sql);
            
                    if ($insert) {
                        $_SESSION['statusMsg'] = "The file <b>" . $fileName .  "</b> has been uploaded successfully.";
                        $_SESSION["enroll"] = "รอเจ้าหน้าที่ยืนยัน";
                        header("location: ../enroll/enrollment_index.php");
                    } else {
                        $_SESSION['statusMsg'] = "File upload failed, please try again.";
                        header("location: ./payment_index.php");
                    }
            }else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("location: ./student_pro_index.php");
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: ./student_pro_index.php");
        }
    } else {
    $_SESSION['statusMsg'] = "Please select a file to upload.";
    header("location: ./student_pro_index.php");
    }
}
  
    
      
             








