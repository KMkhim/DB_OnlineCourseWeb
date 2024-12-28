<?php 
    session_start();
    include_once '../../config/db.php';
    if(!isset($_SESSION["student_login"])){
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
         header("location: ../regis/signin.php");
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../footer.css">
    
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
            
        }
        
?>
    <!-- navbar -->
    
<nav class="navbar navbar-expand-lg bg-body-tertiary position-sticky top-0" style="z-index: 1000;">
    <div class="container">
        <a class="nav-link" href="#">
            <img src="../../page/image/homepage_icon.png" alt="Bootstrap" width="50" height="50" class="rounded">
        </a>
        <a class="nav-link" href="../../page/student.php"> Home Page</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="d-flex justify-content-center navbar-nav ms-auto align-items-center"> <!-- เพิ่ม align-items-center -->
                <a class="nav-link" href="../../regis/logout.php">ล็อคเอ้าท์</a>
                <?php
                    $editUrl = "./student_pro_index.php?stu_id=" . $row_student["stu_id"] . "1234";
                ?>
                <a class="nav-link" href="<?php echo $editUrl ?>">แก้ไขโปรไฟล์</a>
                <a class="navbar-brand" href="#">
                    <img src="<?php echo '../student/stu_pic/' . $row_student['filename'] ?>" alt="Bootstrap" width="50" height="50" class="rounded">    
                </a>
                <p class="mb-0"> <?php echo "User name : " . $row_user['fname'] ?> </p> <!-- เพิ่ม mb-0 เพื่อยกเลิก margin บนล่าง -->
            </div>
        </div>
    </div>
</nav>

<nav class="nav navbar-expand-sm bg-dark navbar-dark justify-content-center position-sticky" style="top: 69px; z-index: 999;">
    <a class="nav-link" style="color: aliceblue;" href="#mathSubject">คณิตศาสตร์</a>
    <a class="nav-link" style="color : aliceblue;" href="#sciSubject">วิทยาศาสตร์</a>
    <a class="nav-link" style="color : aliceblue;" href="#engSubject">ภาษาอังกฤษ</a>
    <a class="nav-link" style="color : aliceblue;" href="#socialSubject">สังคม</a>
    <a class="nav-link" style="color : aliceblue;" href="#thaiSubject">ภาษาไทย</a>
 </nav>







