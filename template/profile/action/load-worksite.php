<?php
    require_once('../action/dbconnect.php');

    $worksite_id = $_GET['worksite-id'];
    try {
        $stmt = $con->prepare("
            SELECT 
                *
            FROM 
                worksite w 
            WHERE 
                w.worksite_id = " . $worksite_id . ";
        ");
        $stmt->execute();
    
        $worksite = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>