<?php require_once('inlcudes/init.php');
$loggedState = false;
if (isset($_SESSION['admin']) || (isset($_SESSION['user']))) {

    $loggedState = true;
}
else{
    $loggedState = false;
}

/* If the user is logged in as admin or user loggedstate is true...
their username gets echoed to the right of the navigtaion (below)  */
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab');
        </style>
    </head>
    <body>
         <div class ="header-container">
             <?php include('inlcudes/header.php');?>
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
                             if(isset( $_SESSION['admin'])){
                                 $admin = htmlentities($_SESSION['admin']);
                                 echo '<p>You are logged in as ' . $admin . '</p>'.PHP_EOL;
                             }
                             if(isset( $_SESSION['user'])){
                                 $user = htmlentities($_SESSION['user']);
                                 echo '<p>You are logged in as ' . $user . '</p>'.PHP_EOL;
                             }
                         }
                         ?>
                         </div>
                         <!--i'm only showing this div - it shows a logged out message if the user has logged out
                         it's in a seperate color to the login message  -->
                         <?php if ($loggedState == false): ?>
                             <div class="logout">
                                 <?php
                                 if (isset($_GET['message'])) {
                                     if(ctype_alpha(str_replace(' ', '', $_GET['message']))){ #check it is letters
                                         echo '<p>'. htmlentities($_GET['message']). '</p>';
                                     }
                                 }
                                 ?>
                             </div>
                         <?php endif; ?>
                     </div>
                 <main class = "container">
                     <div class="row image">
                         <img src="images/computer-icon.svg" alt="computer">
                     </div>
                     <section class="col-1">
                         <div class="line">&nbsp</div>
                         <h2>Home</h2>
                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at ipsum lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dapibus facilisis tortor, eu suscipit dolor cursus eu. Fusce vitae tortor est. Aenean volutpat dui eu ex iaculis vestibulum. Maecenas semper imperdiet nibh. Donec at volutpat lectus, quis faucibus nulla. Vivamus eros sapien, ultricies vitae dignissim sed, posuere eget erat. Donec bibendum nunc quis leo mattis, nec suscipit velit tincidunt. Donec a sapien id leo interdum mollis ut vel lectus. In non luctus orci. In tempor id eros eget rutrum.</p>
                         <p>Nam nisl eros, pharetra nec vehicula efficitur, elementum in tortor. Pellentesque non convallis lectus. Sed nisi lorem, tristique sit amet
                         est ut, viverra varius diam. Morbi sodales lobortis blandit. Phasellus et rhoncus neque. Morbi feugiat, ipsum non posuere</p>
                         <p>Aliquam sit amet aliquam magna. Vivamus ac sapien interdum, dapibus urna sed, pellentesque ante. Nulla ultrices finibus nisi,
                         eget efficitur felis sodales non. Quisque eu dui ut felis euismod venenatis. Praesent at ante vitae nunc pharetra fringilla. Etiam
                         lacus justo, congue et justo vel, elementum malesuada odio. Quisque bibendum, augue nec placerat vestibulum, arcu purus pretium ligula,
                         sed molestie ligula eros vitae nibh. </p>
                         <?php
                         if ($loggedState == false) {
                         ?>
                         <a href='login.php'><button class="button1">Log in</button></a>
                         <?php
                         }
                         ?>
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
