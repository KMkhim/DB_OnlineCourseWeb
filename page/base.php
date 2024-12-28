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
<nav class="navbar navbar-expand-lg bg-body-tertiary position-sticky top-0" style="z-index: 1000;">
    <div class="container">
        <a class="nav-link" href="#">
            <img src="image/homepage_icon.png" alt="Bootstrap" width="50" height="50" class="rounded float-start">
        </a>
        <a class="nav-link" href="../page/home.php"> Home Page</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../regis/signin.php">เข้าสู่ระบบ</a>
                <!-- <button color="primary"  class="btn btn-success btn-lg purple-button" style={{ backgroundColor: 'purple' }} onclick="location.href='../regis/index.php'">ลงทะเบียน</button> -->
                <button type="button" class="btn btn-purple"  onclick="location.href='../regis/index.php'">ลงทะเบียน</button>

                <!-- <a class="nav-link" href="../regis/index.php">ลงทะเบียน</a> -->
            </div>
        </div>
    </div>
 </nav>
 <nav class="nav navbar-expand-sm bg-dark navbar-dark justify-content-center position-sticky" style="top: 69px; z-index: 999;">
    <a class="nav-link" style="color : aliceblue;" href="./home.php">หน้าแรก</a>
    <a class="nav-link" style="color: aliceblue;" href="#mathSubject">คณิตศาสตร์</a>
    <a class="nav-link" style="color : aliceblue;" href="#sciSubject">วิทยาศาสตร์</a>
    <a class="nav-link" style="color : aliceblue;" href="#engSubject">ภาษาอังกฤษ</a>
    <a class="nav-link" style="color : aliceblue;" href="#socialSubject">สังคม</a>
    <a class="nav-link" style="color : aliceblue;" href="#thaiSubject">ภาษาไทย</a>
 </nav>

 
    
</body>


</html>