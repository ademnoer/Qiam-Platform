<?php

$old_path = getcwd();
chdir('/home/ubuntu');
$output = shell_exec('./deploy.sh');
chdir($old_path);
echo $output;
?>