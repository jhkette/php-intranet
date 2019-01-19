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
               <div class ="navcontainer">
                   <nav class="main-menu">
                       <?php
                       echo makeMenu($menu);
                       ?>
                   </nav>
               </div>
               <main class = "container">
                   <section class="col-1">
                       <h2>Admin login</h2>

                       <?php
                       /*Please see login.php for descripton of how this form validation works.*/
                       $admin = true; #admin is true so if valid session[admin] will be created by the validateLoginInputs function.
                       $errors = array();
                       $cleanData = array();

                       /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                       or redirects the user to index.php if no errors were detected */
                       if (isset($_POST['submit'])) {
                           $self = $_SERVER['PHP_SELF'];
                           $errors = reportAdminErrors($self);
                           $cleanData = validateLoginInputs($self, $errors, $admin);

                           switch (true) {
                                case (isset( $_SESSION['user'])) :
                                echo '<p class="message"> Please logout first </p>'; # checking they are not logged in as user
                                break;
                                case (count($cleanData) < 2) :
                                echo displayErrors($errors); # clean data is less than 2 so display errors
                                break;
                                case (count($cleanData) == 2): # clean data == 2 - no errors so redirect to index
                                header('Location: add-user.php');

                            }
                       }
                        /* This shows if user trys to view add user without logging in. Although it is not accessible via menu */
                       if (isset($_GET['message2'])) {
                           if(ctype_alpha(str_replace(' ', '', $_GET['message2']))) {#check that it's letters by removing white space with str replace
                               if( $_GET['message2']='Please log in as an admin'){
                                   echo '<p class="message">'.htmlentities($_GET['message2']). '</p>';
                               }
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
