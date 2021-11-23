<?php
    require 'config.php';
    require 'functions.php';
    $pageInfo["css"] = sprintf('<link rel="stylesheet" href="%s" />', get_src("static/css/sign.css"));
    $pageInfo["js"] = sprintf('<script src="%s"></script>', get_src("static/js/register.js"));
    include(get_file('templates/open.php'));
    include(get_file('templates/pages/register.php'));
    include(get_file('templates/close.php'));
?>