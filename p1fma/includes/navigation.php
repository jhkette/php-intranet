<?php
/* Include which presnts navigation and loggedin status */
echo '<div class ="navcontainer">
         <nav class="main-menu">'.PHP_EOL;
            echo  makeMenu($menu); # displays main menu using makeMenu function
echo     '</nav>'.PHP_EOL;
echo '<div class="status">'.PHP_EOL;

/*This displays the user logged in status if they are logged in */
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
    if (isset($_GET['message'])) { # this communicates logged out message to user
        if($_GET['message'] = 'You have logged out'){ #needs to be the correct message
            echo '<p>'. htmlentities($_GET['message']). '</p>'.PHP_EOL;
        }
    }
    echo '</div>'.PHP_EOL;
}

echo '</div>';

?>
