<?php require_once('includes/init.php');?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Intranet login</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab');
        </style>
    </head>
    <body>
        <div class ="header-container">
             <?php include('includes/header.php')?>
         </div>
         <div class="grey">
             <div class="main-container">
                 <?php include('includes/navigation.php'); ?>
                 <main class = "container">

                     <section class="col-1">
                         <h2>Login</h2>
                         <?php
                         $admin = false;
                         include('includes/validation.php'); #see validation.php for comments on validation process
                         ?>
                         <div class="add-info small">
                             <p>If you do not have a username, or you wish to regsiter a new staff member, contact an administrator</p>
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
