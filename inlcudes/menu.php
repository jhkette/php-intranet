<?php

if(isset($_SESSION['admin'])) {
    $menu = [
    'logout.php'  => 'Logout',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',
    'add-user.php' => 'Add User',
    ];
}


else{
    $menu = [
    'admin-login.php'  => 'Admin Login',
    'login.php'  => 'Login',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',

    ];
}
?>
