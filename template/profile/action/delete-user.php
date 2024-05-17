<?php
    require_once('../../action/dbconnect.php');
    require_once('./load-account.php');

    $user_id = $_GET['user-id'];

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {

        if($username == $acc_info[0]['username'] and $password == $acc_info[0]['password']) {
            echo 'correct';
        }else {
            echo 'wrong';
        }
        $stmt_worksite = $con->prepare("DELETE FROM user WHERE user_id = :user_id");
        $stmt_worksite->bindParam(':user_id', $user_id);
        $stmt_worksite->execute();
        
        header('location: ../../');
        
    } catch(PDOException $e) {
        echo "Delete User failed: " . $e->getMessage();
        header('location: ../?user-id=' . $user_id);
    }
?>