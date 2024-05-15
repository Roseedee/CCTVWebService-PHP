<?php
    require_once('dbconnect.php');

    $noti_id = $_GET['noti-id'];
    $service_date = $_POST['service-date'];
    $service_details = $_POST['service-details'];

    try {
        $stmt = $con->prepare("INSERT INTO service (service_details, service_datetime, noti_id) VALUES (:service_details, :service_date, :noti_id)");
        $stmt->bindParam(':service_details', $service_details);
        $stmt->bindParam(':service_date', $service_date);
        $stmt->bindParam(':noti_id', $noti_id);
        $stmt->execute();

        $stmt = $con->prepare("UPDATE notification SET noti_status=0 WHERE noti_id = :noti_id");
        $stmt->bindParam(':noti_id', $noti_id);
        $stmt->execute();

        header('location: ../notify-services.php');
    } catch(PDOException $e) {
        echo "insert user failed : " . $e->getMessage();
        header('location: ../service.php?noti-id=' . $noti_id);
    }

    $con = null;

?>