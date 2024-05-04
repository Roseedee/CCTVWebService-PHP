<?php
    require_once("dbconnect.php");

    try {
        $stmt = $con->prepare("
            SELECT 
                u.*,
                COUNT(DISTINCT w.worksite_id) AS num_worksites,
                COUNT(DISTINCT n.noti_id) AS num_services,
                MAX(s.service_datetime) AS latest_service_date
            FROM 
                user u
            JOIN 
                account a ON u.user_id = a.user_id
            LEFT JOIN 
                worksite w ON u.user_id = w.user_id
            LEFT JOIN 
                notification n ON u.user_id = n.user_id AND n.noti_status = 0
            LEFT JOIN 
                service s ON s.noti_id = n.noti_id
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