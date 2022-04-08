<?php
// access the current session
session_start();

// clear session data
session_unset();

// destroy this session
session_destroy();

// redirect to login
header('location:login.php');
?>