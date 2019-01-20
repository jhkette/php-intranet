<?php
echo '<div class ="navcontainer">
         <nav class="main-menu">'.PHP_EOL;
            echo  makeMenu($menu);
echo '</nav>'.PHP_EOL;
echo '<div class="status">'.PHP_EOL;


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
            if($_GET['message'] = 'You have logged out'){ #needs to be the correct message
                echo '<p>'. htmlentities($_GET['message']). '</p>'.PHP_EOL;
            }
        }
    }
    echo '</div>'.PHP_EOL;
}

echo '</div>';

?>
