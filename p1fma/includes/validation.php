<?php
 /*I am initially presenting the form to the user. When the user submits, I check if the function
 that returns clean data == 2 or not. If there are no errors the user is logged in and directed back to index page. I've set the variable
 admin to 'false', this is passed as an argument to the cleanData function, which, also uses the errors array to check data is clean.
 If everything is correct a new session id is generated and a session username (not session[admin]) is stored.     */


 $cleanData=array();
 $errors=array();
 /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
 or redirects the user to welcome.php if no errors were detected */
 if (isset($_POST['submit'])) {

     if($admin == false ){
         $connection = false;
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
                 $connection = true;
             }
         }
     }
     $self = $_SERVER['PHP_SELF'];
     if($admin == false){
         $loggeddata = getData($handle);
     }
     else{
          $loggeddata = $adminUserPassword;
      }
      $errors = reportLoginErrors($self, $loggeddata);
      $cleanData = validateLoginInputs($self, $errors, $admin);
      switch (true) {
          case (isset( $_SESSION['admin']) && ($admin== false)):
          echo '<p class="message"> Please logout first </p>'; # checking they are not logged in as an admin
          break;
          case (isset( $_SESSION['user']) && ($admin== true)):
          echo '<p class="message"> Please logout first </p>'; # checking they are not logged in as an admin
          break;
          case (count($cleanData) < 2 && ($admin == false)) :
          echo displayErrors($errors); # clean data is less than 2 so display errors
          closeHandle($handle); # close handle
          closeDirectory($handleDir); # close directory
          break;
          case ((count($cleanData) < 2) && ($admin == true)) :
          echo displayErrors($errors);
          break;
          case ((count($cleanData) == 2) && ($admin == false)): # clean data == 2 - no errors so redirect to index
          closeHandle($handle); # close handle
          closeDirectory($handleDir); # close directory
          header('Location: intranet.php');
          break;
          case ((count($cleanData) == 2) && ($admin == true)): # clean data == 2 - no errors so redirect to index
          header('Location: add-user.php');
          break;
      }

}

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
