<?php
require_once('functions/config/config.php');
require_once ('functions/translations/en.php');
require_once('functions/classes/Login.php');
require_once ('functions/classes/Contents_Handler.php');

$login = new Login();
if ($login->isUserLoggedIn() == true) {
    $myUser = $login->getUserInformation();
    include_once ('dashboard/dashboard.html');
    $_SESSION['material_stage'] = 1;
} else {
    header("Location: login.php");
    exit();
}
