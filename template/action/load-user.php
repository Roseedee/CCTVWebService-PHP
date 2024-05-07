<?php
    require_once("dbconnect.php");

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
            a.account_type = 'customer'
        GROUP BY 
            u.user_id;
        ");
        $stmt->execute();
    
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>