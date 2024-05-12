<?php
    require_once('../../action/dbconnect.php');
    $imageFileType = $_GET['img-type'];
    $user_id = $_GET['user-id'];

    $name_lastname = $_POST['name_lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    try {
        if(!empty($_FILES['user-img']['name'])) {
            $imageFilePath = '../../../uploads/user-img/' . $user_id . '.' . $imageFileType;
            echo $imageFilePath;
    
            if (file_exists($imageFilePath)) {
                if (unlink($imageFilePath)) {
                    echo "Image deleted successfully.";
                } else {
                    echo "Failed to delete image.";
                }
            }else {
                echo "File not found";
            }
    
            $imageFileType = strtolower(pathinfo($_FILES["user-img"]["name"], PATHINFO_EXTENSION));
    
            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
    
            $target_dir = "../../../uploads/user-img/";
    
            $newFileName = $user_id . "." . $imageFileType;
            $newFilePath = $target_dir . $newFileName;
            if (move_uploaded_file($_FILES["user-img"]["tmp_name"], $newFilePath)) {
                echo "The file " . htmlspecialchars(basename($_FILES["user-img"]["name"])) . " has been uploaded.<br>";
                echo "The file path is: " . $newFilePath . "<br>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        $stmt = $con->prepare("UPDATE user SET name_lastname = :name_lastname, phone = :phone, email = :email, address = :address, img_type = :img_type WHERE user_id = :user_id");
        $stmt->bindParam(':name_lastname', $name_lastname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':img_type', $imageFileType);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        header('location: ../?user-id='. $user_id);
    } catch(PDOException $e) {
        echo "Update user failed: " . $e->getMessage();
    }
?>
