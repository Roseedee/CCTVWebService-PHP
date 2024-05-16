<?php
    require_once('../../action/dbconnect.php');
    $img_id = $_GET['image-id'];
    $img_url = $_GET['image-name'];
    $worksite_id = $_GET['worksite-id'];
    $user_id = $_GET['user-id'];

    $stmt = $con->prepare("DELETE FROM worksite_image WHERE img_id = :img_id");
    $stmt->bindParam(':img_id', $img_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $imageFilePath = '../../../uploads/worksite-img/' . $img_url;

        if (file_exists($imageFilePath)) {
            if (unlink($imageFilePath)) {
                echo "Image deleted successfully.";
            } else {
                echo "Failed to delete image.";
            }
        }

        header('location: ./../form-update-worksite.php?worksite-id=' . $worksite_id . '&user-id=' . $user_id);
    } else {
        echo "Failed to delete image.";
    }
?>