<?php
require_once('inlcudes/init.php');

$loggedState = false;
if (isset( $_SESSION['admin']) || (isset( $_SESSION['user']))) {

    $loggedState = true;
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
         <div class ="header-container">
         <header class="col-md-6">
             <?php include 'inlcudes/header.php';?>
         </header>
         </div>
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
                      echo '<p>You are logged in as ' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user'] .PHP_EOL));
                  }
                  if (isset($_GET['message'])) {
                      echo htmlentities($_GET['message']);
                  }
                  ?>
              </div>
          </div>

              <main class = "container">

            
             <h4> <?php
             if (isset($_GET['message'])) {
                 echo $_GET['message'];
             }
              ?></h4>

              <section class="col-1">
                  <h2>Admin login</h2>

                  <?php
                  $admin = true;
                  $self = htmlentities($_SERVER['PHP_SELF']);
                  $errors = reportAdminErrors($self);
                  $data = validateLoginInputs($self, $errors, $admin);
                   /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                  or redirects the user to welcome.php if no errors were detected */
                  if (isset($_POST['submit'])) {

                      if(count($errors) == 0){
                          header('Location: index.php'); #refreshing page to refresh menu on successful login
                      }
                      #declare $self varaible as $_POST for use in validation
                       if (count($errors) > 0) {
                           $formValid = false;
                           echo displayErrors($errors);
                       }
                   }
                   echo displayForm($data, $errors);
                   /* This code runs to make the form display. The data and errors array
                   are used as arguments to preserve correct data and dispay an error message above form if
                   needed   */
                   ?>
          </section>
      </main>
  </div>
    </body>
</html>
