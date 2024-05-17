<?php
    session_start();
    require_once('../../action/dbconnect.php');
    require_once('./load-account.php');

    if($_SESSION['user-acc-type'] == 'admin') { //admin
        $user_id = $_GET['user-id'];
    }else {
        $user_id = $_SESSION['user-login-id'];  //customer
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {

        if($username == $acc_info[0]['username'] and $password == $acc_info[0]['password']) {
            $stmt_worksite = $con->prepare("DELETE FROM user WHERE user_id = :user_id");
            $stmt_worksite->bindParam(':user_id', $user_id);
            $stmt_worksite->execute();
            header('location: ../../');
            if($_SESSION['user-acc-type'] != 'admin') {
                header('location: ../../signout.php');
            }
        }else {
            header('location: ../cancel-account.php?error-msg=ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง&user-id=' . $_SESSION['user-login-id']);
        }
        
        
    } catch(PDOException $e) {
        echo "Delete User failed: " . $e->getMessage();
        header('location: ../cancel-account.php?error-msg=ไม่สามารถลบชื่อผู้ใช้ได้ กรุณาลองใหม่อีกครั้ง&user-id=' . $_SESSION['user-login-id']);
    }
?>