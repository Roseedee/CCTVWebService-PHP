<?php
    require_once("../action/dbconnect.php");
    
    $worksite_id = $_GET['worksite-id'];

    try {
        $stmt = $con->prepare("SELECT n.noti_id, n.notification, n.noti_datetime, n.noti_status, s.service_details, s.service_datetime FROM notification n LEFT JOIN service s ON n.noti_id=s.noti_id WHERE n.worksite_id=" . $worksite_id . " ORDER BY n.noti_id DESC");
        $stmt->execute();
    
        $noti_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>