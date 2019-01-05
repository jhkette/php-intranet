<?php
require_once('inlcudes/init.php');
if (ini_get("session.use_cookies")) {
    /* Delete session cookie */
    $yesterday = time() - (24 * 60 * 60);
    $params = session_get_cookie_params();
    setcookie(session_name(), '', $yesterday,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy(); # this destroys all stored session variables.

header('Location: index.php?message=You have logged out'); # after logout the user is returned to the index page. GET superglobal used to echo message
?>
