<section class="content-header"><br>
    <h1>معلومات المسار الحالي</h1>
    <br><br>
</section>

<section class="content">

    <?php
    
    require_once ('functions/classes/courses_handler.php');
    $courseHander = new courses_handler();
    if (isset($_GET["course"])) {
        $course_id = $_GET["course"];
    } else {
        header("Location: dashboard.php");
    }

    if (is_integer($course_id)) {
        echo 'integer';
    }

    $courseHander->getCourse($course_id);
    $courseHander->getMaterialsTypes($course_id);
    $myCourse = $courseHander->course;
    $myMaterialsType = $courseHander->materials_types;

    echo '   <div class="box box-success direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">' . $myCourse->course_name . '</h3>
                </div>
                <div class="box-body">
                    <p class="margin">' . $myCourse->course_description . '</p><br>
                    <p class="margin">يتكون هذا المسار من</p>
                    <p class="margin">';
    foreach ($myMaterialsType as $type) {
        echo '<img alt="error in img" width="64p" src="img/icons/' . $type["material_type"] . '-icon.png">';
    }
    echo '              </p><br>
                </div>
                <div class="box-footer">
                    <a href="learn.php?course=' . $myCourse->course_id . '" type="button" class="btn btn-success btn-flat">دراسة المسار</a>
                </div>
            </div>';
    ?>

</section>












