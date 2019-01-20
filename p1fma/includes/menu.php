<?php

/* The menu is modified based on login/logout status and also is modified
if you are logged in as a user or admin. The menu arrays get turned into a HTML menu
by the makeMenu function on the functions page */

if(isset($_SESSION['admin'])) {
    $menu = [
    'index.php'  => 'Home',
    'intranet.php'  => 'Intranet',
    'add-user.php' => 'Add User',
    'logout.php' => 'Logout',

    ];
}

elseif (isset($_SESSION['user'])) {
    $menu = [
    'index.php'  => 'Home',
    'intranet.php'  => 'Intranet',
    'logout.php'  => 'Logout',

    ];
}

else{
    $menu = [
    'index.php'  => 'Home',
    'login.php'  => 'Staff Login',
    'admin-login.php'  => 'Administration login',
    ];
}

/*Side menus */

$menu1 = [
    'intranet.php' => 'DCS intranet',
];


$menu2 = [
    'DTresults.php' => 'DT results',
    'P1results.php' => 'P1 results',
    'PfPresults.php' => 'PfP results',
];

$menu3 = [
    'News.php' => 'News',
    'Events.php' => 'Events',
];

?>
