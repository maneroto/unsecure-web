<?php
require_once("../../functions.php");
require_once(get_file('config.php'));
require_once(get_file('server/services/Task.php'));

$method = $_SERVER["REQUEST_METHOD"];
$route = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]), 5));

switch($method) {
    case "GET":
        if (isset($_GET['title'])) {
            get_by_title();
        } else if (isset($_GET['id'])) {
            get();
        } else {
            get_all();
        }
        break;
    case "POST": 
        create(); break;
    case "PUT": 
        update(); break;
    case "DELETE": 
        delete(); break;
    default: return; break;
}

function create() {
    try {
        $data = false;
        $body = json_decode(file_get_contents('php://input'), true);

        $idUser = clear_input(1);
        $title = clear_input($body['title']);
        $urgency = clear_input($body['urgency']);
        $description = clear_input($body['description']);
        $dueDate = clear_input($body['due_date']);

        if (not_empty([$idUser, $title, $urgency, $description, $dueDate])) {
            $data = Task::create(
                $idUser,
                $title,
                $urgency,
                $description,
                $dueDate
            );
        } else {
            throw new Exception("You need to provide all the required information to create a task item");
        }

        http_response_code(201);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to create a task: ".$e->getMessage());
    }
}

function get() {
    try {
        $data = array();
        $res = null;

        $id = clear_input($_GET['id']);

        if (not_empty([$id])) {
            $res = Task::get($id);
        } else {
            throw new Exception("You need to provide the task id");
        }

        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to retrieve a task: ".$e->getMessage());
    }
}

function get_all() {
    try {
        $data = array();
        $res = Task::get_all();

        while($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to retrieve all tasks: ".$e->getMessage());
    }
}

function get_by_title() {
    try {
        $data = array();
        $res = null;

        $title = clear_input($_GET['title']);

        if (not_empty([$title])) {
            $res = Task::get_by_title($title);
        } else {
            throw new Exception("You need to provide the task title");
        }

        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        
        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to retrieve a task: ".$e->getMessage());
    }
}

function update() {
    try {
        $data = false;
        $body = json_decode(file_get_contents('php://input'), true);

        $id = clear_input($body['id']);
        $title = clear_input($body['title']);
        $urgency = clear_input($body['urgency']);
        $description = clear_input($body['description']);
        $dueDate = clear_input($body['due_date']);
    
        if (not_empty([$id, $title, $urgency, $description, $dueDate])) {
            $data = Task::update(
                $id,
                $title,
                $urgency,
                $description,
                $dueDate
            );
        }  else {
            throw new Exception("You need to provide the task id");
        }

        http_response_code(202);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to update a tasks: ".$e->getMessage());
    }
}

function delete() {
    try {
        $data = false;
        $body = json_decode(file_get_contents('php://input'), true);

        $id = clear_input($body['id']);

        if (not_empty([$id])) {
            $data = Task::delete($id);
        } else {
            throw new Exception("You need to provide the task id");
        }

        http_response_code(200);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode("Something failed while trying to delete a task: ".$e->getMessage());
    }
}
?>