<?php
require_once('inlcudes/init.php');

/* ------------------------ FORM PRESENTATION AND FEEDBACK FUNCTIONS -------------------------------*/
/*This displays form for the admin login and normal login. Error feedback is presnted above and prompts are presnted by the form fields if there
are errors  */
function displayForm( $cleanData , $errors){
    $passwordErrors='';
    $userErrors = '';
    if(isset($cleanData['username'])) { #check if clean data or error data isset
        $userName = htmlentities($cleanData['username']);
    }
    else{
        $userName = '';
    }
    if (isset($errors['username']))
      {$userErrors =  '<p> Please enter a valid username </p>';}
     else {
         $userErrors = '';
        }
    if (!isset($errors['username'])){
        if (isset($errors['password'])) {
            $passwordErrors =  '<p> This is not the correct password </p>';}
         else {
             $passwordErrors = '';
            }
        }
    $self = htmlentities($_SERVER['PHP_SELF']);


    $output='
    <form action="'.$self.'"  method="post">
        <fieldset>
            <legend>Please log in</legend>
            <div>
                <label for="Username">Username</label>'.
                 $userErrors .
                '<input type="text"  value= " '.$userName.'" name="username" id="name" />
            </div>
            <div>
                 <label for="Password">Password</label>'
                .$passwordErrors.
                 '<input type="password"  value= ""  name="password" id="password"/>
             </div>
              <div>
                  <input type="submit" name="submit" value="Submit" />
              </div>
          </fieldset>
      </form>';
      return $output;
  }

/*Function that loops through cleanData array and presents it. This is used when a user is added. */
 function displayResults($cleanData){
      $output='';
      foreach ($cleanData as $key => $value) {
          $output.='<li class = "list-group-item">
                   <strong>'. htmlentities($key). ': </strong> '.htmlentities($value).'
                   </li>';
           }
      return $output;
  }

/* Function that displays errors, used by all three forms on the intranet site. Loops through error arrays
passed as arguments  */
  function displayErrors($errors, $duplicates=array(), $passwordError=array()){ /* i'm creating default arguments for the last 2 parameters. The login
      and admin login doesn't use them. However, the adduser function provides these arrays when it calls this function*/
      $output='';
      foreach ($errors as $key => $value) {
          $output.='<li class = "list-group-error">
                   <strong>'. htmlentities(ucfirst($key)). ': </strong> '.htmlentities($value).'
                   </li>';
           }
       foreach ($duplicates as $key => $value) {
           $output.='<li class = "list-group-error">
                     <strong>'. htmlentities(ucfirst($key)). ': </strong> '.htmlentities($value).'
                     </li>';
                }
        foreach ($passwordError as $key => $value) {
            $output.='<li class = "list-group-error">
                      <strong>'. htmlentities(ucfirst($key)). ': </strong> '.htmlentities($value).'
                      </li>';
                     }
        return $output;
  }

/*-------------------------- FUNCTIONS TO GET DATA FROM FILES -------------------------- */
/* function that opens directory that contains data file. While not possible in this excercise, ideally this
folder would not be stored on the root directory of the website ie. it  would be in a directory that cannot be accessed online */

 function openDirectory(){
      $handleDir = opendir('./data');
      if ($handleDir === false){
          echo '<p> System error: Unable to open directory</p>';
      }
      else {
          return $handleDir;
      }
 }

 function readDirectory($handleDir){
     while(false !== ($file = readdir($handleDir))){
         if ($file != "." && $file != "..") { # don't add dots which represent directories to array
             $fileDir1 = array();
             array_push($fileDir1, $file); # push into array
             foreach ($fileDir1 as $key => $value) { # readdir creates an array of files so i'm using a foreach loop to get the file value.
                 $handle = fopen('data/' . htmlentities(trim($value)), 'a+');
                 if ($handle === false) { #error message if you can't open file.
                      echo '<p>System error. Cannot open file</p>'. PHP_EOL;
                  }
                  else{
                      return $handle;
                  }
              }
          }
     }
}


 /* Function that reads data from the file in the directory and add it to an array */
 function getData($handle){
      rewind($handle); # pointer needs to be at start of file
      $dataArray = array(); # create data array
      while (!feof($handle)) { #while not at the end of file
          $line = fgets($handle);
          $line = trim($line);
          if  (!empty($line))  { # check it is not an empty line
              array_push($dataArray,  $line);
          }
      }
      return $dataArray; # an array of user data (all on one line, to be seperated later)
  }


/*------------------------ FUNCTIONS TO VALIDATE LOGIN FORMS ---------------------------- */


 /* Function to process login errors, this function takes data from the text file,
 explodes at the comma and then checks to see if user input matches  a recorded entry*/
