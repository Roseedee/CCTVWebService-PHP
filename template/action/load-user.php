<?php
    require_once("dbconnect.php");

    try {
        $stmt = $con->prepare("
            SELECT u.* FROM user u LEFT JOIN account a ON a.user_id=u.user_id WHERE a.account_type='customer';
        ");
        $stmt->execute();
    
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>