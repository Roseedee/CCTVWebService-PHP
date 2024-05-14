<?php
    require_once('dbconnect.php');

    try {
        $target_dir = "../../uploads/notification-img/";
        $uploadOk = 1;

        if (!empty($_FILES["notification-img"]["name"])) {
            $imageFileType = strtolower(pathinfo($_FILES["notification-img"]["name"], PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["notification-img"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $user_id = $_POST['user-id'];
            $worksite_id = $_POST['worksite-id'];
            $noti_details = $_POST['notification-details'];

            $stmt = $con->prepare("INSERT INTO notification (notification, user_id, worksite_id) VALUES (:notification, :user_id, :worksite_id)");
            $stmt->bindParam(':notification', $noti_details);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':worksite_id', $worksite_id);
            $stmt->execute();
            
            if (!empty($_FILES["notification-img"]["name"])) {
                $noti_id = $con->lastInsertId();
                
                $newFileName = $noti_id . "." . $imageFileType;
                $newFilePath = $target_dir . $newFileName;
                
                if (move_uploaded_file($_FILES["notification-img"]["tmp_name"], $newFilePath)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["notification-img"]["name"])) . " has been uploaded.<br>";
                    echo "The file path is: " . $newFilePath . "<br>";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
                
                $stmt = $con->prepare("UPDATE notification SET img_name = :img_name WHERE noti_id = :noti_id");
                $stmt->bindParam(':img_name', $newFileName);
                $stmt->bindParam(':noti_id', $noti_id);
                $stmt->execute();
            }

            header('location: ../notify-services.php');
        }
    } catch(PDOException $e) {
        echo "insert user failed : " . $e->getMessage();
        header('location: ../new-notification.php');
    }

    $con = null;
?>
