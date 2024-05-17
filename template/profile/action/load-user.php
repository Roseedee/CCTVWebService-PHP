<?php
    require_once('../action/dbconnect.php');

    if($_SESSION['user-acc-type'] == 'admin') { //admin
        $user_id = $_GET['user-id'];
    }else {
        $user_id = $_SESSION['user-login-id'];  //customer
    }


    try {
        $stmt = $con->prepare("
            SELECT * from user WHERE user.user_id = " . $user_id . "
        ");
        $stmt->execute();
    
        $user_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['user-img-type'] = $user_info[0]['img_type'];

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>