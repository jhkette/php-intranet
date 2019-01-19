<?php require_once('includes/init.php');
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
             <?php include('includes/header.php');?>
         </div>
         <div class="grey">
             <div class="main-container">
                 <?php include('includes/navigation.php'); ?>
                 <main class = "container">
                     <div class="row image">
                         <img src="images/computer-icon.svg" alt="computer">
                     </div>
                     <section class="col-1">

                         <h2>Home</h2>
                         <div class ="flex-container">
                             <div class="main-body">
                                 <?php include('includes/lorum.php');?>
                                 <?php include('includes/lorum.php');?>
                                 <?php include('includes/lorum.php');?>
                                 <div class="line">&nbsp;</div>
                                 <?php
                                 if ($loggedState == false) {
                                 ?>
                                 <a href='login.php' class="button1">Log in</a>
                                 <?php
                                 }
                                 ?>
                             </div>
                             <article class ="news-snippet">
                                 <h4>News </h4>
                                 <p>Aliquam sit amet aliquam magna. Vivamus ac sapien interdum, dapibus urna sed, pellentesque ante. Nulla ultrices finibus nisi,
                                 eget efficitur. <a href="news.php">Read more </a> </p>
                             </article>
                          </div>

                      </section>
                  </main>
             </div>
         </div>
         <div class ="footer-container">
              <?php include('includes/footer.php')?>
         </div>
     </body>
</html>

<!--Joseph Ketterer
Jkette01
Web Programming with PHP
Tobi Brodie -->
