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
        <a class="nav-link" href="../page/home.php"> Home Page</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../regis/signin.php">เข้าสู่ระบบ</a>
                <button type="button" class="btn btn-light" onclick="location.href='../regis/index.php'">ลงทะเบียน</button>
            </div>
        </div>
    </div>
</nav>




<div class="container marketing">
    <?php 
        
        $length = strlen($text);
        
        $inst_id = substr($_GET['inst_id'],0,$length-4); 
        $sql = "SELECT * FROM INSTRUCTOR I  WHERE $inst_id = inst_id ";
        //echo $inst_id;
        $stmt = $conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);    
        //$rowCount = $stmt->rowCount();
    ?>
 

    <div class="px-4 py-5 my-5 text-center">
        <img src="<?php echo '../edit_pro/uploads/'.$row['file_name'] ?>"  class="rounded-circle" alt="Cinque Terre" width="200" height="200">
        <br>
        <br>
        <h2 class="fw-normal">Tutor : <?php echo $row['tutorname'] ?></h2>
        <p> <?php echo $row['description'] ?></p>

    </div>

</div>
<?php 
    
    $stmt = $conn->prepare("SELECT * FROM Courses WHERE $inst_id = inst_id ORDER BY updated_at DESC ");
    $stmt->execute();
            //$row_2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowCount = $stmt->rowCount();
            
?>

<?php if($rowCount > 0): ?>
   
        <div class="album py-5 bg-body-tertiary">
            
            <div class="container">
            <h2 class="fw-normal">วิชาที่เปิดสอน</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php while($course = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" src="<?php echo '../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <h4 class="card-text"><?php echo $course['title'] ?></h4>
                                <h6 class="card-text"><?php echo $course['category'] ?></h4>
                                <p class="card-text"><?php echo $course['description'] ?></p>
                                <?php 
                                    $courseId = $course['course_id']; 
                                    $editUrl = "./lesson.php?course_id=" . $courseId . "1234";
                                ?>
                                <div style="display: flex; gap: 10px;">
                                    <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit" >course</a>                      
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