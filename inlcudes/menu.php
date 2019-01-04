<?php

if(isset($_SESSION['admin'])) {
    $menu = [
    'index.php'  => 'Home',
    'news.php'  => 'News',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',
    'add-user.php' => 'Add User',
    'logout.php' => 'Logout',
    ];
}

elseif (isset($_SESSION['user'])) {
    $menu = [
    'index.php'  => 'Home',
    'news.php'  => 'News',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',
    'logout.php'  => 'Logout',
    ];
}

else{
    $menu = [
    'index.php'  => 'Home',
    'news.php'  => 'News',
    'admin-login.php'  => 'Administration login',
    'login.php'  => 'Intranet',

    ];
}
?>
