<?php
    session_start();
    require_once '../config/db.php';
    if(!isset($_SESSION["instructor_login"])){
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header("location: ../regis/signin.php");
    }
        
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="instructor.css">
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
<body>
<nav class="navbar navbar-expand-lg position-sticky top-0" style="z-index: 1000;">
    <div class="container">
        <a class="nav-link" href="#">
            <img src="image/catblackicon.png" alt="Bootstrap" width="50" height="50" class="rounded float-start">
        </a>
        <a class="nav-link" href="../page/instructor.php"> Profile </a>
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

    
        <?php
            if(isset($_SESSION["instructor_login"])){
                $instructure_id = $_SESSION["instructor_login"];
                $stmt = $conn->query("SELECT * FROM Users WHERE user_id = $instructure_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);    
            }
            $user_id = $row['user_id'];
            
        ?>

        <?php 
            $query = $conn->query("SELECT * FROM INSTRUCTOR I,Users U WHERE $user_id = I.user_id AND $user_id = U.user_id  ");
            if ($query->rowCount() > 0) {
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $profile_pic = '../edit_pro/uploads/'.$row['file_name'];
                    $cover_pic = '../edit_pro/uploads/'.$row['file_name2'];
                    $tutorname = $row['tutorname'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $desc = $row['description'];
                    $inst_id = $row['inst_id'];
            
                }
            } else { 
                $sql = "INSERT INTO INSTRUCTOR(user_id,tutorname,description,file_name, file_name2,uploaded_on)
                        VALUES ('$user_id','tutorname : NONE','description : None','inst_pro_start.png','inst_cover_start.png' ,CURRENT_TIME() )";  
                $insert = $conn->query($sql);
                $query = $conn->query("SELECT * FROM INSTRUCTOR I,Users U WHERE $user_id = I.user_id AND $user_id = U.user_id  ");
                if ($query->rowCount() > 0) {
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $profile_pic = '../edit_pro/uploads/'.$row['file_name'];
                        $cover_pic = '../edit_pro/uploads/'.$row['file_name2'];
                        $tutorname = $row['tutorname'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $desc = $row['description'];
                        $inst_id = $row['inst_id'];
            
                    }
                }
            }


        ?>  
                
        



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

    <section class="twitterprofile">
                <div class="headerprofileimage">
                    <img src="<?php echo $cover_pic ?>" alt="header" id="headerimage">
                    <img src="<?php echo $profile_pic ?>" alt="profile pic" id="profilepic">
                    <div class="editprofile">
                        <a href="../edit_pro/pic_index.php" class="btn btn-dark btn-s px-4">Edit Profile</a>
                    </div>
                </div>
                <div class="bio">
                    <div class="handle">
                        <h3><?php echo $tutorname ?></h3>
                        <span><?php echo $fname . " " . $lname?></span>
                    </div>
                    <hr>
                    <h4>About me</h4>
                    <p> <?php echo $desc ?></p>
                    <hr> 
                </div>
                
    </section>
    <section class="py-5 text-center container">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light ">My Course</h1>
                <p>
                    <a href="../edit_course/add_course_index.php" class="btn btn-dark btn-s px-4">ADD Course</a>
                </p>
            </div>
        </div>
    </section>
    <!-- <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis">My course</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">คณิตศาสตร์สุดสนุก</p>
            
        </div>
    </div> -->


<?php 
    
    $stmt = $conn->prepare("SELECT * FROM Courses WHERE $inst_id = inst_id ORDER BY updated_at DESC ");
    $stmt->execute();
            //$row_2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowCount = $stmt->rowCount();
            
?>

<?php if($rowCount > 0): ?>
   
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
           
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php while($course = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" src="<?php echo '../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <h4 class="card-text"><?php echo $course['title'] ?></h4>
                                <h6 class="card-text"><?php echo $course['category'] ?></h4>
                                <p class="card-text"><?php echo $course['description'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <form action="../edit_course/edit_course_index.php" method="post" enctype="multipart/form-data">
                                        <?php 
                                        $courseId = $course['course_id']; 
                                        $editUrl = "../edit_course/edit_course_index.php?course_id=" . $courseId . "1234";
                                        $gotoViewPage = "../edit_lesson/lesson_index.php?course_id=" . $courseId . "1234";
                                        ?>
                                        <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit" >edit</a>
                                        <a href="<?php echo $gotoViewPage ?>" class="btn btn-sm btn-outline-secondary" name="edit" >add lesson</a>
                                        
                                    </form>
                                    </div>
                                    <small class="text-body-secondary"><?php echo $course['updated_at'] ?></small>
                                </div>
                            </div>
                        </div>
                     </div>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
   
<?php endif; ?>         


    <footer><?php  include_once './footer.php'?></footer>
</body>
</html>