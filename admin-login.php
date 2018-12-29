<?php
require_once('inlcudes/init.php');

include('inlcudes/menu.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Admin login</title>
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
                  print makeMenu($menu);
                  ?>
              </section>
              <section class="col-md-12">


                  <?php

                  $self = htmlentities($_SERVER['PHP_SELF']);
                  $data = validateInputs($self);
                  $errors = validateErrors($self);
                  $formSubmmited = false;

                  /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                  or redirects the user to welcome.php if no errors were detected */
                  if (isset($_POST['submit'])) {
                       $formSubmmited = true;
                       #declare $self varaible as $_POST for use in validation
                       if ((sizeof($errors) > 0) && ($formSubmmited == true)) {
                           $formValid = false;
                           displayErrors($errors);
                       }
                       if((sizeof($errors) == 0) && ($formSubmmited == true)){
                           header('Location: welcome.php'); #refreshing page to refresh menu on successful login



                           displayResults($data);

                       }
                   }

                   /* This code runs to make the form display. The data and errors array
                   are used as arguments to preserve correct data and dispay an error message above form if
                   needed   */
                   displayForm($data, $errors);
                   ?>
          </section>
      </main>
    </body>
</html>
