<?php
    require_once('dbconnect.php');

    try {

        $name_lastname = $_POST['name-lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $user_img = NULL;

        $stmt = $con->prepare("INSERT INTO user (name_lastname, phone, email, address, user_img) VALUES (:name_lastname, :phone, :email, :address, :user_img)");
        $stmt->bindParam(':name_lastname', $name_lastname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':user_img', $user_img);
        $stmt->execute();

        $user_id = $con->lastInsertId();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $account_type = "customer";

        $stmt = $con->prepare("INSERT INTO account (username, password, account_type, user_id) VALUES (:username, :password, :account_type, :user_id)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':account_type', $account_type);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        header('location: ./../');
    } catch(PDOException $e) {
        echo "<script>alert('Insert user failed')</script>";
    }


    $con = null;
?>