<!-- end navbar -->
<!--heros-->
   <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="<?php echo '../student/stu_pic/'.$row_student['filename'] ?>" alt="" width="100" height="100">
        <h1 class="display-5 fw-bold text-body-emphasis">My Course</h1>
    </div>
    <hr>
    <!--end heroes-->
    <div class="container-sm" >
    <div class="row" >
        <!-- วิชาคณิตศาสตร์  -->
        <?php  
            $stu_id = $row_student['stu_id'];
            $stmt = $conn->prepare("SELECT * FROM STUDENT S 
                                            JOIN Enrollment E ON S.stu_id = E.stu_id 
                                            JOIN Courses C ON E.course_id = C.course_id
                                            WHERE C.category LIKE 'MA%'
                                            AND S.stu_id = $stu_id
                                            AND E.payment_status = 1
                                            ORDER BY updated_at DESC ;");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
        ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 15px;">
                <h2 id="mathSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">วิชาคณิตศาสตร์ </h2>
                </div>

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"
                             src="<?php echo '../../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <form>  
                                            <?php 
                                                    $courseId = $course['course_id']; 
                                                    $editUrl = "../lesson.php?course_id=" . $courseId . "1234";
                                                    $editUrl2 = "../view_index.php?inst_id=" . $course['inst_id'] . "1234";
                                                ?>
                                            <a href="<?php echo $editUrl ?>" class="btn btn-info" name="edit" style="margin-bottom: 10px;">Start_learning</a>
                                           
                                        <div style="display: flex; gap: 10px;">
                                           
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     <?php $count++; ?>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
        <hr class="#">
        <?php endif; ?> 
        <!-- END วิชาคณิตศาสตร์  -->
       

        <!-- วิชาSCI -->
        <?php  
            $stu_id = $row_student['stu_id'];
            $stmt = $conn->prepare("SELECT * FROM STUDENT S 
                                            JOIN Enrollment E ON S.stu_id = E.stu_id 
                                            JOIN Courses C ON E.course_id = C.course_id
                                            WHERE C.category LIKE 'SC%'
                                            AND S.stu_id = $stu_id
                                            ORDER BY updated_at DESC ;");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
        ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 15px;">
                     <h2 id="sciSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">วิชาคณิตศาสตร์ <span class="text-body-secondary"> แนะนำ</span></h2>
                </div>

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"
                             src="<?php echo '../../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <form>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-info" name="edit" style="margin-bottom: 10px;">Start_learning</a>
                                           
                                        <div style="display: flex; gap: 10px;">
                                            <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit">course</a>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     <?php $count++; ?>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
        <?php endif; ?> 
        <!-- END SCI  -->

        <!-- วิชาENG -->
        <?php  
            $stu_id = $row_student['stu_id'];
            $stmt = $conn->prepare("SELECT * FROM STUDENT S 
                                            JOIN Enrollment E ON S.stu_id = E.stu_id 
                                            JOIN Courses C ON E.course_id = C.course_id
                                            WHERE C.category LIKE 'EN%'
                                            AND S.stu_id = $stu_id
                                            ORDER BY updated_at DESC ;");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
        ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 15px;">
                     <h2 id="engSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">วิชาคณิตศาสตร์ <span class="text-body-secondary"> แนะนำ</span></h2>
                </div>

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"
                             src="<?php echo '../../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <form>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-info" name="edit" style="margin-bottom: 10px;">Start_learning</a>
                                           
                                        <div style="display: flex; gap: 10px;">
                                            <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit">course</a>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     <?php $count++; ?>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
        <?php endif; ?> 
        <!-- END ENG  -->
                                       
        <!-- วิชาsocial -->
        <?php  
            $stu_id = $row_student['stu_id'];
            $stmt = $conn->prepare("SELECT * FROM STUDENT S 
                                            JOIN Enrollment E ON S.stu_id = E.stu_id 
                                            JOIN Courses C ON E.course_id = C.course_id
                                            WHERE C.category LIKE 'SOC%'
                                            AND S.stu_id = $stu_id
                                            ORDER BY updated_at DESC ;");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
        ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 15px;">
                     <h2 id="socialSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">วิชาคณิตศาสตร์ <span class="text-body-secondary"> แนะนำ</span></h2>
                </div>

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"
                             src="<?php echo '../../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <form>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-info" name="edit" style="margin-bottom: 10px;">Start_learning</a>
                                           
                                        <div style="display: flex; gap: 10px;">
                                            <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit">course</a>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     <?php $count++; ?>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
        <?php endif; ?> 
        <!-- END social  -->
 
        <!-- วิชาthai -->
        <?php  
            $stu_id = $row_student['stu_id'];
            $stmt = $conn->prepare("SELECT * FROM STUDENT S 
                                            JOIN Enrollment E ON S.stu_id = E.stu_id 
                                            JOIN Courses C ON E.course_id = C.course_id
                                            WHERE C.category LIKE 'TH%'
                                            AND S.stu_id = $stu_id
                                            ORDER BY updated_at DESC ;");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
        ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 15px;">
                     <h2 id="thaiSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">วิชาคณิตศาสตร์ <span class="text-body-secondary"> แนะนำ</span></h2>
                </div>

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"
                             src="<?php echo '../../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <form>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-info" name="edit" style="margin-bottom: 10px;">Start_learning</a>
                                           
                                        <div style="display: flex; gap: 10px;">
                                            <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit">course</a>
                                            <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     <?php $count++; ?>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
        <?php endif; ?> 
        <!-- END thai  -->
         
    </div>
</div>
</div>

    
    
    
<?php  include_once '../footer.php'?>

 

</body>
</html>