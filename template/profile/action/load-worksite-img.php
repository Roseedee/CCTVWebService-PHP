<?php
    require_once('../action/dbconnect.php');

    $worksite_id = $_GET['worksite-id'];
    try {
        $stmt = $con->prepare("
            SELECT 
                *
            FROM 
                worksite_image w 
            WHERE 
                w.worksite_id = " . $worksite_id . ";
        ");
        $stmt->execute();
    
        $worksite_img_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>