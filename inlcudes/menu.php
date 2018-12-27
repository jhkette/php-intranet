<?php

if(isset($_SESSION['fullname'])) {
    $menu = [
    'logout.php'  => 'Logout',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',
    ];


}
else{
    $menu = [

    'admin-login.php'  => 'Admin Login',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',

    ];
}
?>
