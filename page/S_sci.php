<?php
    session_start();
    require_once '../config/db.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <?php
        include_once './navforS.php';
    ?>
    <!--heros-->
    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://img-c.udemycdn.com/course/750x422/461812_32c7.jpg" alt="" width="100" height="100">
        <h1 class="display-5 fw-bold text-body-emphasis">Science Site</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">วิทยาศาสตร์สุดสนุก</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-outline-secondary btn-lg px-4" ><a href="#SC1">ประถม</a></button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4" ><a href="#SC2">ม.ต้น</a></button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4" ><a href="#SC3">ม.ปลาย</a></button>
                
            </div>
        </div>

    </div>
    <!--end heroes-->
    <div class="container-sm" >
    <div class="row" >
        <!-- ประถม -->
        <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'SC1%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
        ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: -20px; margin-bottom: 20px;">
                    <h2 class="featurette-heading fw-normal lh-1" id="SC1" style="font-family: 'Pacifico', cursive;">
                        ประถม <span class="text-body-secondary">ทั้งหมด</span>
                    </h2>
                    
                    
                 </div>

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" src="<?php echo '../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <?php if($_SESSION['student_login']): ?>
                                            <?php  
                                                $courseId = $course['course_id']; 
                                                
                                            ?>
                                            <form action="./enroll/enroll.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="submit_enroll" value="<?php echo $courseId?>">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">enroll</button>
                                            </form>
                                        <?php else : ?>
                                            <form action="./view_index.php" method="post" enctype="multipart/form-data">
                                                <?php 
                                                    $courseId = $course['course_id']; 
                                                    $editUrl = "./lesson.php?course_id=" . $courseId . "1234";
                                                    $editUrl2 = "./view_index.php?inst_id=" . $course['inst_id'] . "1234";
                                                ?>
                                                <div style="display: flex; gap: 10px;">
                                                    <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit" >course</a>
                                                    <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                        
                                </div>
                               
                                 <hr>
                                 <p class="card-text" style="text-align: right;"><?php echo $course['price'] . ".-" ?></p>

                            </div>
                        </div>
                     </div>
                     <?php $count++; ?>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
        <?php endif; ?> 
        <!-- END ประถม   -->
       

        <!-- ม.ต้น -->
    <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'SC2%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
     ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: -20px; margin-bottom: 20px;">
                <h2 class="featurette-heading fw-normal lh-1" id="SC2" style="font-family: 'Pacifico', cursive;">
                    ม.ต้น <span class="text-body-secondary">ทั้งหมด</span>
                </h2>
                
            </div>
            

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" src="<?php echo '../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <?php if($_SESSION['student_login']): ?>
                                            <?php  
                                                $courseId = $course['course_id']; 
                                                
                                            ?>
                                            <form action="./enroll/enroll.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="submit_enroll" value="<?php echo $courseId?>">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">enroll</button>
                                            </form>
                                        <?php else : ?>
                                            <form action="./view_index.php" method="post" enctype="multipart/form-data">
                                                <?php 
                                                    $courseId = $course['course_id']; 
                                                    $editUrl = "./lesson.php?course_id=" . $courseId . "1234";
                                                    $editUrl2 = "./view_index.php?inst_id=" . $course['inst_id'] . "1234";
                                                ?>
                                                <div style="display: flex; gap: 10px;">
                                                    <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit" >course</a>
                                                    <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                        
                                </div>
                               
                                 <hr>
                                 <p class="card-text" style="text-align: right;"><?php echo $course['price'] . ".-" ?></p>

                            </div>
                        </div>
                     </div>
                     <?php $count++; ?>
                <?php endwhile; ?>  
                </div> 
               
            </div> 
            
        </div>
        <?php endif; ?> 
       
        <!-- END ม.ต้น  -->

        <!-- วิชาม.ปลาย -->
    <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'SC3%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
     ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: -20px; margin-bottom: 20px;">
                <h2 class="featurette-heading fw-normal lh-1" id="SC3" style="font-family: 'Pacifico', cursive;">
                    ม.ปลาย <span class="text-body-secondary">ทั้งหมด</span>
                </h2>
               
            </div>
            

                <div class="row row-cols-4">
                <?php $count = 0; ?>
                <?php while(($course = $stmt->fetch(PDO::FETCH_ASSOC)) && ($count < 5)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="150"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" src="<?php echo '../edit_course/course_pro/'.$course['file_name'] ?>"></img>
                            <div class="card-body">
                                <p class="card-text" style="color: purple;"><?php echo "ONLINE COURSE" ?></p>
                                <h5 class="card-text"><?php echo $course['title'] ?></h5>
                                <p class="card-text" style="color: gray;"><?php echo $course['description'] ?></p>
                                

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <?php if($_SESSION['student_login']): ?>
                                            <?php  
                                                $courseId = $course['course_id']; 
                                                
                                            ?>
                                            <form action="./enroll/enroll.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="submit_enroll" value="<?php echo $courseId?>">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">enroll</button>
                                            </form>
                                        <?php else : ?>
                                            <form action="./view_index.php" method="post" enctype="multipart/form-data">
                                                <?php 
                                                    $courseId = $course['course_id']; 
                                                    $editUrl = "./lesson.php?course_id=" . $courseId . "1234";
                                                    $editUrl2 = "./view_index.php?inst_id=" . $course['inst_id'] . "1234";
                                                ?>
                                                <div style="display: flex; gap: 10px;">
                                                    <a href="<?php echo $editUrl ?>" class="btn btn-sm btn-outline-secondary" name="edit" >course</a>
                                                    <a href="<?php echo $editUrl2 ?>" class="btn btn-sm btn-outline-secondary" name="edit">tutor</a>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                        
                                </div>
                               
                                 <hr>
                                 <p class="card-text" style="text-align: right;"><?php echo $course['price'] . ".-" ?></p>

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
       
         
    </div>
</div>
</div>

        
    
    <div class="my-4"></div>  
    <?php  include_once './footer.php'?>
</body>
</html>