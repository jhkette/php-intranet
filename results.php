<?php require_once('inlcudes/init.php');

$loggedState = false;
if (isset($_SESSION['admin']) || (isset($_SESSION['user']))) {
    $loggedState = true;
}
 else {
    /* Redirect user to the login page. I am an adding an error message that will be shown on the login page using the GET superglobal */
    header("Location: login.php?message2=Please log in to view DCS results");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
    <title>Results</title>
</head>
    <body>
        <div class ="header-container">
            <?php include('inlcudes/header.php')?>
        </div>
        <div class="grey">
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
                             if(isset($_SESSION['admin'])){
                                 $admin = htmlentities($_SESSION['admin']);
                                 echo '<p>You are logged in as ' . $admin . '</p>'.PHP_EOL;
                             }
                             if(isset($_SESSION['user'])){
                                 $user = htmlentities($_SESSION['user']);
                                 echo '<p>You are logged in as ' . $user . '</p>'.PHP_EOL;
                             }
                         }
                         ?>
                     </div>
                 </div>
                 <main class = "container">
                     <section class="col-1">
                         <div class ="flex-container">
                             <nav class="side-menu">
                                 <?php
                                 echo makeMenu($menu2);
                                 ?>
                             </nav>
                             <div class="main-body">
                                 <h2>Results</h2>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at ipsum lorem. Lorem ipsum dolor sit amet,
                                 consectetur adipiscing elit. Ut dapibus facilisis tortor, eu suscipit dolor cursus eu. Fusce vitae tortor est. Aenean
                                 volutpat dui eu ex iaculis vestibulum. Maecenas semper imperdiet nibh. Donec at volutpat lectus, quis faucibus nulla.
                                 Vivamus eros sapien, ultricies vitae dignissim sed, posuere eget erat. Donec bibendum nunc quis leo mattis, ne
                                 c suscipit velit tincidunt. Donec a sapien id leo interdum mollis ut vel lectus. In non luctus orci. In tempor id
                                 eros eget rutrum.</p>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at ipsum lorem. Lorem ipsum dolor sit amet,
                                 consectetur adipiscing elit. Ut dapibus facilisis tortor, eu suscipit dolor cursus eu. Fusce vitae tortor est. Aenean
                                 volutpat dui eu ex iaculis vestibulum. Maecenas semper imperdiet nibh. Donec at volutpat lectus, quis faucibus nulla.
                                 Vivamus eros sapien, ultricies vitae dignissim sed, posuere eget erat. Donec bibendum nunc quis leo mattis, ne
                                 c suscipit velit tincidunt. Donec a sapien id leo interdum mollis ut vel lectus. In non luctus orci. In tempor id
                                 eros eget rutrum.</p>
                             </div>
                         </div>
                     </section>
                 </main>
             </div>
         </div>
         <div class ="footer-container">
              <?php include('inlcudes/footer.php')?>
         </div>
     </body>
</html>

<!--Joseph Ketterer
Jkette01
Web Programming with PHP
Tobi Brodie -->
