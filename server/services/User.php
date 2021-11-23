<?php
require_once("../../functions.php");
require_once(get_file("server/connectDB.php"));

class User {

    public static function create($email, $password) {
        $res = false;

        try {
            $db = connect();
            $res = $db->query("INSERT INTO uw_user (email, password) VALUES (\"".$email."\", \"".$password."\")");
            // $stmt = null;
            // $query = "INSERT INTO uw_user (email, password) VALUES (?, ?)";

            // $email = $db->real_escape_string($email);
            // $password = $db->real_escape_string($password);

            // $stmt = $db->prepare($query);
            // $stmt->bind_param("ss", $email, $password);
            // $stmt->execute();

            // if ($stmt->affected_rows) {
            //     $res = true;
            // }

            // $stmt->close();
            close($db);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $res;
    }
    
    public static function get($id) {
        $res = null;
        
        try {
            $db = connect();
            $stmt = null;
            $query = "SELECT * FROM uw_user WHERE id = ?";

            $id = $db->real_escape_string($id);

            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $res = $stmt->get_result();

            $stmt->close();
            close($db);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
        return $res;
    }
    
    public static function get_all() {
        $res = null;

        try {
            $db = connect();
            $query = "SELECT * FROM uw_user";

            $res = $db->query($query);

            close($db);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $res;
    }

    public static function get_by_email($email) {
        $res = null;
        
        try {
            $db = connect();
            $stmt = null;
            $query = "SELECT * FROM uw_user WHERE email = ?";

            $email = $db->real_escape_string($email);

            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $res = $stmt->get_result();

            $stmt->close();
            close($db);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
        return $res;
    }

    public static function update($id, $email, $password) {
        $res = false;

        try {
            $db = connect();
            $stmt = null;
            $query = "UPDATE uw_user SET email=?, password=? WHERE id=?";

            $id = $db->real_escape_string($id);
            $email = $db->real_escape_string($email);
            $password = $db->real_escape_string($password);

            $stmt = $db->prepare($query);
            $stmt->bind_param("ssi", $email, $password, $id);
            $stmt->execute();

            if ($stmt->affected_rows) {
                $res = true;
            }

            $stmt->close();
            close($db);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $res;
    }

    public static function delete($id) {
        $res = false;

        try {
            $db = connect();
            $stmt = null;
            $query = "DELETE FROM uw_user WHERE id = ?";

            $id = $db->real_escape_string($id);

            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            if ($stmt->affected_rows) {
                $res = true;
            }

            $stmt->close();
            close($db);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $res;
    }

    public static function delete_by_email($email) {
        $res = false;

        try {
            $db = connect();
            $stmt = null;
            $query = "DELETE FROM uw_user WHERE email = ?";

            $email = $db->real_escape_string($email);

            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            if ($stmt->affected_rows) {
                $res = true;
            }

            $stmt->close();
            close($db);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $res;
    }
}

?>