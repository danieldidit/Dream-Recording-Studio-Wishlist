<!-- Sets the title as registering and calls in the header-->
<?php
$title = 'registering';
require 'includes/header.php';

try {
// capture form inputs
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $ok = true;

// validate inputs
    if (empty($email)) {
        echo '<p class="alert-warning">E-mail is required</p>';
        $ok = false;
    }
    if (empty($username)) {
        echo '<p class="alert-warning">Username is required</p>';
        $ok = false;
    }
    if (empty($password)) {
        echo '<p class="alert-warning">Password is required</p>';
        $ok = false;
    }
    if ($password != $confirm) {
        echo '<p class="alert-warning"> Passwords do not match.</p>';
        $ok = false;
    }
    
    if ($ok) {
        // connect
        require 'includes/db.php';
        
        // check for duplicate e-mail
        $sql = "SELECT * FROM wishlist_users WHERE email = :email";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $cmd->execute();
        $userEmail = $cmd->fetch();
        
        // If the e-mail is found throw a warning
        if ($userEmail) {
            echo '<p class="alert alert-warning">E-mail already exists</p>';
            $db = null;
            exit();
        }
        
        // check for duplicate user
        $sql = "SELECT * FROM wishlist_users WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $user = $cmd->fetch();
        
        // If the username is found throw a warning
        if ($user) {
            echo '<p class="alert alert-warning">Username already exists</p>';
            $db = null;
            exit();
        }
        
        // hash password
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        // save new user
        $sql = "INSERT INTO wishlist_users (email, username, password) VALUES (:email, :username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();
        
        // disconnect
        $db = null;
        
        // redirect to login
        header('location:login.php');
    }
}
catch (Exception $error) {
     //an error happened so redirect to the error page
    header('location:error.php');
}
?>
</body>
</html>
