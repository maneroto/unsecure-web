<?php
require_once("../../functions.php");
require_once(get_file('config.php'));
require_once(get_file('server/services/User.php'));

$method = $_SERVER["REQUEST_METHOD"];
$route = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]), 5));

switch($method) {
    case "GET":
        if (isset($_GET['email'])) {
            get_by_emai();
        } else if (isset($_GET['id'])) {
            get();
        } else {
            get_all();
        }
        break;
    case "POST": 
        create(); break;
    case "DELETE": 
        delete(); break;
    default: return; break;
}

function create() {
    try {
        $data = false;
        $body = json_decode(file_get_contents('php://input'), true);

        $email = clear_input($body['email']);
        $password = clear_input($body['password']);
        $password_confirm = clear_input($body['password_confirm']);

        if (not_empty([$email, $password, $password_confirm])) {
            if ($password != $password_confirm) {
                throw new Exception("Failed while trying to confirm password");
            } else {
                $data = User::create(
                    $email,
                    hash('sha256', $password)
                );
            }
        } else {
            throw new Exception("You need to provide all the required information to register a user");
        }

        http_response_code(201);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to register a user: ".$e->getMessage());
    }
}

function get() {
    try {
        $data = array();
        $res = null;

        $id = clear_input($_GET['id']);

        if (not_empty([$id])) {
            $res = User::get($id);
        } else {
            throw new Exception("You need to provide the user id");
        }

        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to retrieve a user: ".$e->getMessage());
    }
}

function get_all() {
    try {
        $data = array();
        $res = User::get_all();

        while($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to retrieve all users: ".$e->getMessage());
    }
}

function get_by_email() {
    try {
        $data = array();
        $res = null;

        $email = clear_input($_GET['email']);

        if (not_empty([$email])) {
            $res = User::get_by_email($email);
        } else {
            throw new Exception("You need to provide the user email");
        }

        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        
        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to retrieve a user: ".$e->getMessage());
    }
}

function delete() {
    try {
        $data = false;
        $body = json_decode(file_get_contents('php://input'), true);

        $id = clear_input($body['id']);

        if (not_empty([$id])) {
            $data = User::delete($id);
        } else {
            throw new Exception("You need to provide the user id");
        }

        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to delete a user: ".$e->getMessage());
    }
}
?>