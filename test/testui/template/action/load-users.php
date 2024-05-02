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
                notification n ON u.user_id = n.user_id
            LEFT JOIN 
                service s ON s.noti_id = n.noti_id
            WHERE 
                a.account_type = 'customer' AND n.noti_status = 0
            GROUP BY 
                u.user_id;
        ");
        $stmt->execute();
    
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // foreach ($customers as $customer) {
        //     echo "User ID: " . $customer['user_id'] . "<br>";
        //     echo "Name Lastname: " . $customer['name_lastname'] . "<br>";
        //     echo "Phone: " . $customer['phone'] . "<br>";
        //     echo "Email: " . $customer['email'] . "<br>";
        //     echo "Address: " . $customer['address'] . "<br>";
        //     echo "User Image: " . $customer['user_img'] . "<br>";
        //     echo "<hr>";
        // }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>