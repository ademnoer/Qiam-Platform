<?php

require_once('functions/config/config.php');
require_once ('functions/translations/en.php');
require_once('functions/classes/Login.php');

$login = new Login();

if ($login->isUserLoggedIn() == true) {
    if (isset($_GET['course'])) {
        if ($_SESSION['material_stage'] == -1){
            $my_course_materials = $login->getCourseMaterials($_GET['course']);
            $_SESSION['materials'] = $my_course_materials;
        }
        include_once ('dashboard/learn.html');
    } else {
        header("Location: dashboard.php?courses");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
