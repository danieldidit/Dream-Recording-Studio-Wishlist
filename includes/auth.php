<?php
// authentication check so users who are not logged in cannot manipulate data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// if no username is assigned to session variable, redirect to login, & stop page from executing
if (empty($_SESSION['username'])) {
    header('location:login.php');
    exit();
}
?>