function reportLoginErrors($self, $loggedData){
    $errors  = array(); # create errors array
    $correctData = false;  # set variables to false
    $correctPassword = false;
    if (isset($_POST['submit'])) { # block of code only runs when user has submitted form
        $username = trim($_POST['username']); # assign variables for user input
        $password = trim($_POST['password']);
        foreach ($loggedData as $key => $value) { # loop through stored user data on text file
            $userPassword = explode(',', $value); # explode at comma
            $userPassword[0] = trim($userPassword[0]); #trim data
            $userPassword[1] = trim($userPassword[1]);
            if ($userPassword[0] == $username){ # check if username matches
                 $correctData = true;
            }
             /* check if both the username and the relevant password match, password can't be correct independant of a valid username */
            if(($userPassword[0] ==  $username) && ($userPassword[1] == $password)) {
                   $correctPassword = true;
               }
        }
        if($correctData == false){ # if values are still false user input was not valid and an error is reported
            $errors['username'] = 'This username does not exist';
        }
        /*I'm only checking if the password is valid if the username doesn't contain any errors.
        It doesn't make sense for a password to be correct independant of the username it is attached to */
        if(($correctPassword == false) && ($correctData == true)){
            $errors['password'] = 'This is not the correct password';
        }
    }
    return $errors;
}

/*Function to valdate admin login. The username and password is hardcoded into the function.  */
function reportAdminErrors($self){
    $adminusername = 'admin'; #correct username
    $adminpassword = 'DCSadmin01'; #correct password
    $errors = array();
    if (isset($_POST['submit'])) {  # block of code only runs when user has submitted form
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ($username !== $adminusername) {
            $errors['username'] = 'This is not the correct username for Admin';
        }

        if ($username == $adminusername){
            if ($password !== $adminpassword) {  # i'm only adding an error to the password field if the username is valid
                $errors['password'] = 'This is not the correct password for Admin';
            }
        }
    }
    return $errors;
}

/*This function is used by the admin and oridinary login pages. It takes in the error array from the prior function
reportLoginErrors or reportAdminErrors. It checks if an error was assigned to a form field. If not it saves data as clean. If both password and
username are correct, the username is stored to the $_SESSION array. I regenerate the session id beforehand; as both items are correct and the form
has been submitted, the user will be logging in  */
function validateLoginInputs($self, $errors, $admin){
    $cleanData = array();
    /* I'm not saving and representing the password login data. Passwords are not like other form data. They can only be correct in relation to
    a correct username. It would not be appropriate (or secure) to save correct passwords independant of usernames. */
    if (isset($_POST['submit'])) { # only runs after form submission
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if(!isset($errors['username'])) {
            $cleanData['username'] = $username;
        }
        if(!isset($errors['username']) && (!isset($errors['password']))) {
          session_regenerate_id(true); #i'm regenerating the session id as both fields are correct so the user is logged in
          if($admin == true){ # if the argument 'admin' is true create $_SESSION['admin'] - for access to 'add user'
              $_SESSION['admin'] = $username;
          }
          else{
              $_SESSION['user'] = $username;
           }
       }
   }
   return $cleanData;
}

/* ------------------------ FUNCTIONS TO VALIDATE ADD USER FORM  -------------------------------*/

/*This function checks and validates the input from the add user form. If it's incorrect data is added to the $errors array */
function addUserErrors($self){
    $errors = array();
    if (isset($_POST['submit'])) { # code only runs when form is submitted

        $firstname = trim($_POST['firstname']); # The firstname needs to be letters and between 2 and 19 charecters long
        if (!ctype_alpha($firstname) || (strlen($firstname) > 20) || (strlen($firstname) <= 2))  {
            $errors['firstname'] = 'Names can only contain letters. They need to be at least two charecters.';
        }
        $surname = trim($_POST['surname']); # The surname needs to be letters and between 2 and 19 charecters long
        if (!ctype_alpha($surname) || (strlen($surname) > 20) || (strlen($surname) <= 2)) {
            $errors['surname'] = 'Surnames can only contain letters. They need to be at least two charecters.';
        }
        $email = trim($_POST['email']); #i'm using FILTER_VALIDATE_EMAIL to check if the email is valid. If it returns false it is invalid
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        $title = trim($_POST['title']); # Errors are not really possible on the select 'title' box, a value is always selected
        if (($title !== 'Mr') && ($title !== 'Mrs') && ($title !== 'Ms') && ($title !== 'Miss')) { # still check the correct value is sent to form for security
            $errors['title'] = 'This is not the correct title';
        }
        $username = trim($_POST['username']); # The username needs to be letters/numbers and between 2 and 19 charecters long
        if (!ctype_alnum($username) || (strlen($username) > 20) || (strlen($username) < 5))  {
            $errors['username'] = 'Usernames can only be numbers or letters. It needs to be five or more chrecters long.';
        }
        $password = trim($_POST['password']); # The password needs to be letters/numbers and between 2 and 19 charecters long
        if (!ctype_alnum($password) || (strlen($password) > 20) || (strlen($password) < 5)) {
            $errors['password'] = 'This is not a valid password. It should contain only letters and numbers. It needs to be five or more
            charecters long.';
        }
    }
    return $errors;
}

