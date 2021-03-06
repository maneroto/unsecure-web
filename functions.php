<?php
session_start();

function get_file($fileDir) {
    return __DIR__.'/'.$fileDir;
}
function get_src($srcDir) {
    global $config;
    return $config['base_dir'].'/'.$srcDir;
}
function debug_console($message) {
    if (is_array($message)) {
        $message = implode(",", $message);
    }
    echo sprintf("<script>console.log('%s')", $message);
}
function init_page() {
    global $pageInfo;
    $routesFile = file_get_contents(get_file("routes.json"));
    $json = json_decode($routesFile, true);
    $currDir = basename($_SERVER['REQUEST_URI']);
    if (isset($json[$currDir])) {
        $pageInfo['name'] = $json[$currDir]["name"];
        $pageInfo['title'] = $json[$currDir]["title"];
        $pageInfo['description'] = $json[$currDir]["description"];
        $pageInfo['keywords'] = $json[$currDir]["keywords"];
    }
}
function page_link($path) {
    global $config;
    echo $config['base_dir'].'/'.$path;
}
function check_auth() {
    global $config, $pageInfo;
    if (!isset($_SESSION['logged']) && $pageInfo['name'] != "login" && $pageInfo['name'] != 'register') {
        header("location: ".$config['base_dir'].'/login');
        exit;
    }
}

init_page();
check_auth();
?>