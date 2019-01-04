<?php

if(isset($_SESSION['admin'])) {
    $menu = [
    'index.php'  => 'Home',
    'news.php'  => 'News',
    'results.php'  => 'Results',
    'add-user.php' => 'Add User',
    'logout.php' => 'Logout',
    ];
}

elseif (isset($_SESSION['user'])) {
    $menu = [
    'index.php'  => 'Home',
    'news.php'  => 'News',
    'results.php'  => 'Results',
    'logout.php'  => 'Logout',
    ];
}

else{
    $menu = [
    'index.php'  => 'Home',
    'news.php'  => 'News',
    'login.php'  => 'Intranet',
    'admin-login.php'  => 'Administration login',
    'results.php'  => 'Results',
    ];
}


$menu2 = [
    'results.php'  => 'Results',
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',
]

?>
