<section class="content-header"><br>
    <h1>عرض المسارات المتاحة</h1>
</section>

<section class="content">
    <div class="row">

<?php 

$courseHander = new content_handler();
$courseHander->getAllCourses();
$myCourses = $courseHander->courses;

foreach ($myCourses as $course) {
    echo '<div class="col-md-4">
            <div class="box box-success direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">'.$course["course_name"].'</h3>
                </div>
                <div class="box-body">
                    <img class="img-responsive pad" src="'.$course["course_thumb"].'" alt="Photo">
                </div>
                <div class="box-footer">
                    <a href="dashboard.php?course='.$course["course_id"].'" type="button" class="btn btn-success btn-flat">دراسة المسار</a>
                </div>
            </div>
        </div>';
}

?>


    </div>
</section>












