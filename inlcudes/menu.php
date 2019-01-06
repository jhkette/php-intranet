<?php require_once('inlcudes/init.php');

/* The menu is modified based on login/logout status and also is modified
if you are logged in as a user or admin. The menu arrays get turned into a HTML menu
by the makeMenu function on the functions page */

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
