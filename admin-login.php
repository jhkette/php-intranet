<?php
require_once('inlcudes/functions.php');
?>
<?php

$username = 'admin';
$password = 'DCSadmin01';

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
     <div class ="container">
         <header class="col-md-6">
         <h1>Admin login</h1>
         </header>
         <header class="col-md-6">

     </header>
 </div>

        <main class = "container">
            <section class="col-md-12">

         <?php


        $formSubmmited = false;
        $self = htmlentities($_SERVER['PHP_SELF']);
        $displayForm = true;
        $formValid = true;
        if (isset($_POST['submit'])) {
               /* The form has now been submitted */

              $formSubmmited = true;

               #declare $self varaible as $_POST for use in validation
               if ((errordetection($self) == true) && ($formSubmmited == true)) {
                    $formValid = false;
                    displayErrors(validateErrors($self));

                }
                if(($formValid == true) && ($formSubmmited == true)){
                     $displayForm = false;
                    displayResults(validateInputs($self));
                    header('location: welcome.php');
                }


             }
             $data = validateInputs($self);
             $errors = [];
             if($formSubmmited == true){
             $errors = validateErrors($self);
         }

             showFormErrors($displayForm, $data, $errors);

             ?>


     </section>
     </main>

     </body>
 </html>
