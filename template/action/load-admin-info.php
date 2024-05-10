<?php
    require_once("dbconnect.php");

    $admin_user_id = $_SESSION['admin-user-id'];

    try {
        $stmt = $con->prepare("
        SELECT 
            u.user_id,
            u.name_lastname,
            u.img_type
        FROM 
            user u
        JOIN 
            account a ON u.user_id = a.user_id
        WHERE 
            a.account_type = 'admin' AND u.user_id = " . $admin_user_id . ";
        ");
        $stmt->execute();
    
        $admin = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        $_SESSION['admin-user-image'] = $admin['user_id'] . "." . $admin['img_type'];
        $_SESSION['admin-user-name'] = $admin['name_lastname'];

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>