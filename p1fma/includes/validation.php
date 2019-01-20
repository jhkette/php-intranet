<?php
 /*I am initially presenting the form to the user. When the user submits, I check if the function
 that returns clean data == 2 or not. If there are no errors the user is logged in and directed back to index page. I've set the variable
 admin to 'false', this is passed as an argument to the cleanData function, which, also uses the errors array to check data is clean.
 If everything is correct a new session id is generated and a session username is stored. */

$cleanData=array();
$errors=array();

if(isset($_POST['submit'])) {
    if($admin == false ){
        include('includes/connection.php');
    }

    if($admin == true || ($admin == false && $connection == true)){ #only running code if admin or not admin and connection to file is true
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
             case (isset( $_SESSION['admin']) && (isset( $_SESSION['user']))):
             echo '<p class="message"> Please logout first </p>'; # can't login as admin or user if already logged on
             break;
             case (count($cleanData) < 2 && ($admin == false)) :
             echo displayErrors($errors); # clean data is less than 2 so display errors
             closeHandle($handle);
             closeDirectory($handleDir);
             break;
             case ((count($cleanData) < 2) && ($admin == true)) :
             echo displayErrors($errors);
             break;
             case ((count($cleanData) == 2) && ($admin == false)): # clean data == 2 - no errors so redirect to index
             session_regenerate_id(true);
             $_SESSION['user'] = $cleanData[username];
             closeHandle($handle);
             closeDirectory($handleDir); #close handle close directory as we have opened file to look at data for staff login
             header('Location: intranet.php');
             break;
             case ((count($cleanData) == 2) && ($admin == true)): # clean data == 2 - no errors so redirect to index
             session_regenerate_id(true);
             $_SESSION['admin'] = $cleanData[username];
             header('Location: add-user.php');
         }
     }
 }


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
