<?php
function connect() {
    global $config;
    $db = null;
    try {
        $db = new mysqli(
            $config['db_server'],
            $config['db_username'],
            $config['db_password'],
            $config['db_name'],
        );
    } catch(Exception $e) {
        debug_console($e->getMessage());
    }
    return $db;
}

function close($db) {
    try {
        mysqli_close($db);
    } catch(Exception $e) {
        debug_console($e->getMessage());
    }
}

function db_except($msg, $db) {
    throw Exception(
        $msg." ".$db->errno.": ".$db->error
    );
}
?>