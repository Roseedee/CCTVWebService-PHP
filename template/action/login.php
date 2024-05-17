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
            
            $_SESSION['user-login-id'] = $user['user_id'];
            $_SESSION['user-acc-type'] = $user['account_type'];

            if($user['account_type'] == 'admin') {
                header("location: ../");
            }else {
                require_once('load-admin-info.php');
                header('location: ../profile/?user-id=' . $user['user_id']);
            }

        } else {
            header("location: ../../index.php?login_error=1");
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
