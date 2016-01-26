<?php
require_once('functions/config/config.php');
require_once ('functions/translations/en.php');
require_once('functions/classes/Login.php');

$login = new Login();
if ($login->isUserLoggedIn() == true) {
    $myUser = $login->getUserInformation();
    include_once ('dashboard/dashboard.html');

} else {
    header("Location: login.php");
    exit();
}
