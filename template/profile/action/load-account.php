<?php
    if($_SESSION['user-acc-type'] == 'admin') { //admin
        $user_id = $_GET['user-id'];
    }else {
        $user_id = $_SESSION['user-login-id'];  //customer
    }

    try {
        $stmt = $con->prepare("
            SELECT * from account WHERE account.user_id = " . $user_id . "
        ");
        $stmt->execute();
    
        $acc_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>