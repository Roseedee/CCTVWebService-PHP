<?php
    require_once("dbconnect.php");

    $kw_search = $_GET['kw-search'];

    if($_SESSION['user-acc-type'] == 'admin') {
        $sql = "
            SELECT 
                u.user_id, u.name_lastname, u.phone, u.email, u.img_type,
                w.worksite_id, w.worksite_name, w.address,
                n.noti_id, n.notification, n.noti_datetime, 
                CASE  WHEN 
                    w.install_date < DATE_SUB(CURRENT_DATE(), INTERVAL 2 YEAR) THEN 0
                ELSE 1 END AS install_date_status,
                n.noti_status 
            FROM 
                notification n 
            LEFT JOIN 
                user u on n.user_id=u.user_id 
            LEFT JOIN 
                worksite w ON n.worksite_id=w.worksite_id
            WHERE
                u.name_lastname LIKE CONCAT('%', '" . $kw_search . "', '%')
                OR w.worksite_name LIKE CONCAT('%', '" . $kw_search . "', '%')
                OR n.notification LIKE CONCAT('%', '" . $kw_search . "', '%')
            ORDER BY 
                n.noti_id
            DESC;
        ";
    }else {
        $user_id = $_SESSION['user-login-id'];
        $sql = "
            SELECT 
                u.user_id, u.name_lastname, u.phone, u.email, u.img_type,
                w.worksite_id, w.worksite_name, w.address,
                n.noti_id, n.notification, n.noti_datetime, 
                CASE  WHEN 
                    w.install_date < DATE_SUB(CURRENT_DATE(), INTERVAL 2 YEAR) THEN 0
                ELSE 1 END AS install_date_status,
                n.noti_status 
            FROM 
                notification n 
            LEFT JOIN 
                user u on n.user_id=u.user_id 
            LEFT JOIN 
                worksite w ON n.worksite_id=w.worksite_id 
            WHERE
                n.user_id=" . $user_id . "
                AND (
                    w.worksite_name LIKE CONCAT('%', '" . $kw_search . "', '%')
                    OR n.notification LIKE CONCAT('%', '" . $kw_search . "', '%')
                )
            ORDER BY 
                n.noti_id
            DESC;
        ";
    }

    try {
        $stmt = $con->prepare($sql);
        $stmt->execute();
    
        $notification_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
