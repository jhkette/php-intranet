<?php require_once('includes/init.php');
# I'm only deleting session cookie if logged in
if(isset( $_SESSION['admin']) || isset(( $_SESSION['user']))) {
    $_SESSION = array(); #unset session - removes all stored data from array
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
    /* after logout the user is returned to the index page. GET superglobal used to echo 'logged out' message.*/
    header('Location: index.php?message=You have logged out');
}
else{
    header('Location: index.php');
}
// Joseph Ketterer
// Jkette01
// Web Programming with PHP
// Tobi Brodie

?>
