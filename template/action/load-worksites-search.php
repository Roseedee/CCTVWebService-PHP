<?php
    require_once("dbconnect.php");

    $kw_search = $_GET['kw-search'];

    try {
        $stmt = $con->prepare("
            SELECT 
                u.name_lastname, u.phone, u.img_type,
                w.*,
                COUNT(DISTINCT n.noti_id) AS num_services,
                MAX(s.service_datetime) AS latest_service_date,
                CASE 
                    WHEN w.install_date < DATE_SUB(CURRENT_DATE(), INTERVAL 2 YEAR) THEN 0
                    ELSE 1
                END AS install_date_status
            FROM 
                worksite w 
            LEFT JOIN 
                user u on w.user_id = u.user_id 
            LEFT JOIN
                notification n on w.worksite_id = n.worksite_id AND n.noti_status = 0 
            LEFT JOIN 
                service s on n.noti_id = s.noti_id
            WHERE
                w.worksite_name LIKE CONCAT('%', '" . $kw_search . "', '%')
                OR w.address LIKE CONCAT('%', '" . $kw_search . "', '%')
            GROUP BY 
                w.worksite_id 
            ORDER BY 
                w.user_id;"
        );
        $stmt->execute();
    
        $worksite_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>