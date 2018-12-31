<?php
require_once('inlcudes/init.php');

include('inlcudes/menu.php');


if ( !isset( $_SESSION['admin'] ) ) {
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
            <secion class="">
            <h2><?php
            echo 'welcome' . $_SESSION['admin']; ?></h2>
        </section>
            <section class="col-md-12">
                <?php
                echo makeMenu($menu);
                ?>
            </section>

        </div>

    </body>
