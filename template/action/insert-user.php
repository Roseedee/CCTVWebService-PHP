<?php
    require_once('dbconnect.php');
    session_start();

    try {
        $target_dir = "../../uploads/user-img/";
        $uploadOk = 1;

        if (!empty($_FILES["user_img"]["name"])) {
            $imageFileType = strtolower(pathinfo($_FILES["user_img"]["name"], PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["user_img"]["tmp_name"]);
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

            $name_lastname = $_POST['name-lastname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            $username = $_POST['username'];
            $password = $_POST['password'];
            $account_type = "customer";

            $stmt = $con->prepare("SELECT * FROM account WHERE username=:username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if($stmt->rowCount() == 0) {
                $stmt = $con->prepare("INSERT INTO user (name_lastname, phone, email, address, img_type) VALUES (:name_lastname, :phone, :email, :address, :img_type)");
                $stmt->bindParam(':name_lastname', $name_lastname);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':img_type', $imageFileType);
                $stmt->execute();
    
                $user_id = $con->lastInsertId();
    
                $newFileName = $user_id . "." . $imageFileType;
                $newFilePath = $target_dir . $newFileName;
    
                if (move_uploaded_file($_FILES["user_img"]["tmp_name"], $newFilePath)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["user_img"]["name"])) . " has been uploaded.<br>";
                    echo "The file path is: " . $newFilePath . "<br>";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
    
                $stmt = $con->prepare("INSERT INTO account (username, password, account_type, user_id) VALUES (:username, :password, :account_type, :user_id)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':account_type', $account_type);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
    
                header('location: ./../');
            }else {
                $_SESSION['name-lastname-temp'] = $name_lastname;
                $_SESSION['phone-temp'] = $phone;
                $_SESSION['email-temp'] = $email;
                $_SESSION['address-temp'] = $address;
                header('location: ./../new-user.php?insert-error=1');
            }

        }
    } catch(PDOException $e) {
        echo "insert user failed : " . $e->getMessage();
        header('location: ./../new-user.php');
    }

    $con = null;
?>
