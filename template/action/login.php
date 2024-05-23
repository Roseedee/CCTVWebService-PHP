<?php
    require_once('dbconnect.php');
    session_start();

    try {
        //รับค่าจากฟอร์มล็อกอิน
        $username = $_POST['username'];
        $password = $_POST['password'];

        //ป้องกัน sql แบบพื้นฐาน
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        //เช็ค username กับ password ในฐานข้อมูล
        $stmt = $con->prepare("SELECT * FROM account WHERE username=:username AND password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        //เงื่อนไข สำหรับเช็ค uesrname กับ password ที่กรอกมามีหรือไม่ในฐานข้อมูล
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
           
            //เก็บค่าใน session
            $_SESSION['user-login-id'] = $user['user_id'];
            $_SESSION['user-acc-type'] = $user['account_type'];

            //เช็คว่าเป็น admin หรือไม่
            if($user['account_type'] == 'admin') {
                header("location: ../");
            }else {
                require_once('load-admin-info.php');
                header('location: ../profile/?user-id=' . $user['user_id']);
            }

        } else {
            header("location: ../../index.php?login_error=1");
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
