<?php
echo "<header class='header'>".PHP_EOL.
         "<h1>DCS Intranet</h1>".PHP_EOL;

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
        echo '<p>You are logged in as ' . $admin . '</p>'.PHP_EOL;
    }
    if(isset( $_SESSION['user'])){
        $user = htmlentities($_SESSION['user']);
        echo '<p>You are logged in as ' . $user . '</p>'.PHP_EOL;
    }
}

echo '</div>'.PHP_EOL;

if ($loggedState == false){
    echo '<div class="logout">';
    if (isset($_GET['message'])) {
        if(ctype_alpha(str_replace(' ', '', $_GET['message']))){ #check it is letters
            echo '<p>'. htmlentities($_GET['message']). '</p>'.PHP_EOL;
        }
    }
    echo '</div>'.PHP_EOL;
}

echo "</header>".PHP_EOL;
?>
