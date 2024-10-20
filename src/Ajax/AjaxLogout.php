<?php

isset($_SERVER['HTTP_X_REQUESTED_WITH']) ?: exit(http_response_code(404));

require_once __DIR__ . '/../config.php';


if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);
}
session_destroy();
