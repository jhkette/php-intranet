<?php
require_once('inlcudes/init.php');


if (isset( $_SESSION['admin'])|| (isset( $_SESSION['user']))) {

     echo 'You are logged in as ' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user']));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Admin login</title>
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
             <nav class="col-md-12">
                 <?php
                echo makeMenu($menu);
                 ?>

                 <?php
                 if (isset( $_SESSION['admin'])|| (isset( $_SESSION['user']))) {
                     echo '<p>You are logged in as ' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user'] .'</p>'));
                 }

                ?>
              </nav>


          <main class = "container">


              <section class="col-md-12">

                  <h1>Login</h1>
                  <?php
                   $admin = false;
                   $self = htmlentities($_SERVER['PHP_SELF']);
                   $handleDir = openDirectory();
                   $handle = readDirectory($handleDir);
                   $loggeddata = getData($handle);
                   $errors = reportLoginErrors($self, $loggeddata);
                   $cleanData = validateLoginInputs($self, $errors, $admin);
                    /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                   or redirects the user to welcome.php if no errors were detected */
                   if (isset($_POST['submit'])) {
                      $formSubmmited = true;
                      /*i'm counting the size of the errors arry for validation
                      if errors > 0 the form is invalid */
                      if (count($errors) > 0) {
                          echo displayErrors($errors);
                          closeHandle($handle);
                          closeDirectory($handleDir);
                      }
                      if (count($errors) == 0) {
                          closeHandle($handle);
                          closeDirectory($handleDir);
                          header('Location: welcome.php'); #refreshing page to refresh menu on successful login
                      }
                  }

                   /* This code runs to make the form display. The data and errors array
                   are used as arguments to preserve correct data and dispay an error message above form if
                   needed   */
                   echo displayForm($cleanData, $errors);

                   ?>
                   <?php
                   if (isset($_GET['message'])) {
                      echo $_GET['message'];
                   }
                   ?>
          </section>

      </main>
  </div>
    </body>
</html>
