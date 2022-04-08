<?php
// gather login form inputs
$username = $_POST['username'];
$password = $_POST['password'];

try {
    // connect
    require 'includes/db.php';

    // fetch user based on their username
    $sql = "SELECT * FROM wishlist_users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // if username is not found, display login page with invalid login message
    if (!$user) {
        $db = null;
        header('location:login.php?invalid=true');
    }
    // if username found, hash and compare the passwords
    else {
        // if passwords don't match, display login page with invalid login message
        if (!password_verify($password, $user['password'])) {
            $db = null;
            header('location:login.php?invalid=true');
        }
        // if passwords match call session_start()
        else {
            // Store username in a session variable, so we can access it on any page
            session_start();
            $_SESSION['username'] = $username;
            $db = null;
            
            // User is successfully logged in, so redirect to home page
            header('location:wishlist.php');
        }
    }
}
catch (Exception $error) {
    // an error happened so redirect to the error page
    header('location:error.php');
}
?>