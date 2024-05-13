<?php
    session_start();
    require_once('../../action/dbconnect.php');
    $user_id = $_GET['user-id'];

    $current_password = $_SESSION['current-password'];
    $old_password = $_POST['old-password'];


    if($old_password != $current_password) {
        header('location: ../password-manage.php?password-incorrect=รหัสผ่านไม่ถูกต้อง&user-id='.$user_id);
        exit;
    }
    
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];
    
    if($new_password != $confirm_password) {
        header('location: ../password-manage.php?password-notmatch=รหัสผ่านไม่ตรงกัน&current-password=' . $current_password . '&user-id='.$user_id);
        exit;
    }
    
    try {

        $stmt = $con->prepare("UPDATE account SET password = :password WHERE user_id = :user_id");
        $stmt->bindParam(':password', $new_password);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        header('location: ../?user-id='. $user_id);
    } catch(PDOException $e) {
        echo "Update user failed: " . $e->getMessage();
    }
?>