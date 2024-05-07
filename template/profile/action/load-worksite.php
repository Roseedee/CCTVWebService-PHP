<?php
    // $sql = "SELECT w.*, COUNT(DISTINCT n.noti_id) AS num_services FROM worksite w LEFT JOIN notification n ON w.worksite_id = n.worksite_id AND n.noti_status = 0 WHERE w.user_id = 4 GROUP BY w.worksite_id;"
    require_once('../action/dbconnect.php');

    $user_id = $_GET['user-id'];
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