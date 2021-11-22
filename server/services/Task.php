<?php
require_once("../../functions.php");
require_once(get_file("config.php"));
require_once(get_file("server/connectDB.php"));

class Task {

    public static function create($idUser, $title, $urgency, $description, $dueDate) {
        $res = false;

        try {
            $db = connect();
            $stmt = null;
            $query = "INSERT INTO uw_task (id_user, title, urgency, description, due_date) VALUES (?, ?, ?, ?, ?)";

            $idUser = $db->real_escape_string($idUser);
            $title = $db->real_escape_string($title);
            $urgency = $db->real_escape_string($urgency);
            $description = $db->real_escape_string($description);
            $dueDate = $db->real_escape_string($dueDate);

            $stmt = $db->prepare($query);
            $stmt->bind_param("isiss", $idUser, $title, $urgency, $description, $dueDate);
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

    public static function get($id) {
        $res = null;
        
        try {
            $db = connect();
            $stmt = null;
            $query = "SELECT * FROM uw_task WHERE id = ?";

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
            $query = "SELECT * FROM uw_task";

            $res = $db->query($query);

            close($db);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $res;
    }

    public static function get_by_title($title) {
        $res = null;

        try {
            $db = connect();
            $stmt = null;
            $query = "SELECT * FROM uw_task WHERE title LIKE CONCAT('%',?,'%')";

            $title = $db->real_escape_string($title);

            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $title);
            $stmt->execute();

            $res = $stmt->get_result();
            
            $stmt->close();
            close($db);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $res;
    }

    public static function update($id, $title, $urgency, $description, $dueDate) {
        $res = false;

        try {
            $db = connect();
            $stmt = null;
            $query = "UPDATE uw_task SET title=?, urgency=?, description=?, due_date=? WHERE id=?";

            $id = $db->real_escape_string($id);
            $title = $db->real_escape_string($title);
            $urgency = $db->real_escape_string($urgency);
            $description = $db->real_escape_string($description);
            $dueDate = $db->real_escape_string($dueDate);

            $stmt = $db->prepare($query);
            $stmt->bind_param("sissi", $title, $urgency, $description, $dueDate, $id);
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
            $query = "DELETE FROM uw_task WHERE id = ?";

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
}
?>