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
                          $cleanData=array();
                          $errors=array();

                          /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                          or redirects the user to welcome.php if no errors were detected */
                          if (isset($_POST['submit'])) {

                              /*i'm counting the size of the errors array for validation
                              if errors > 0 the form is invalid */
                              $handleDir = openDirectory();
                              if($handleDir == false){

                                echo '<p>The user data folder cannot be found</p>';
                              }
                              else{
                              $handle = readDirectory($handleDir);
                              if ($handle == false){
                                  echo '<p>The user data file cannot be processed</p>';
                                  closeDirectory($handleDir); # close directory
                              }
                              else{
                                  $self = $_SERVER['PHP_SELF'];
                                  $loggeddata = getData($handle);
                                  $errors = reportLoginErrors($self, $loggeddata);
                                  $cleanData = validateLoginInputs($self, $errors, $admin);
                                  switch (true) {
                                      case (isset( $_SESSION['admin'])) :
                                      echo '<p class="message"> Please logout first </p>'; # checking they are not logged in as an admin
                                      break;
                                      case (count($cleanData) < 2) :
                                      echo displayErrors($errors); # clean data is less than 2 so display errors
                                      closeHandle($handle); # close handle
                                      closeDirectory($handleDir); # close directory
                                      break;
                                      case (count($cleanData) == 2): # clean data == 2 - no errors so redirect to index
                                      header('Location: intranet.php');
                                      closeHandle($handle); # close handle
                                      closeDirectory($handleDir); # close directory
                                  }
                              }
                          }
                      }
                             /* This shows if user trys to view results without logging in */

                             if (isset($_GET['message2'])) {
                                 if(ctype_alpha(str_replace(' ', '', $_GET['message2']))){#check that it's letters by removing white space with str replace
                                     echo '<p class ="message">'. htmlentities($_GET['message2']).'</p>';
                                 }
                             }
                              /* This code runs to make the form display. The data and errors array
                          are used as arguments to preserve correct data and dispay an error message above form if
                          needed   */
                          echo displayForm($cleanData, $errors);
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
