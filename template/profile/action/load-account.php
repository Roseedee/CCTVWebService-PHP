<?php
    require_once('../action/dbconnect.php');

    $user_id = $_GET['user-id'];
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