<?php

require_once('functions/config/config.php');
require_once ('functions/translations/en.php');
require_once('functions/classes/Login.php');
require_once ('functions/classes/Contents_Handler.php');

$login = new Login();

if ($login->isUserLoggedIn() == true) {
    
    $course_id = (int) $_GET['course'];
    if ($course_id <> 0) {
        $contentHander = new content_handler();        
        include_once ('dashboard/learn.html');
    } else {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
