<?php

$content = $materials[$_SESSION['material_stage']]['material_value'];
echo '<div class="box box-success direct-chat direct-chat-success"><div class="box-header with-border">';
include_once 'dashboard/views/materials_templates/' . $materials[$_SESSION['material_stage']]['material_type'] . '.php';
echo '</div><div class="box-footer">';
echo '<a class="btn btn-success btn-flat" role="button" href="learn.php?course=' . $_GET["course"] . '">NEXT</a>';
echo '</div></div><br>';

