<?php
echo "<header class='header'>".PHP_EOL.
         "<h1>DCS Intranet</h1>".PHP_EOL;

/*I am adding info about the user's logged status to the header,
This reduces code repetition and also works visually */
$loggedState = false;
if (isset($_SESSION['admin']) || (isset($_SESSION['user']))) {
    $loggedState = true;
}
else{
    $loggedState = false;
}

echo '<div class="status">';

if ($loggedState == true) {
    if(isset( $_SESSION['admin'])){
        $admin = htmlentities($_SESSION['admin']);
        echo '<p>You are logged in as ' . $admin . '</p>'.PHP_EOL; #if set echo out admin
    }
    if(isset( $_SESSION['user'])){
        $user = htmlentities($_SESSION['user']);
        echo '<p>You are logged in as ' . $user . '</p>'.PHP_EOL; #if set echo out user name
    }
}

echo '</div>'.PHP_EOL;

if ($loggedState == false){ # div is only presented if loggestate is false
    echo '<div class="logout">';
    if (isset($_GET['message'])) { # this communicates logged out message to use
        if(ctype_alpha(str_replace(' ', '', $_GET['message']))){ #check it is letters
            echo '<p>'. htmlentities($_GET['message']). '</p>'.PHP_EOL;
        }
    }
    echo '</div>'.PHP_EOL;
}

echo "</header>".PHP_EOL;
?>
