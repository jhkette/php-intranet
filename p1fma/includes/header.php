<?php
echo "<header class='header'>".PHP_EOL.
         "<h1>DCS Intranet</h1>".PHP_EOL;

/*I am checking for users logged status in the header*/
$loggedState = false;
if (isset($_SESSION['admin']) || (isset($_SESSION['user']))) {
    $loggedState = true;
}

echo "</header>".PHP_EOL;
?>
