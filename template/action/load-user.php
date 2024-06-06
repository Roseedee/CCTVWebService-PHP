<?php
    require_once("dbconnect.php");

    try {
        $stmt = $con->prepare("
            SELECT * FROM user;
        ");
        $stmt->execute();
    
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>