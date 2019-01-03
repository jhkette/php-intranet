<?php
require_once('inlcudes/init.php');


if (isset( $_SESSION['admin'] )  || (isset( $_SESSION['user'] )   )) {

    // echo 'welcome' . $_SESSION['admin'];
}

 else {
    // Redirect them to the login page
    header("Location: login.php?message=please log in");
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
         <div class="main-container">
                <header class="col-md-6">

                </header>
                <nav class="col-md-6">
                    <?php
                    echo makeMenu($menu);
                    ?>
                    <?php
                    if (isset($_GET['message'])) {
                       echo $_GET['message'];
                   }
                   ?>
               </nav>

             <main class = "container">
                  <h1>Home</h1>
                 <section class="col-md-12">

                 </section>
                 <section class="col-md-12">
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at ipsum lorem. Lorem ipsum dolor sit amet,
                     consectetur adipiscing elit. Ut dapibus facilisis tortor, eu suscipit dolor cursus eu. Fusce vitae tortor est. Aenean
                     volutpat dui eu ex iaculis vestibulum. Maecenas semper imperdiet nibh. Donec at volutpat lectus, quis faucibus nulla.
                     Vivamus eros sapien, ultricies vitae dignissim sed, posuere eget erat. Donec bibendum nunc quis leo mattis, ne
                     c suscipit velit tincidunt. Donec a sapien id leo interdum mollis ut vel lectus. In non luctus orci. In tempor id
                     eros eget rutrum.</p>
                  </section>

             </main>
         </div>
         </body>
