<?php
require_once('functions/config/config.php');
require_once ('functions/translations/en.php');
require_once('functions/classes/Login.php');
$login = new Login();
if ($login->isUserLoggedIn() == true) {
    header("Location: dashboard.php");
    exit();
} else {
    require_once ('dashboard/login.html');
    exit();
}