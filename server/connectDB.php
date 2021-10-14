<?php
try {
    $db = new mysqli(
        $config['db_server'],
        $config['db_username'],
        $config['db_password'],
        $config['db_name'],
    );
} catch (Exception $e) {
    debug_console($e->getMessage());
}
?>