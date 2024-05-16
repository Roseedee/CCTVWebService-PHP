<?php
    require_once("dbconnect.php");
    
    $noti_id = $_GET['noti-id'];

    try {
        $stmt = $con->prepare("SELECT n.noti_id, n.notification, n.noti_datetime, n.img_name, n.noti_status, u.user_id, u.name_lastname, w.worksite_id, w.worksite_name FROM notification n LEFT JOIN user u ON n.user_id=u.user_id LEFT JOIN worksite w ON n.worksite_id=w.worksite_id WHERE n.noti_id=" . $noti_id);
        $stmt->execute();
    
        $noti_info = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>