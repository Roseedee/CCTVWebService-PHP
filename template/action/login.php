<?php
    require_once('dbconnect.php');
    session_start();

    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $database = "your_database_name";

    try {
        // Retrieve data from login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Protect against SQL injection
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        // Query the database for user with entered credentials
        $stmt = $con->prepare("SELECT * FROM account WHERE username=:username AND password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Check if a user was found with matching credentials
        if ($stmt->rowCount() == 1) {
            // Successful login, set session variables and redirect to home page
            $_SESSION['username'] = $username;
            header("location: ../");
        } else {
            header("location: ../../index.php?login_error=1");
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
