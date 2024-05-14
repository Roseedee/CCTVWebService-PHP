<?php
    require_once("dbconnect.php");

    $user_id = $_GET['user-id'];
    try {
        $stmt = $con->prepare("SELECT * FROM worksite w WHERE w.user_id=" . $user_id);
        $stmt->execute();
    
        $worksite_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>