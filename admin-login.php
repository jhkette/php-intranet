<?php
require_once('inlcudes/init.php');

$loggedState = false;
if (isset( $_SESSION['admin']) || (isset( $_SESSION['user']))) {

    $loggedState = true;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
</head>
   <body>
       <div class ="header-container">
           <?php include 'inlcudes/header.php';?>
       </div>
       <div class="grey">
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
                   <section class="col-1">
                       <h2>Admin login</h2>
                       <?php
                       $admin = true;
                       $self = htmlentities($_SERVER['PHP_SELF']);
                       $errors = reportAdminErrors($self);
                       $data = validateLoginInputs($self, $errors, $admin);
                       /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                       or redirects the user to index.php if no errors were detected */
                       if (isset($_POST['submit'])) {
                           if(count($errors) == 0){
                               header('Location: index.php'); #refreshing page to refresh menu on successful login
                           }

                           if (count($errors) > 0) {
                               $formValid = false;
                               echo displayErrors($errors);
                           }
                       }
                       ?>
                       <p class ="message"><?php if (isset($_GET['message2'])) { echo htmlentities($_GET['message2']);}?></p>
                       <?php
                       /* This code runs to make the form display. The data and errors array
                       are used as arguments to preserve correct data and dispay an error message above form if
                       needed   */
                       echo displayForm($data, $errors);
                       ?>
                     </section>
                 </main>
             </div>
         </div>
         <div class ="footer-container">
              <?php include 'inlcudes/footer.php';?>
         </div>
    </body>
</html>
<!--Joseph Ketterer
Jkette01
Web Programming with PHP
Tobi Brodie -->
