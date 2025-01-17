<?php
    require_once('dbconnect.php');

    $user_id = $_POST['user-id'];
    $worksite_name = $_POST['worksite-name'];
    $address = $_POST['address'];
    $camera_number = $_POST['camera-number'];
    $install_date = $_POST['install-date'];
    $other_details = $_POST['other-details'];

    try {
        $stmt = $con->prepare("INSERT INTO worksite (worksite_name, address, camera_number, install_date, other_details, user_id) VALUES (:worksite_name, :address, :camera_number, :install_date, :other_details, :user_id)");
        $stmt->bindParam(':worksite_name', $worksite_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':camera_number', $camera_number);
        $stmt->bindParam(':install_date', $install_date);
        $stmt->bindParam(':other_details', $other_details);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        $worksite_id = $con->lastInsertId();

        if(isset($_FILES['worksite-img'])) {
            $files = $_FILES['worksite-img'];
            
            for($i = 0; $i < count($files['name']); $i++) {
                $file_name = $files['name'][$i];
                $file_tmp = $files['tmp_name'][$i];
                $currentTimeStamp = time();
                
                $img_id = $worksite_id . "_" . $currentTimeStamp . "_" . $i;
                $new_file_name = $img_id . "_" . $file_name;
                
                $stmt = $con->prepare("INSERT INTO worksite_image (img_url, worksite_id) VALUES (:img_url, :worksite_id)");
                $stmt->bindParam(':img_url', $new_file_name);
                $stmt->bindParam(':worksite_id', $worksite_id);
                $stmt->execute();
                
                move_uploaded_file($file_tmp, "../../uploads/worksite-img/" . $new_file_name);
            }
        }
        
        header('location: ../');
    } catch(PDOException $e) {
        echo "Insert worksite failed: " . $e->getMessage();
        header('location: ../new-worksite.php');
    }

    $con = null;
?>
