<?php
$config['http_protocol'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')? "https://" : "http://";
$config['host'] = 'localhost';
$config['root'] = "/unsecure-web";
$config['base_dir'] = $config['http_protocol'].$config['host'].$config['root'];
$config['db_server'] = 'localhost:3306';
$config['db_name'] = "unsecure_db";
$config['db_username'] = "db_admin";
$config["db_password"] = "the password";

$pageInfo['name'] = "";
$pageInfo['title'] = "";
$pageInfo["description"] = "";
$pageInfo["keywords"] = "";
$pageInfo["css"] = "";
$pageInfo["js"] = "";
?>