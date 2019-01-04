<?php
require_once('inlcudes/init.php');

$adminState = false;
if (isset( $_SESSION['admin'])) {
    $adminState = false;
}
else{
   // Redirect them to the login page
   header("Location: admin-login.php?message=Only an admin can add a user. Please log in as an admin");

}

?>



    <title>Admin login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="./css/style.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
</head>


$loggedState = true;
}
?>
