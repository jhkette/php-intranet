<?php
require_once('inlcudes/init.php');
$_SESSION = array(); #unset session - removes all stored data from array
if (ini_get("session.use_cookies")) { #if using cookies
    /* Delete session cookie */
    $yesterday = time() - (24 * 60 * 60);
    $params = session_get_cookie_params();
    setcookie(session_name(), '', $yesterday,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy(); # this destroys all stored session variables.

/* after logout the user is returned to the index page. GET superglobal used to echo 'logged out' message.
PHP will generate a new SID when it loads the index page*/
header('Location: index.php?message=You have logged out');

// Joseph Ketterer
// Jkette01
// Web Programming with PHP
// Tobi Brodie

?>
