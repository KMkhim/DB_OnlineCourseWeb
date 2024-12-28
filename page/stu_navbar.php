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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
    /* สำหรับ Navbar สีขาว */
    .navbar .nav-link {
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
        background-color: #007bff;
        transition: width 0.3s ease, left 0.3s ease;
    }
    .navbar .nav-link:hover::after {
        width: 100%;
        left: 0;
    }

    /* สำหรับ Navbar สีดำ */
    .navbar-dark .nav-link {
        position: relative;
        text-decoration: none;
        padding-bottom: 5px;
    }
    .navbar-dark .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: white;
        transition: width 0.3s ease, left 0.3s ease;
    }
    .navbar-dark .nav-link:hover::after {
        width: 100%;
        left: 0;
    }
    .btn-purple {
        background-color: #a393eb; /* เปลี่ยนเป็นสีม่วงที่คุณเลือก */
        border-color: #a393eb;
        color: #FFFFFF; /* เปลี่ยนสีตัวอักษรเป็นสีขาว */
    }
</style>

</head>
<body>

<?php
        //echo $_SESSION["student_login"] . "ee";
        if(isset($_SESSION["student_login"])){
            $user_id = $_SESSION["student_login"];
            //echo $user_id;
            $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $user_id");
            $stmt->execute();
            $row_user = $stmt->fetch(PDO::FETCH_ASSOC);  
            
            $stmt_2 = $conn->query("SELECT * FROM STUDENT WHERE user_id = $user_id ");
            //echo "khim";
            $stmt_2 -> execute();
            $row_student = $stmt_2->fetch(PDO::FETCH_ASSOC); 
            
            if($row_student["user_id"] == null){
                $sql = "INSERT INTO STUDENT (user_id, filename , uploaded_on)
                        VALUES('$user_id','unknow.png',NOW()) ";
                $conn->query($sql);
            }
        }
        
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary position-sticky top-0" style="z-index: 1000;">
    <div class="container d-flex align-items-center">
        <!-- โลโก้ -->
        <a class="nav-link d-flex align-items-center" href="#">
            <img src="image/homepage_icon.png" alt="Bootstrap" width="50" height="50" class="rounded float-start">
        </a>

        <!-- ลิงก์ Home Page -->
        <a class="nav-link mx-2" href="../page/home.php">Home Page</a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- เนื้อหาใน Navbar -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="d-flex justify-content-center navbar-nav ms-auto align-items-center">
                <!-- ลิงก์ต่างๆ -->
                <a class="nav-link mx-2" href="./student/my_course.php">คอร์สเรียนของฉัน</a>
                <a class="nav-link mx-2" href="./enroll/enrollment_index.php">การลงทะเบียน</a>
                <a class="nav-link mx-2" href="../regis/logout.php">ล็อคเอ้าท์</a>

                <?php
                    $editUrl = "./student/student_pro_index.php?stu_id=" . $row_student["stu_id"] . "1234";
                ?>
                
                <a class="nav-link mx-2" href="<?php echo $editUrl?>">แก้ไขโปรไฟล์</a>

                <!-- รูปโปรไฟล์ -->
                <a class="mx-2" href="#">
                    <img src="<?php echo './student/stu_pic/'.$row_student['filename'] ?>" alt="Profile" width="50" height="50" class="rounded-circle">
                </a>

                <p class="mx-2 text-dark mt-3"> <?php echo $row_user['fname']; ?> </p>

            </div>
        </div>
    </div>
</nav>

<nav class="nav navbar-expand-sm bg-dark navbar-dark justify-content-center position-sticky" style="top: 69px; z-index: 999;">
    <a class="nav-link" style="color : aliceblue;" href="./student.php">หน้าแรก</a>
    <a class="nav-link" style="color: aliceblue;" href="#mathSubject">คณิตศาสตร์</a>
    <a class="nav-link" style="color : aliceblue;" href="#sciSubject">วิทยาศาสตร์</a>
    <a class="nav-link" style="color : aliceblue;" href="#engSubject">ภาษาอังกฤษ</a>
    <a class="nav-link" style="color : aliceblue;" href="#socialSubject">สังคม</a>
    <a class="nav-link" style="color : aliceblue;" href="#thaiSubject">ภาษาไทย</a>
 </nav>
</body>

</html>
