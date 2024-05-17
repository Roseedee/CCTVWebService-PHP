<?php
    require_once('../../action/dbconnect.php');
    require_once('./load-account.php');

    $user_id = $_GET['user-id'];

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {

        if($username == $acc_info[0]['username'] and $password == $acc_info[0]['password']) {
            $stmt_worksite = $con->prepare("DELETE FROM user WHERE user_id = :user_id");
            $stmt_worksite->bindParam(':user_id', $user_id);
            $stmt_worksite->execute();
            header('location: ../../');
        }else {
            header('location: ../cancel-account.php?error-msg=ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง&user-id=' . $user_id);
        }
        
        
    } catch(PDOException $e) {
        echo "Delete User failed: " . $e->getMessage();
        header('location: ../cancel-account.php?error-msg=ไม่สามารถลบชื่อผู้ใช้ได้ กรุณาลองใหม่อีกครั้ง&user-id=' . $user_id);
    }
?>