<?php
echo "<header class='header'>".PHP_EOL.
         "<h1>DCS Intranet</h1>".PHP_EOL;

/*I am adding info about the user's logged status to the header,
This reduces code repetition.  The  logged status appears on the
top right of the web page */
$loggedState = false;
if (isset($_SESSION['admin']) || (isset($_SESSION['user']))) {
    $loggedState = true;
}

echo "</header>".PHP_EOL;
?>