/*This function check that the user inputs haven't been registered before, it takes data from the text file
and compares it against user input. I'm only checking the username and email */
function checkDuplicates($self, $loggedData){
    $duplicates = array();
    $userMatch = false; # usermatch and emailmatch initially set to false
    $emailMatch = false;
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        foreach ($loggedData as $key => $value) { #loop through text file data
            $loggedData = explode(',', $value); # explode at comma
            $loggedData[0] =  trim($loggedData[0]); #trim data
            $loggedData[5] =  trim($loggedData[5]);
            if ($loggedData[0] == $username){ # username is at index [0] of the text file data
                $userMatch = true;
            }
            if($loggedData[5] == $email){ # email value will be at index [5]
                $emailMatch = true; # change emailmatch to true if match found
            }
        }
        if($emailMatch== true){
        $duplicates['email'] = 'This email is already in use'; #adding data to a duplicates array if match is true
        }
        if($userMatch== true){
            $duplicates['username'] = 'This username is already in use';
        }
    }
    return $duplicates; # the duplicates array gets represnted to the user on the add user page
}

/*Function that checks the conform password and password values are the same  */
function confirmPassword($self){
    $passwordError = array();
    if (isset($_POST['submit'])) {
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm-password']);
        if($password !== $confirmPassword){ # checks the values are the same..
            $passwordError['confirm password'] = 'The passwords do not match'; # ..if not add key and value to passwordEror array
        }
    }
    return $passwordError; #return password error - this gets displayed on the form on the add user page
}

/*Function that takes data from user and adds it to cleanData if it is valid */
function validateAddUser($self, $errors, $duplicates, $passwordError){

    /* I'm adding both the errors and duplicate arrays as arguments here. To confirm the input is valid
    I  check the input has NOT been put in either the error or duplicate arrays. This reduces unneccesary code, otherwise
    we are validating the same data twice */
    $cleanData = array();

    if (isset($_POST['submit'])) { # form only runs if post is submitted
        $firstname = trim($_POST['firstname']);
        if (!isset($errors['firstname'])) {
            $cleanData['firstname'] = $firstname;
        }
        $surname = trim($_POST['surname']);
        if (!isset($errors['surname'])) {
            $cleanData['surname'] = $surname;
        }
        $email = trim($_POST['email']); # check email is valid and not a duplicate
        if (!isset($errors['email']) && (!isset($duplicates['email']))) {
            $cleanData['email'] = $email;
        }

        $title = trim($_POST['title']);
        if (!isset($errors['title'])) {
            $cleanData['title'] = $title;
        }
        $username = trim($_POST['username']); # check username is valid and not a duplicate
        if (!isset($errors['username']) && (!isset($duplicates['username'])) ) {
            $cleanData['username'] = $username;
        }
        $password = trim($_POST['password']);
        if (!isset($errors['password']))  {
            $cleanData['password'] = $password;
        }
        $confirmPassword = trim($_POST['confirm-password']);
        if (!isset($passwordError['confirm password'])) { # i'm checking the password is the same as confirm password here
            $cleanData['confirm password'] = $confirmPassword;
        }
    }
    return $cleanData;
}

/*-------------- FUNCTION TO WRITE USER DATA TO FILE  -----------------------------*/

/* This writes the validated data from add user form to the text file. */
function writeToFile($handle, $cleanData){
        $username = htmlentities($cleanData['username']);
        $password = htmlentities($cleanData['password']);
        $title = htmlentities($cleanData['title']);
        $firstname = htmlentities($cleanData['firstname']);
        $surname = htmlentities($cleanData['surname']);
        $email = htmlentities($cleanData['email']);
        /* The verification process ensured that none of the inputs can contain commas, so they are an effective delimiter */
        $text =  $username.','.$password.','. $title .','. $firstname.','. $surname.','. $email.PHP_EOL;
        fwrite( $handle , $text ) ;
}

/*-------------- FUNCTIONS TO CLOSE FILE AND DIRECTORY  -----------------------------*/

function closeHandle($handle){
    fclose($handle);
}

function closeDirectory($handleDir){
    closedir($handleDir);
}

/*--------------  navigation, refresh page to add user functions  -----------------------------*/
/*Refresh page -  it is used so another user can be added after correct form submission*/
function refreshPageButton(){
    $self = htmlentities($_SERVER['PHP_SELF']);
    $output='
    <a href="'.$self.'"><button class="button1">Add User</button></a>';
    return $output;

}
/* Function that displays menu. The array is stored in menu.php */
function makeMenu($menu){
    $output='';
    $list = '<ul>'. PHP_EOL;
    $listClose = '</ul>'. PHP_EOL;
    foreach ($menu as $key => $items) {

         $output.='<li class="menu"> <a href ='.$key.'>'.$items.'</a></li>'. PHP_EOL;
     }
     $finalMenu = $list . $output . $listClose;
     return $finalMenu;
}

// <!--Joseph Ketterer
// Jkette01
// Web Programming with PHP
// Tobi Brodie -->


?>
