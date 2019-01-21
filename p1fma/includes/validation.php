<?php
 /*I am initially presenting the form to the user. When the user submits, I check if validateLoginInputs
 returns 2 indexes of cleanData (ie the form is valid). If there are no errors, the user is logged in and directed to intranet.php.
 A new session id is generated and a session username is stored. */

/*i'm initally declaring these variables, which are arguments in displayForm, as empty arrays  */
$cleanData=array();
$errors=array();

if(isset($_POST['submit'])) {#if the form is submitted
    if($admin == false ){
        include('includes/connection.php'); # check connection to file
    }

    if($admin == true || ($admin == false && $connection == true)){ # Only running code if admin= true or  admin = false and connection to file is true (this is checked in connection.php)
        $self = $_SERVER['PHP_SELF'];
        if($admin == false){
            $loggeddata = getData($handle);
        }
        else{
             $loggeddata = $adminUserPassword;
         }
         $errors = reportLoginErrors($self, $loggeddata, $admin);
         $cleanData = validateLoginInputs($self, $errors);

         switch (true) {
             case (isset( $_SESSION['admin']) || (isset( $_SESSION['user']))):
             echo '<p class="message"> Please logout first </p>'; # Prevent login as admin or user if already logged in
             break;
             case (count($cleanData) < 2 && ($admin == false)) :
             echo displayErrors($errors); # Clean data is less than 2 so display errors
             closeHandle($handle);
             closeDirectory($handleDir); #close handle, close directory, as we have initially opened file to look at the data
             break;
             case ((count($cleanData) < 2) && ($admin == true)) :
             echo displayErrors($errors);
             break;
             case ((count($cleanData) == 2) && ($admin == false)): # Clean data == 2 - no errors so redirect to intranet
             session_regenerate_id(true);
             $_SESSION['user'] = $cleanData[username]; #admin == false therfore setup session[user]
             closeHandle($handle);
             closeDirectory($handleDir); #close handle, close directory, as we have initially opened file to look at the data
             header('Location: intranet.php');
             break;
             case ((count($cleanData) == 2) && ($admin == true)): # clean data == 2 - no errors so redirect to index
             session_regenerate_id(true);
             $_SESSION['admin'] = $cleanData[username]; #admin == true therfore setup session[admin]
             header('Location: add-user.php'); # Clean data == 2 - no errors so redirect to add-user.php
         }
     }
 }

/* This echos a message to login using the GET superglobal if the user is redirected to a login page */
if(isset($_GET['message2'])) {
    if($_GET['message2'] == 'Please log in'){#check that it's the correct message as it is sent bu url
        echo '<p class ="message">'. htmlentities($_GET['message2']).'</p>';
    }
}
 /* This code runs to make the form display. The data and errors array
are used as arguments to preserve correct data and dispay an error message above form if
needed   */
echo displayForm($cleanData, $errors);
?>
