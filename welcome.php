<?php
require_once('inlcudes/init.php');
require_once('inlcudes/functions.php');
include('inlcudes/menu.php');


if ( isset( $_SESSION['fullname'] ) ) {

    echo 'welcome' . $_SESSION['fullname'];
}
 else {
    // Redirect them to the login page
    header("Location: admin-login.php");
}
?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
     <head>
         <title>Sign Up to our Mailing List!</title>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
         <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <link rel="stylesheet" href="css/style.css">
 <style>
 @import url('https://fonts.googleapis.com/css?family=Roboto+Slab');
 </style>
     </head>
     <body>
        <div class="container">

        </div>
         <ul>
             <li><a href="P1results.php">List one</a></li>
             <li><a href="PfPresults.php">List one</a></li>
             <li><a href="DTresults.php">List one</a></li>
         </ul>
     </div>
    </body>
