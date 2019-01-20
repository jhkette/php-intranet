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
                          /*I am initially presenting the form to the user. When the user submits, I check if the function
                          that returns clean data == 2 or not. If there are no errors the user is logged in and directed back to index page. I've set the variable
                          admin to 'false', this is passed as an argument to the cleanData function, which, also uses the errors array to check data is clean.
                          If everything is correct a new session id is generated and a session username (not session[admin]) is stored.     */
                          $admin = false;
                          include('includes/validation.php');
                          ?>
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
