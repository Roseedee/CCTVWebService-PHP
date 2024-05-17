<?php
    require_once('../action/dbconnect.php');

    if($_SESSION['user-acc-type'] == 'admin') { //admin
        $user_id = $_GET['user-id'];
    }else {
        $user_id = $_SESSION['user-login-id'];  //customer
    }

    try {
        $stmt = $con->prepare("
            SELECT 
                w.*,
                COUNT(DISTINCT n.noti_id) AS num_services,
                CASE 
                    WHEN w.install_date < DATE_SUB(CURRENT_DATE(), INTERVAL 2 YEAR) THEN 0
                    ELSE 1
                END AS install_date_status
            FROM 
                worksite w 
            LEFT JOIN 
                notification n ON w.worksite_id = n.worksite_id AND n.noti_status = 0
            WHERE 
                w.user_id = " . $user_id . "
            GROUP BY 
                w.worksite_id;
        ");
        $stmt->execute();
    
        $worksite_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>