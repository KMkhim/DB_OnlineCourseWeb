<?php
    session_start();
    require_once '../config/db.php';

    if (isset($_POST['signup'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $c_password = $_POST['c_password'];
        $role = 'student';
        
        if(empty($username)){
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: ./index.php");  
        } else if (empty($email)){
            $_SESSION['error'] = 'กรุณากรอก email';
            header("location: ./index.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: ./index.php");
        } else if (empty($fname)){
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: ./index.php");
        }else if (empty($lname)){
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: ./index.php");
        }else if (empty($password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: ./index.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5){
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: ./index.php");
        } else if (empty($c_password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่านยืนยัน';
            header("location: ./index.php");
        } else if ($password != $c_password){
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: ./index.php");
        } else {
            try {   

                $check_email = $conn->prepare("SELECT email FROM Users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email){
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header('location: ./index.php');
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO Users(username , email ,fname, lname, password, role) 
                                            VALUES(:username, :email,:fname,:lname, :password, :role)");
                    $stmt->bindParam(":username", $username);   
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":fname", $fname);
                    $stmt->bindParam(":lname", $lname);
                    $stmt->bindParam(":password",$passwordHash);
                    $stmt->bindParam(":role", $role);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิ๊กที่นี่</a>เพื่อเข้าสู่ระบบ";
                    header("location: ./index.php");
                } else{
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: ./index.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }   
        } 

        
    }
