
<?php

$materials = $_SESSION['materials'];
if ($_SESSION['material_stage'] == -1) {
    $my_course_information = $login->getCourseInformation($_GET['course']);
    echo '<div class="box box-success direct-chat direct-chat-success"><div class="box-header with-border"style="min-height: 200px" ><h3 class="box-title">';
    echo $my_course_information;
    echo '</h3></div><div class="box-footer">';
    echo '<a class="btn btn-success btn-flat" type="button" href="learn.php?course=' . $_GET["course"] . '">START</a>';
    echo '</div></div>';
    
} else {
    
    if (count($materials) > $_SESSION['material_stage']) {
        include_once 'dashboard/views/material_view.php';
        
    } else {
        // who to update the mark
        $login->updateUserMark();
        echo '<div class="box box-success direct-chat direct-chat-success"><div class="box-header with-border" style="min-height: 200px"><h3 class="box-title">This course is done</h3></div><div class="box-footer">';
        echo '<a class="btn btn-success btn-flat" role="button" href="dashboard.php?courses">DONE</a>';
        echo '</div></div>';
    }
}
$_SESSION['material_stage'] = $_SESSION['material_stage'] + 1;
?>


