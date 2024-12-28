<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

</head>
<body style="background-color: white";>
    <!--navbar-->
    
    <?php 
        include_once './check_choose_nav.php';
    ?>
   <!-- หน้าจอเลื่อนๆ -->
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item">
      <img src="./image/mage11.png" style="width: 100%; height: 500px;" alt="Image description">

        <!-- <div class="container">
          <div class="carousel-caption text-start">
            <h1>Example headline.</h1>
            <p>Some representative placeholder content for the first slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
          </div>
        </div> -->
      </div>
      <div class="carousel-item active">
        <img src="./image/mage2.png" style="width: 100%; height: 500px;" alt="Image description">

        <!-- <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
          </div>
        </div> -->
      </div>
      <div class="carousel-item">
        <img src="./image/mage3.png" style="width: 100%; height: 500px;" alt="Image description">

        <!-- <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
          </div>
        </div>
      </div> -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
 <!-- end หน้าจอเลื่อนๆ -->
  
    <div class="container-sm" >
    <div class="row" >
        <!-- วิชาคณิตศาสตร์  -->
        <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'MA%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
        ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                     <h2 class="featurette-heading fw-normal lh-1" id="mathSubject" style="font-family: 'Pacifico', cursive;">วิชาคณิตศาสตร์ <span class="text-body-secondary"> แนะนำ</span></h2>
                     <a href="./S_math.php" id="courseButton" class="btn btn-primary">คอร์สทั้งหมด</a>
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
        <!-- END วิชาคณิตศาสตร์  -->
        <hr class="#">

        <!-- วิชาSCI -->
    <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'SC%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
     ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                     <h2 id="sciSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">วิชาวิทยาศาสตร์ <span class="text-body-secondary"> แนะนำ</span></h2>
                     <a href="./S_sci.php" id="courseButton" class="btn btn-primary">คอร์สทั้งหมด</a>
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
        <hr class="#">
        <!-- END SCI  -->

        <!-- วิชาENG -->
    <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'EN%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
     ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                     <h2 id="engSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">ภาษาอังกฤษ <span class="text-body-secondary"> แนะนำ</span></h2>
                     <a href="./S_english.php" id="courseButton" class="btn btn-primary">คอร์สทั้งหมด</a>
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
        <hr class="#">
        <!-- END ENG  -->
                                       
        <!-- วิชาsocial -->
    <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'SO%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
     ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                     <h2 id="socialSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">สังคมและประวิตศาสตร์ <span class="text-body-secondary"> แนะนำ</span></h2>
                     <a href="./S_social.php" id="courseButton" class="btn btn-primary">คอร์สทั้งหมด</a>
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
        <hr class="#">
        <!-- END social  -->
 
        <!-- วิชาthai -->
    <?php  
            $stmt = $conn->prepare("SELECT * FROM Courses WHERE category LIKE 'TH%' ORDER BY updated_at DESC ");
            $stmt->execute();
            $rowCount = $stmt->rowCount();
     ?>
        <?php if($rowCount > 0 ): ?>
   
        <div class="album py-5">
        
        <br>
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                     <h2 id="thaiSubject" class="featurette-heading fw-normal lh-1" style="font-family: 'Pacifico', cursive;">ภาษาไทย <span class="text-body-secondary"> แนะนำ</span></h2>
                     <a href="./S_thai.php" id="courseButton" class="btn btn-primary">คอร์สทั้งหมด</a>
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
        <hr class="#"> 
        <!-- END thai  -->
         
    </div>
</div>
</div>

    
    
    
    <?php  include_once './footer.php'?>
</body>
</html>