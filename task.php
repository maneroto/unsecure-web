<?php
    require 'config.php';
    require 'functions.php';
    $pageInfo["css"] = sprintf('<link rel="stylesheet" href="%s" />', get_src("static/css/task.css"));
    include(get_file('templates/open.php'));
    include(get_file('templates/pages/task.php'));
    include(get_file('templates/close.php'));
?>