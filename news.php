<?php
require_once('inlcudes/init.php');
$loggedState = false;
if (isset( $_SESSION['admin']) || (isset( $_SESSION['user']))) {

    $loggedState = true;
}
?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
     <head>
         <title>Welcome</title>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
         <link rel="stylesheet" href="./css/style.css">
         <style>
         @import url('https://fonts.googleapis.com/css?family=Roboto');
         </style>
     </head>
     <body>
         <div class ="header-container">
         <header class="col-md-6">
             <?php include 'inlcudes/header.php';?>
         </header>
         </div>
         <div class="main-container">

                <div class ="navcontainer">
                 <nav class="main-menu">
                     <?php
                     echo makeMenu($menu);
                     ?>
                </nav>
                <div class="status">
                     <?php
                     if ($loggedState == true) {
                         echo '<p>You are logged in as ' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user'] .PHP_EOL));
                     }
                     ?>
                </div>
            </div>

             <main class = "container">

                 <section class="col-1">
                      <h2>News</h2>
                     <p class="news">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at ipsum lorem. Lorem ipsum dolor sit amet,
                     consectetur adipiscing elit. Ut dapibus facilisis tortor, eu suscipit dolor cursus eu. Fusce vitae tortor est. Aenean
                     volutpat dui eu ex iaculis vestibulum. Maecenas semper imperdiet nibh. Donec at volutpat lectus, quis faucibus nulla.
                     Vivamus eros sapien, ultricies vitae dignissim sed, posuere eget erat. Donec bibendum nunc quis leo mattis, ne
                     c suscipit velit tincidunt. Donec a sapien id leo interdum mollis ut vel lectus. In non luctus orci. In tempor id
                     eros eget rutrum.</p>
                     <p class="news">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at ipsum lorem. Lorem ipsum dolor sit amet,
                     consectetur adipiscing elit. Ut dapibus facilisis tortor, eu suscipit dolor cursus eu. Fusce vitae tortor est. Aenean
                     volutpat dui eu ex iaculis vestibulum. Maecenas semper imperdiet nibh. Donec at volutpat lectus, quis faucibus nulla.
                     Vivamus eros sapien, ultricies vitae dignissim sed, posuere eget erat. Donec bibendum nunc quis leo mattis, ne
                     c suscipit velit tincidunt. Donec a sapien id leo interdum mollis ut vel lectus. In non luctus orci. In tempor id
                     eros eget rutrum.</p>
                  </section>

             </main>
         </div>
         </body>
</html>
