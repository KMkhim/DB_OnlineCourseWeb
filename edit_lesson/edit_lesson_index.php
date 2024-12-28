<?php 

    session_start();
    include_once '../config/db.php';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lesson</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<?php 
    $length = strlen($text);
    $lesson_id = substr($_GET['lesson_id'],0,$length-4);
    echo $lesson_id;
    
?>

<div class="container">
        
        <div class="row mt-5">
            <div class="col-12">
                <form action="edit_lesson.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="lesson_name" class="form-label">lesson name</label>
                        <input type="text" class="form-control" name="lesson_name" >
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_lesson_name" value="<?php echo $lesson_id?>"> 
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Change lesson_name</button>
                    </div>
                </form>
                <form action="edit_lesson.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_content" value="<?php echo $lesson_id?>"> 
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Change Content</button>
                    </div>
                </form>

                <form action="edit_lesson.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="video_url" class="form-label">URL</label>
                        <input type="text" class="form-control" name="video_url" >
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="hidden" name="submit_video_url" value="<?php echo $lesson_id?>"> 
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Change video url</button>
                    </div>
                </form>
            
            <!-- Modal -->
            <form action="edit_lesson.php" method="post" enctype="multipart/form-data">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       DELETE LESSON
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ยืนยันที่จะลบบทเรียน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        จะลบจริงๆหรอ
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ไม่อะ ไม่ลบ</button>
                        <input type="hidden" name="submit_delete" value="<?php echo $lesson_id?>"><button type="submit" class="btn btn-danger">ใช่ ฉันจะลบคอร์ส</button>
                    </div>
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