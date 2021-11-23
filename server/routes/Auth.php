<?php
require_once("../../functions.php");
require_once(get_file('config.php'));
require_once(get_file('server/services/User.php'));

$method = $_SERVER["REQUEST_METHOD"];
$route = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]), 5));

if($method == "POST") {
    login();
}

function login() {
    try {
        $data = false;
        $body = json_decode(file_get_contents('php://input'), true);

        $email = clear_input($body['email']);
        $password = clear_input($body['password']);

        if (not_empty([$email, $password])) {
            $user_fetch = User::get_by_email($email);
            $user = $user_fetch->fetch_assoc();

            if (strcmp(hash('sha256', $password), $user['password']) != 0) {
                throw new Exception("Login failed");
            } else {
                $_SESSION['id'] = $user['id'];
                $data = true;
            }
        } else {
            throw new Exception("You need to provide all the required information to login");
        }

        http_response_code(201);
        echo json_encode($data);
    } catch(Exception $e) {
        http_response_code(401);
        echo json_encode("Something failed while trying to login: ".$e->getMessage());
    }
}
?>