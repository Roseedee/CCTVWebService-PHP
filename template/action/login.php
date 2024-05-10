<?php
    require_once('dbconnect.php');
    session_start();

    try {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $stmt = $con->prepare("SELECT * FROM account WHERE username=:username AND password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['admin-user-id'] = $user['user_id'];
            header("location: ../");
        } else {
            header("location: ../../index.php?login_error=1");
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
