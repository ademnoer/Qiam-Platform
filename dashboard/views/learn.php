
<?php
    $contentHander->getMaterial($course_id, $_SESSION['material_stage']);

    $my_material = $contentHander->material;

if ($my_material <> NULL) {
    $content = $my_material->material_value;
    echo '<div class="box box-success direct-chat direct-chat-success"><div class="box-header with-border">';
    include_once 'dashboard/views/materials_templates/' .$my_material->material_type . '.php';
    echo '</div><div class="box-footer">';
    echo '<a class="btn btn-success btn-flat" role="button" href="learn.php?course=' . $_GET["course"] . '">NEXT</a>';
    echo '</div></div><br>';

    $_SESSION['material_stage'] = $_SESSION['material_stage'] + 1;
} else {
    // who to update the mark
    $login->updateUserMark();
    echo '<div class="box box-success direct-chat direct-chat-success"><div class="box-header with-border" style="min-height: 200px"><h3 class="box-title">لقد اتمت هذا الكورس بنجاح ، سوف يتم اضافة نقاط جديدة الى رصيدك</h3></div><div class="box-footer">';
    echo '<a class="btn btn-success btn-flat" role="button" href="dashboard.php?courses">DONE</a>';
    echo '</div></div>';
    $_SESSION['material_stage'] = 1;
}
?>



<?php
?>


