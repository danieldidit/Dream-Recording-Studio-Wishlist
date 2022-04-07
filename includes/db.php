<?php
// shared db connection for use on any page
$db = new PDO('mysql:host=172.31.22.43;dbname=Daniel200352106', 'Daniel200352106', 'sEmIhvPPaS');

// enable PDO error messages as these are hidden by default
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);