<?php 

    session_start();
    include_once '../config/db.php';

    //echo $_SESSION["course_manager_login"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Edit Course </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
<?php 
    $length = strlen($text);
    $course_id = substr($_GET['course_id'],0,$length-4);
    //echo $course_id;
    //$editUrl = "edit_course.php?course_id=" . $course_id;
?>
 

<div class="container">

<br>
<br>
    <br> 
    <br>
    <?php if(isset($_SESSION["instructor_login"]) ){ ?>
        <button onclick="window.location.href='../page/instructor.php'" class="btn btn-sm btn-secondary ">
        ← ย้อนกลับ
        </button> 
    <?php } elseif(isset($_SESSION["course_manager_login"]) ) { ?>
        <button onclick="window.location.href='../page/course_manager.php'" class="btn btn-sm btn-secondary ">
        ← ย้อนกลับ
        </button> 
    <?php } ?>
    <br>
    <br>
    <h3>Edit Course</h3>
    <hr>  

        
        <div class="row mt-5">
            <div class="col-12">
                <form action="edit_course.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Course name</label>
                        <input type="text" class="form-control" name="title" >
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_title" value="<?php echo $course_id?>"> <button type="submit" class="btn btn-sm btn-primary mb-3">Change Course name</button>
                        
                    </div>
                </form>
                <form action="edit_course.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_desc" value="<?php echo $course_id?>"> <button type="submit" class="btn btn-sm btn-primary mb-3">Change Description</button>
                    </div>
                </form>


                <form action="edit_course.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category">
                            <option selected>เลือกระดับชั้น</option>
                            <option  disabled>ระดับประถม</option>
                            <option value="MA1">ประถม-คณิตศาสตร์</option>
                            <option value="SC1">ประถม-วิทยาศาสตร์</option>
                            <option value="TH1">ประถม-ภาษาไทย</option>
                            <option value="SO1">ประถม-สังคมและประวัติศาสตร์</option>
                            <option value="EN1">ประถม-ภาษาอังกฤษ</option>
                            <option value="V1">ประถม-แข่งขัน/สอบเข้ามัธยม</option>
                            <!-- ระดับมัธยมต้น -->
                            <option  disabled>ระดับมัธยมต้น</option>
                            <option value="MA2">มัธยมต้น-คณิตศาสตร์</option>
                            <option value="SC2">มัธยมต้น-วิทยาศาสตร์</option>
                            <option value="TH2">มัธยมต้น-ภาษาไทย</option>
                            <option value="SO2">มัธยมต้น-สังคมและประวัติศาสตร์</option>
                            <option value="EN2">มัธยมต้น-ภาษาอังกฤษ</option>
                            <option value="V2">มัธยมต้น-แข่งขัน/สอบเข้ามัธยมปลาย</option>
                            <!-- ระดับมัธยมปลาย -->
                            <option  disabled>ระดับมัธยมปลาย</option>
                            <option value="MA31">มัธยมปลาย-คณิตศาสตร์พื้นฐาน</option>
                            <option value="MA32">มัธยมปลาย-คณิตศาสตร์เพิ่มเติม</option>
                            <option value="SC31">มัธยมปลาย-ฟิสิกส์</option>
                            <option value="SC32">มัธยมปลาย-เคมี</option>
                            <option value="SC33">มัธยมปลาย-ชีวะ</option>
                            <option value="TH3">มัธยมปลาย-ภาษาไทย</option>
                            <option value="SO3">มัธยมปลาย-สังคมและประวัติศาสตร์</option>
                            <option value="EN3">มัธยมปลาย-ภาษาอังกฤษ</option>
                            <option value="V3">มัธยมปลาย-แข่งขัน/สอบเข้ามหาลัย</option>
                        </select>
                        
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_category" value="<?php echo $course_id?>"> <button type="submit" class="btn btn-sm btn-primary mb-3">Change Category</button>
                    </div>
                </form>



                <form action="edit_course.php" method="post" enctype="multipart/form-data">
                    <div class="my-4"></div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration ระยะเวลาคอร์ส (วัน)</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" name="duration">
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_duration" value="<?php echo $course_id?>"> <button type="submit" class="btn btn-sm btn-primary mb-3">Change Duration</button>

                    </div>
                    <div class="my-4"></div>
                </form>
                
                <form action="edit_course.php" method="post" enctype="multipart/form-data">
                    <div class="my-4"></div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" name="price">
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_price" value="<?php echo $course_id?>"> 
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Change Price</button>

                    </div>
                    <div class="my-4"></div>
                </form>
                

                <form action="edit_course.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Select <strong>Course</strong>  Image</label>
                        <input type="file" name="file" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_image" value="<?php echo $course_id?>"> 
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Change Image</button>
                        
                    </div>
                </form> 
                
    
            
            <!-- Modal -->
    <form action="edit_course.php" method="post" enctype="multipart/form-data">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       DELETE COURSE
            </button>

            <br>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ยืนยันที่จะลบคอร์ส</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        จะลบจริงๆหรอ
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ไม่อะ ไม่ลบ</button>
                        <?php echo $course_id ?>
                        <input type="hidden" name="submit_delete" value="<?php echo $course_id?>"><button type="submit" class="btn btn-danger">ใช่ ฉันจะลบคอร์ส</button>
                    </div>
                    
                </div>
            </div> 
    </form> 

            
            <div class="my-4"></div>
            <div class="my-4"></div>
            <div class="my-4"></div>
            <div class="my-4"></div>
            <div class="my-4"></div>
            <div class="my-4"></div>
            <div class="my-4"></div>
            <div class="my-4"></div>
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