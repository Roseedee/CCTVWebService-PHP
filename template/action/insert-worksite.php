<?php
    require_once('dbconnect.php');

    $user_id = $_POST['user-id'];
    $worksite_name = $_POST['worksite-name'];
    $address = $_POST['address'];
    $camera_number = $_POST['camera-number'];
    $install_date = $_POST['install-date'];
    $other_details = $_POST['other-details'];

    // echo $user_id . " " . $worksite_name . " " . $address . " " . $camera_number . " " . $other_details . " " . $install_date;

    try {
        $stmt = $con->prepare("INSERT INTO worksite (worksite_name, address, camera_number, install_date, other_details, user_id) VALUES (:worksite_name, :address, :camera_number, :install_date, :other_details, :user_id)");
        $stmt->bindParam(':worksite_name', $worksite_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':camera_number', $camera_number);
        $stmt->bindParam(':install_date', $install_date);
        $stmt->bindParam(':other_details', $other_details);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        header('location: ../');
    } catch(PDOException $e) {
        echo "insert worksite failed : " . $e->getMessage();
        header('location: ../new-user.php');
    }

    $con = null;


?>