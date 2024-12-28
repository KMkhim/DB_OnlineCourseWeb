<?php
    session_start();
    require_once '../config/db.php';
    if(!isset($_SESSION["course_manager_login"])){
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header("location: ../register/signin.php");
    }
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course_manager Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
    /* Navbar สีดำ */
.navbar {
    background-color: black; /* ตั้งค่าสีพื้นหลังของ Navbar เป็นสีดำ */
}

.navbar .nav-link {
    color: white; /* ตั้งค่าสีฟ้อนต์เป็นสีขาว */
    position: relative;
    text-decoration: none;
    padding-bottom: 5px;
}

.navbar .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 50%;
    background-color: #007bff; /* สีบรรทัดใต้เมื่อ hover */
    transition: width 0.3s ease, left 0.3s ease;
}

.navbar .nav-link:hover::after {
    width: 100%;
    left: 0;
}

.navbar-toggler-icon {
    background-color: white; /* ตั้งค่าสีปุ่ม Toggle เป็นสีขาว */
}

    </style>

</head>
<nav class="navbar navbar-expand-lg position-sticky top-0" style="z-index: 1000;">
    <div class="container">
        <a class="nav-link" href="#">
            <img src="image/catblackicon.png" alt="Bootstrap" width="50" height="50" class="rounded float-start">
        </a>
        <a class="nav-link" href="./course_manager.php"> Profile </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                
                <button type="button" class="btn btn-light" onclick="location.href='../regis/logout.php'">Logout</button>
            </div>
        </div>
    </div>
</nav>


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



