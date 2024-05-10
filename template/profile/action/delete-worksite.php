<?php
    require_once('../../action/dbconnect.php');
    $worksite_id = $_GET['worksite-id'];
    $user_id = $_GET['user-id'];

    $stmt = $con->prepare("DELETE FROM worksite WHERE worksite_id = :worksite_id");
    $stmt->bindParam(':worksite_id', $worksite_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header('location: ../?user-id=' . $user_id);

    } else {
        echo "Failed to delete worksite.";
        echo '<script>window.history.back();</script>';
    }
?>
