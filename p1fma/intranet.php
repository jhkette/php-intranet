<?php require_once('includes/init.php');

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab');
        </style>
        <title>Results</title>
    </head>
    <body>
        <div class ="header-container">
            <?php include('includes/header.php')?>
        </div>
        <div class="grey">
            <div class="main-container">
                <div class ="navcontainer">
                    <nav class="main-menu">
                     <?php
                     echo makeMenu($menu);
                     ?>
                     </nav>
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
                                 <h2>Intranet Home</h2>
                                 <?php include('includes/lorum.php');?>
                                 <?php include('includes/lorum.php');?>
                                 <div class="line"> </div>
                             </div>
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
