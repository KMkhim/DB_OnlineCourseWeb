<?php 
    session_start();
    include_once '../../config/db.php';
    if(!isset($_SESSION["student_login"])){
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header("location: ../register/signin.php");
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
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
<body>
<?php

    if(isset($_SESSION["student_login"])){
        $user_id = $_SESSION["student_login"];
        
        $stmt = $conn->query("SELECT * FROM STUDENT WHERE $user_id = user_id ");
        //echo $user_id;
        $row_student = $stmt->fetch(PDO::FETCH_ASSOC); 
        $stu_id = $row_student['stu_id'];


        
        $stmt_2 = $conn->query("SELECT * FROM Courses 
                                WHERE course_id IN (SELECT course_id FROM Enrollment WHERE $stu_id = stu_id )");
                                                                           
        
        $stmt_2 -> execute();
        
        $rowCount = $stmt_2->rowCount();
}   
?>


<nav class="navbar navbar-expand-lg position-sticky top-0" style="z-index: 1000;">
    <div class="container">
        <a class="nav-link" href="#">
            <img src="../image/catblackicon.png" alt="Bootstrap" width="50" height="50" class="rounded float-start">
        </a>
        <a class="nav-link" href="../student.php"> HomePage </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                
                <button type="button" class="btn btn-light" onclick="location.href='../../regis/logout.php'">Logout</button>
            </div>
        </div>
    </div>
</nav>


    <!-- end nav bar -->
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


<!--heros-->
<div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://img-c.udemycdn.com/course/750x422/461812_32c7.jpg" alt="" width="100" height="100">
        <h1 class="display-5 fw-bold text-body-emphasis">Enrollment</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">คอร์สในตระกร้า</p>

        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสคอร์ส</th>
                    <th scope="col">ชื่อคอร์ส</th>
                    <th scope="col">status</th>
                </tr>
            </thead>

            <?php if($rowCount > 0 ): ?>
                <?php $count = 1;  ?>
                <?php while($course = $stmt_2->fetch(PDO::FETCH_ASSOC)) : ?>
            
                    <tbody>
                        <tr class="table-primary">
                            <td><?php echo $count; $count++; ?></td>
                            <td><?php echo  $course['category'] . $course['course_id']; ?></td>
                            <td><?php echo $course['title']; ?></td>
                            <td>
                                <?php 
                                    $course_id = $course['course_id'];
                                    $sql = "SELECT * FROM Enrollment
                                             WHERE stu_id = $stu_id 
                                             AND course_id = $course_id
                                             ";
                                    ;
                                    $stmt = $conn->query($sql);
                                    $row_en = $stmt->fetch(PDO::FETCH_ASSOC);
                                    //echo $row_en["payment_status"];
                                    
                                ?>
                                
                                
                                <?php if($row_en['payment_status'] == 2) { ?> 
                                        <span style="color: blue;">รอเจ้าหน้าที่ยืนยัน</span>
                                 <?php }else if($row_en['payment_status'] == 3) {  ?> 
                                    <span style="color: red;">ติดต่อเจ้าหน้าที่</span>
                                <?php }else if($row_en['payment_status'] == 0) {?>  
                                
                                    <form action="enroll.php" method="post" enctype="multipart/form-data">
                                   
                                        <input type="hidden" name="submit_delete" value="<?php echo $course['course_id']?>">
                                        <button type="submit" class="btn btn-danger">ลบ</button>
                                    </form>
                                
                                    
                                <?php }else if($row_en['payment_status'] == 1) { ?> 
                                    <span style="color: green;">ลงทะเบียนสำเร็จ</span>
                                <?php } ?>
                                    
 
                            </td>
                             
                        </tr>
                        
                <?php endwhile; ?>   
            <?php endif; ?>  
                    </tbody>
        </table>
        </div>

        
                
            <?php 
                
                 $sql_2 = "SELECT * FROM Enrollment E
                            JOIN Courses C ON E.course_id = C.course_id
                            WHERE E.stu_id = $stu_id 
                            AND E.payment_status = 0
                            ";
                    echo $row_en_2['enroll_id'];
                    $stmt_2 = $conn->query($sql_2);
                    $row_en_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
    
            ?>
            <?php
                // เตรียมคำสั่ง SQL เพื่อตรวจสอบสถานะการชำระเงิน
                $stmt_4 = $conn->prepare("SELECT payment_status FROM Enrollment WHERE stu_id = :stu_id AND payment_status = 0");
                $stmt_4->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
                $stmt_4->execute();

                // ตรวจสอบจำนวนแถวที่ตรงตามเงื่อนไข
                $rowCount = $stmt_4->rowCount();

                if ($rowCount > 0) {
                    // แสดงปุ่มสำหรับยืนยันการลงทะเบียน
                    echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            ยืนยันการลงทะเบียน
                        </button>';
                } else {
                    // แสดงข้อความหากไม่มีข้อมูล
                    echo '<p>ไม่มีข้อมูลการลงทะเบียนที่รอดำเนินการ</p>';
                }
            ?>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                           
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"> 
                            ราคาคอร์ส : <?php echo $row_en_2['price']; ?>
                            <br>
                            <div class="text-center">
                                <img src="../pic/qr.png" class="rounded" alt="..."  style="width: 200px; height: 150px;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <?php 
                                
                                
                                $editUrl = "../payment/payment_index.php?enroll_id=" . $row_en_2['enroll_id'] . "1234";?>
                            
                            
                           
                            <a href="<?php echo $editUrl ?>" class="btn btn-success" name="edit" >ยืนยัน</a>
                            
                        
                    
                    </div>
                </div>
            </div> 
            
       

        
        
        
        </form>





    </div>
    <!--end heroes-->


</body>
</html>