<body class=" bg-secondary text-white">
    <div class="container">
    
        <?php
            if(isset($_SESSION["course_manager_login"])){
                $user_id = $_SESSION["course_manager_login"];
                $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $user_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);    
            
        
                $stmt_2 = $conn->query("SELECT * FROM Course_Manager WHERE user_id = $user_id ");
                
                $stmt_2 -> execute();
                $row_CourseMana = $stmt_2->fetch(PDO::FETCH_ASSOC); 
                
                if($row_CourseMana["user_id"] == null){
                    $sql = "INSERT INTO Course_Manager (user_id)
                            VALUES('$user_id') ";
                    $conn->query($sql);
                }
            }
  
        
        ?>

        <div class="px-4 py-5 my-5 text-center bg-light text-dark">
            
            <h1 class="display-5 fw-bold">Name : <?php echo $row['fname'] . $row['lname']?></h1>
            <div class="col-lg-6 mx-auto">
            <p class="lead mb-4"><?php echo $row['role']?></p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
            </div>
            </div>
        </div>    
        
        <div class="px-4 py-5 my-5 text-center bg-light text-dark">
            <h1 class="display-8  text-body-emphasis">Student Table</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">ตารางนักเรียนในระบบ</p>
                <?php
                    $sql = "SELECT * FROM Users WHERE role = 'student' ";
                    $stmt_2 = $conn -> query($sql);
                    $stmt_2 -> execute();
            
                    $rowCount = $stmt_2->rowCount();
                
                ?>
            <table class="table ">
                <thead>
                
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">นามสกุล</th>
                        
                    </tr>
                </thead>
            <?php if($rowCount > 0 ): ?>
                <?php $count = 1; ?>
                <?php while($student = $stmt_2->fetch(PDO::FETCH_ASSOC)) : ?>
                    
                <tbody>
                        <tr class="table-primary">
                            <td><?php echo $count; $count++; ?></td>
                            <td><?php echo  $student['fname']; ?></td>
                            <td><?php echo $student['lname']; ?></td>
                            
                             
                        </tr>
                    </tbody>           
                <?php endwhile; ?>   
            <?php endif; ?>  
            
            </table>
        </div>
    
    </div>
    <div class="px-4 py-5 my-5 text-center bg-light text-dark">
            <h1 class="display-8  text-body-emphasis">Tutor Table</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">ตารางtutorในระบบ</p>
                <?php
                    $sql = "SELECT * FROM Users U,INSTRUCTOR I WHERE U.role = 'Instructor' AND U.user_id = I.user_id ";
                    $stmt_3 = $conn -> query($sql);
                    $stmt_3 -> execute();
            
                    $rowCount_1 = $stmt_3->rowCount();
                
                ?>
            <table class="table ">
                <thead>
                
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">tutorname</th>
                        <th scope="col">tutorid</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">นามสกุล</th>
                        
                    </tr>
                </thead>
            <?php if($rowCount_1 > 0 ): ?>
                <?php $count_1 = 1; ?>
                <?php while($instructor = $stmt_3->fetch(PDO::FETCH_ASSOC)) : ?>
                    
                <tbody>
                        <tr class="table-primary">
                            <td><?php echo $count_1; $count_1++; ?></td>
                            <td><?php echo  $instructor['tutorname']; ?></td>
                            <td><?php echo $instructor['inst_id']; ?></td>
                            <td><?php echo  $instructor['fname']; ?></td>
                            <td><?php echo $instructor['lname']; ?></td>
                            
                             
                        </tr>
                    </tbody>           
                <?php endwhile; ?>   
            <?php endif; ?>  
            
            </table>
        </div>
    </div>
    
    <!-- end tutor table -->
    
    <!-- Start Manage Course Table -->
    <div class="px-4 py-5 my-5 text-center bg-light text-dark">
            <h1 class="display-8  text-body-emphasis">Course Table</h1>
            <div class="col-lg-12 mx-auto">
                <p class="lead mb-4">คอร์สในระบบ</p>
                <?php
                    $sql = "SELECT * FROM Users U,INSTRUCTOR I , Courses C 
                                WHERE U.role = 'Instructor' 
                                AND U.user_id = I.user_id 
                                AND I.inst_id = C.inst_id
                                ";
                   $stmt_4 = $conn -> query($sql);
                   $stmt_4 -> execute();
           
                   $rowCount_2 = $stmt_4->rowCount();
                   
               ?>
           
           
           
               <table class="table  table-bordered">
                   <thead>
                   
                       <tr>
                           <th scope="col">index</th>
                           <th scope="col">tutorname</th>
                           <th scope="col">tutorid</th>
                           <th scope="col">courses</th>
                           <th scope="col">category</th>
                           <th scope="col">duration</th>
                           <th scope="col">price</th>
                           <th scope="col">created_at</th>
                           <th scope="col">updated_at</th>
                           <th scope="col">Delete or Edit</th>
                           
                       </tr>
                   </thead>
               <?php if($rowCount_2 > 0 ): ?>
                   <?php $count_2 = 1; ?>
                   <?php while($courses = $stmt_4->fetch(PDO::FETCH_ASSOC)) : ?>
                       
                   <tbody>
                           <tr class="table-primary">
                               <td><?php echo $count_2; $count_2++; ?></td>
                               <td><?php echo  $courses['tutorname']; ?></td>
                               <td><?php echo  $courses['inst_id']; ?></td>
                               <td><?php echo  $courses['title']; ?></td>
                               <td><?php echo  $courses['category']; ?></td>
                               <td><?php echo  $courses['duration']; ?></td>
                               <td><?php echo  $courses['price']; ?></td>
                               <td><?php echo  $courses['created_at']; ?></td>
                               <td><?php echo  $courses['updated_at']; ?></td>
                               <td>
                                <?php
                                    $editUrl = "../edit_course/edit_course_index.php?course_id=" . $courses['course_id'] . "1234"; ?>
                                    <a href="<?php echo $editUrl ?>" class="btn btn-success" name="edit" >delete OR edit</a>
                                </td>
                           </tr>
                       </tbody>           
                   <?php endwhile; ?>   
               <?php endif; ?>  
               
               </table>
           </div>
           </div>
    <!-- End Manage Course Table -->

    <!-- Start Manage Lesson Table -->
    <div class="px-4 py-5 my-5 text-center bg-light text-dark">
            <h1 class="display-8  text-body-emphasis">Lesson Table</h1>
            <div class="col-lg-12 mx-auto">
                <p class="lead mb-4">วิชาเรียนในระบบ</p>
                <?php
                    $sql = "SELECT * FROM Users U,INSTRUCTOR I , Courses C ,Lessons L
                                WHERE U.role = 'Instructor' 
                                AND U.user_id = I.user_id 
                                AND I.inst_id = C.inst_id
                                AND C.course_id = L.course_id
                                ";
                    $stmt_5 = $conn -> query($sql);
                    $stmt_5 -> execute();
            
                    $rowCount_3 = $stmt_5->rowCount();
                    
                ?>
            
            
            
                <table class="table  table-bordered">
                    <thead>
                    
                        <tr>
                            <th scope="col">index</th>
                            <th scope="col">tutorid</th>
                            <th scope="col">tutorname</th>
                            <th scope="col">courses</th>
                            <th scope="col">lesson</th>
                            <th scope="col">Delete OR Edit</th>
    
                        </tr>
                    </thead>
                <?php if($rowCount_3 > 0 ): ?>
                    <?php $count_3 = 1; ?>
                    <?php while($lesson = $stmt_5->fetch(PDO::FETCH_ASSOC)) : ?>
                        
                    <tbody>
                            <tr class="table-primary">
                                <td><?php echo $count_3; $count_3++; ?></td>
                                <td><?php echo  $lesson['inst_id']; ?></td>
                                <td><?php echo  $lesson['tutorname']; ?></td>
                            
                                <td><?php echo  $lesson['title']; ?></td>
                                <td><?php echo  $lesson['lesson_name']; ?></td>
                               
                                <td>
                                <?php
                                    $editUrl = "../edit_lesson/edit_lesson_index.php?lesson_id=" . $lesson['lesson_id'] . "1234"; ?>
                                    <a href="<?php echo $editUrl ?>" class="btn btn-success" name="edit" >delete OR edit</a>
                                </td>
                            
                            </tr>
                        </tbody>           
                    <?php endwhile; ?>   
                <?php endif; ?>  
                
                </table>
            </div>
     </div>
   <!-- End Manage Lesson Table -->
   
   <!-- Start Manage Check Table -->
   <div class="px-4 py-5 my-5 text-center bg-light text-dark">
            <h1 class="display-8  text-body-emphasis">Check payment Table</h1>
            <div class="col-lg-12 mx-auto">
                <p class="lead mb-4">รายการจ่ายเงินในระบบ</p>
                <?php
                    $sql = "SELECT S.stu_id,U.fname,U.lname,P.Ddate,P.Ttime,P.file_name,P.payment_id ,C.title,C.course_id,E.enroll_id,E.payment_status
                            FROM Users U,STUDENT S , Enrollment E ,Payment P,Courses C
                                WHERE U.role = 'Student' 
                                AND U.user_id = S.user_id 
                                AND S.stu_id = E.stu_id
                                AND E.enroll_id = P.enroll_id
                                AND C.course_id = E.course_id
                                ";
                    $stmt_6 = $conn -> query($sql);
                    $stmt_6 -> execute();
            
                    $rowCount_4 = $stmt_6->rowCount();
                    
                ?>
            
            
            
                <table class="table  table-bordered">
                    <thead>
                    
                        <tr>
                            <th scope="col">Index</th>
                            <th scope="col">studentId</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">สลิป</th>
                            <th scope="col">Accept</th>
                            <th scope="col">Decline</th>
                           
    
                        </tr>
                    </thead>
                <?php if($rowCount_4 > 0 ): ?>
                    <?php $count_4 = 1; ?>
                    <?php while($payment = $stmt_6->fetch(PDO::FETCH_ASSOC)) : ?>
                        
                    <tbody>
                            <tr class="table-primary">
                                <td><?php echo $count_4; $count_4++; ?></td>
                                <td><?php echo  $payment['stu_id']; ?></td>
                                <td><?php echo  $payment['fname']; ?></td>
                                <td><?php echo  $payment['lname']; ?></td>
                                <td><?php echo  $payment['title']; ?></td>
                                <td><?php echo  $payment['Ddate']; ?></td>
                                <td><?php echo  $payment['Ttime']; ?></td>
                                <td><?php  
                                    if($payment['payment_status'] == 2){
                                        echo "ยังไม่ยืนยัน";
                                    }elseif($payment['payment_status'] == 1){
                                        echo "ยืนยัน";
                                    }elseif($payment['payment_status'] == 3){
                                    echo "แจ้งติดต่อเจ้าหน้าที่";
                                    }
                                    else echo "สลิปไม่ถูกต้อง";
                                 ?>
                                </td>
                               
                                <td> <img src= <?php echo "./payment/paypay/" . $payment['file_name']; ?> class="rounded" alt="..."  style="width: 200px; height: 150px;"></td>
                                <td>
                                <form action="course_manager.php" method="post" enctype="multipart/form-data">
                                   
                                    <input type="hidden" name="accept" value="<?php echo $payment['enroll_id']?>">
                                    <input type="hidden" name="payment_id" value="<?php echo $payment['payment_id']; ?>">

                                    <button type="submit" class="btn btn-success">Accept</button>
                                   
                                </form>
                                    <?php  
                                        
                                        if (isset($_POST['accept'])) {
                                            $enroll_id = $_POST['accept'];
                                            $cm_id = $row_CourseMana['cm_id'];
                                            $payment_id =  $payment['payment_id'];
                       
                                            $sql = "UPDATE Enrollment
                                                    SET payment_status = 1
                                                    WHERE enroll_id = '$enroll_id'
                                                ";
                                            $insert = $conn -> query($sql);
                                            

                                            $sql = "INSERT INTO Manage_check(payment_id,cm_id )
                                                   VALUES('$payment_id', '$cm_id')";
                                            $insert1 = $conn -> query($sql);
                                            
                                            
                                            if ($insert1) {
                                                $_SESSION['statusMsg'] = "The Payment <b>" . $payment['title'] .  "</b> has been change status .";
                                                header("location: ./course_manager.php");
                                                unset($_SESSION["statusMsg"]);
                                            } else {
                                                $_SESSION['statusMsg'] = "failed, please try again.";
                                                header("location: ./course_manager.php");
                                            }
                                        }
                                    
                                    ?>
                                </td>
                                <td>
                                <form action="course_manager.php" method="post" enctype="multipart/form-data">
                                   
                                    <input type="hidden" name="accept1" value="<?php echo $payment['enroll_id']?>">
                                     <button type="submit" class="btn btn-danger">Decline</button>
                                
                                </form>
                                    <?php  
                                        if (isset($_POST['accept1'])) {
                                            $enroll_id = $_POST['accept1'];
                                            $cm_id = $row_CourseMana['cm_id'];
                                            $payment_id =  $payment['payment_id'];
                                            
                                            $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $user_id");
                                            $stmt->execute();
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);    
                                        
                                                   
                                            
                                            $sql = "UPDATE Enrollment
                                                    SET payment_status = 3
                                                    WHERE enroll_id = '$enroll_id'
                                                ";
                                             $insert = $conn -> query($sql);
                                             
                                             $sql = "INSERT INTO Manage_check(payment_id,cm_id )
                                                   VALUES('$payment_id', '$cm_id' )";
                                                $insert1 = $conn -> query($sql);
                                            
                                            if ($insert) {
                                                $_SESSION['statusMsg'] = "The Payment <b>" . $payment['title'] .  "</b> has been change status .";
                                                header("location: course_manager.php");
                                               
                                            } else {
                                                $_SESSION['statusMsg'] = "failed, please try again.";
                                                header("location: course_manager.php");
                                            }
                                        }
                                    
                                    ?>
                                </td>
                            </tr>
                        </tbody>           
                    <?php endwhile; ?>   
                <?php endif; ?>  
                
                </table>
            </div>
   <!-- End Manage Lesson Table -->
   


   
</body>
</html>