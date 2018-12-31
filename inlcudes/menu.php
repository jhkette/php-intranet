<?php

if(isset($_SESSION['admin'])) {
    $menu = [
    'index.php'  => 'Home',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',
    'add-user.php' => 'Add User',
    'logout.php'  => 'Logout',
    ];
}


else{
    $menu = [
    'index.php'  => 'Home',
    'admin-login.php'  => 'Admin Login',
    'login.php'  => 'Login',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',

    ];
}
?>
