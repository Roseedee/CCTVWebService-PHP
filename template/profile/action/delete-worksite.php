<?php
    require_once('../../action/dbconnect.php');
    $worksite_id = $_GET['worksite-id'];
    $user_id = $_GET['user-id'];

    // Delete associated images
    $stmt_image_list = $con->prepare("SELECT * FROM worksite_image WHERE worksite_id = :worksite_id");
    $stmt_image_list->bindParam(':worksite_id', $worksite_id);
    $stmt_image_list->execute();

    $worksite_img_list = $stmt_image_list->fetchAll(PDO::FETCH_ASSOC);

    foreach($worksite_img_list as $image) {
        $imageFilePath = '../../../uploads/worksite-img/'. $image['img_url'];
        // echo $imageFilePath . '<br>';
        if (file_exists($imageFilePath)) {
            if (unlink($imageFilePath)) {
                echo "Image deleted successfully.";
            } else {
                echo "Failed to delete image.";
            }
        }
    }

    // Delete worksite
    $stmt_worksite = $con->prepare("DELETE FROM worksite WHERE worksite_id = :worksite_id");
    $stmt_worksite->bindParam(':worksite_id', $worksite_id);
    $stmt_worksite->execute();


    if ($stmt_worksite->rowCount() > 0) {
        header('location: ../?user-id=' . $user_id);

    } else {
        echo "Failed to delete worksite.";
        echo '<script>window.history.back();</script>';
    }
?>
