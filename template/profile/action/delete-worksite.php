<?php
    require_once('../../action/dbconnect.php');
    $worksite_id = $_GET['worksite-id'];

    $stmt = $con->prepare("DELETE FROM worksite WHERE worksite_id = :worksite_id");
    $stmt->bindParam(':worksite_id', $worksite_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header('location: ../');

    } else {
        echo "Failed to delete worksite.";
        echo '<script>window.history.back();</script>';
    }
?>
