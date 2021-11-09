<?php
require_once(get_file("server/connectDB.php"));

class User {

    public static function get_by_username($username) {
        $res = null;
        try {
            $db = connect();
            $stmt = null;
            $query = "SELECT id_user FROM User WHERE username = ?";

            $username = $db->real_escape_string($username);
            if($stmt = $db->prepare($query)) {
                $stmt->bind_param("s", $username);
                $stmt->execute();

                $res = $stmt->get_result();

                $stmt->close();
            }

            close($db);
        } catch(Exception $e) {
            debug_console($e->getMessage());
        }
        return $res;
    }
}

?>