<?php
    require_once("dbconnect.php");
    
    $noti_id = $_GET['noti-id'];

    try {
        $stmt = $con->prepare("SELECT * FROM service s WHERE s.noti_id=" . $noti_id);
        $stmt->execute();
    
        $service_info = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>