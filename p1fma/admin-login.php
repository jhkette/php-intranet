<?php require_once('includes/init.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin login</title>
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
                       <h2>Admin login</h2>

                       <?php
                       /*Please see login.php for descripton of how this form validation works.*/
                       $admin = true; #admin is true so if valid session[admin] will be created by the validateLoginInputs function.
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
