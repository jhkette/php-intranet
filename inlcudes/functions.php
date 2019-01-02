<?php

require_once('inlcudes/init.php');

/* ------------------------ FORM PRESENTATION AND FEEDBACK FUNCTIONS -------------------------------*/

function displayForm( $cleanData, $errors){
    $passwordErrors='';
    $userErrors = '';
    if(isset($cleanData['username'])) {
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
                <label for="">Username</label>'.
                 $userErrors .
                '<input type="text"  value= " '.$userName.'" name="username" id="name" />
            </div>
            <div>
                 <label for="">Password</label>'
                .$passwordErrors.
                 '<input type="password"  value= ""  name="password" id="password"/>
             </div>
              <div>
                  <input type="submit" name="submit" value="submitbutton" />
              </div>
          </fieldset>
      </form>';
      return $output;
  }


 function displayResults($data){
      $output='';
      foreach ($data as $key => $value) {
          $output.='<li class = "list-group-item">
                   <strong>'. htmlentities($key). '</strong> '.htmlentities($value).'
                   </li>';
           }
      return $output;
  }


  function displayErrors($errors, $duplicates, $passwordError){
      $output='';
      foreach ($errors as $key => $value) {
          $output.='<li class = "list-group-item">
                   <strong>'. htmlentities(ucfirst($key)). '</strong> '.htmlentities($value).'
                   </li>';
           }
       foreach ($duplicates as $key => $value) {
           $output.='<li class = "list-group-item">
                     <strong>'. htmlentities(ucfirst($key)). '</strong> '.htmlentities($value).'
                     </li>';
                }
        foreach ($passwordError as $key => $value) {
            $output.='<li class = "list-group-item">
                      <strong>'. htmlentities(ucfirst($key)). '</strong> '.htmlentities($value).'
                      </li>';
                     }
        return $output;
  }

/*-------------------------- FUNCTIONS TO GET DATA FROM FILES -------------------------- */

 function openDirectory(){
      $handleDir = opendir('./data');
      if ($handleDir === false){
          echo '<p> System error: Unable to open directory</p>';
      }
      else {
          while(false !== ($file = readdir($handleDir))) {
              if ($file != "." && $file != "..") { # don't add dots which represent directories to array
                  $fileDir1 = array(); # create array
                  array_push($fileDir1, $file); # push into array
                  foreach ($fileDir1 as $key => $value) { # readdir creates an array of files so i'm using a foreach loop to get the file value.
                  // open file or report error using string 'data/' and $value to create path to files
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
  }

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
      return $dataArray; # an array of usernames & passwords (all on one line, to be seperated later)
  }


/*------------------------ FUNCTIONS TO VALIDATE LOGIN FORMS ---------------------------- */

function validateLoginErrors($self, $loggeddata){
    $errors  = array(); # create errors array
    $correctData = false;  # set variables to false
    $correctPassword = false;
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        foreach ($loggeddata as $key => $value) {
            $userPassword = explode(',', $value);
            $userPassword[0] = trim($userPassword[0]);
            $userPassword[1] = trim($userPassword[1]);
            if ($userPassword[0] == $username){
                 $correctData = true;
            }
            if(($userPassword[0] ==  $username) && ($userPassword[1] == $password)) {
                   $correctPassword = true;
               }
        }
        if($correctData == false){
            $errors['username'] = 'This username does not exist';
        }
        if($correctPassword == false){
            $errors['password'] = 'This is not the correct password';
        }
    }
    return $errors;
}


function validateErrors($self){
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';
    $errors = array();
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ($username !== $adminusername) {
            $errors['username'] = 'This is not the correct username for Admin';
        }
        /*I'm only checking if the password is valid if the username doesn't contain any errors
        It doesn't make sense for a password to be correct independant of the username it is attached to */
        if ($username == $adminusername){
        if ($password !== $adminpassword) {
                $errors['password'] = 'This is not the correct password for Admin';
            }
        }
    }
    return $errors;
}


function validateLoginInputs($self, $errors, $admin){
    $cleanData = array();
    /* I'm not saving and representing the password data. Passwords are not like other form data. They can only be correct in relation to
    a correct username. It would not be appropriate (or secure) to save correct passwords independant of usernames. */
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if(!isset($errors['username'])) {
            $cleanData['username'] = $username;
        }
        if(!isset($errors['username']) && (!isset($errors['password']))) {
          session_regenerate_id(true);
          if($admin == true){ # if the parameter passed in as admin is true create $_SESSION['admin'] - for access to 'add user'
              $_SESSION['admin'] = $username;
          }
          else{
               $_SESSION['user'] = $username;
           }
       }
   }
   return $cleanData;
}

/* ------------------------ FUNCTIONS TO VALIDATE ADD ANOTHER USER FORM  -------------------------------*/

function validateAddUser($self, $errors, $duplicates){

    /* I'm adding both the errors and duplicate arrays as arguments here. To confirm the input is valid
    I  check the input has NOT been put in either the error or duplicate arrays. This reduces unneccesary code */
    $cleanData = array();

    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        if (!isset($errors['username']) && (!isset($duplicates['username'])) ) {
            $cleanData['username'] = $username;
        }

        $firstname = trim($_POST['firstname']);
        if (!isset($errors['firstname'])) {
            $cleanData['firstname'] = $firstname;
        }
        $surname = trim($_POST['surname']);
        if (!isset($errors['surname'])) {
            $cleanData['surname'] = $surname;
        }

        $email = trim($_POST['email']);
        if (!isset($errors['email']) && (!isset($duplicates['email']))) {
            $cleanData['email'] = $email;
        }

        $title = trim($_POST['title']); # Errors are not possible on the select 'title' box, a value is always selected
        if (($title == 'Mr') || ($title == 'Mrs') || ($title == 'Ms') || ($title == 'Miss')) { # still check the correct value is sent to form for security
            $cleanData['title'] = $title;
        }
        $password = trim($_POST['password']);
        if (!isset($errors['password']))  {
            $cleanData['password'] = $password;
        }
        $confirmPassword = trim($_POST['confirm-password']);
        if ($confirmPassword == $password ) {
            $cleanData['confirm password'] = $confirmPassword;
        }
    }
    return $cleanData;
}


function addUserErrors($self){
    $errors = array();
    $userMatch = false;
    if (isset($_POST['submit'])) {

        $firstname = trim($_POST['firstname']);
        if (!ctype_alpha($firstname) || (strlen($firstname) > 25) || (strlen($firstname) <= 2))  {
            $errors['firstname'] = 'Names can only contain letters. They need to be at least two charecters.';
        }
        $surname = trim($_POST['surname']);
        if (!ctype_alpha($surname) || (strlen($surname) > 25) || (strlen($surname) <= 2)) {
            $errors['surname'] = 'Surnames can only contain letters. They need to be at least two charecters.';
        }
        $email = trim($_POST['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        $username = trim($_POST['username']);
        if (!ctype_alnum($username) || (strlen($username) > 25) || (strlen($username) < 5)) {
            $errors['username'] = 'Usernames can only be numbers or letters. It needs to be five or more chrecters long.';
        }
        $password = trim($_POST['password']);
        if (!ctype_alnum($password) || (strlen($password) > 25) || (strlen($password) < 5)) {
            $errors['password'] = 'This is not a valid password. It should contain only letters and numbers. It needs to be five or more
            charecters long.';
        }
    }
    return $errors;
}


function checkDuplicates($self, $loggeddata){
    $duplicates = array();
    $userMatch = false;
    $emailMatch = false;
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        foreach ($loggeddata as $key => $value) {
            $loggeddata = explode(',', $value);
            $loggeddata[0] =  trim($loggeddata[0]);
            $loggeddata[5] =  trim($loggeddata[5]);
            if ($loggeddata[0] == $username){
                $userMatch = true;
            }
            if($loggeddata[5] == $email){ #email value will be at index [5]
                $emailMatch = true; # change emailmatch to true if match found
            }
        }
        if($emailMatch== true){
        $duplicates['email'] = 'This email is already in use';
        }
        if($userMatch== true){
            $duplicates['username'] = 'This username is already in use';
        }
    }
    return $duplicates;
}

function confirmPassword($self){
    $passwordError = array();
    if (isset($_POST['submit'])) {
        $passWord = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm-password']);
        if($passWord !== $confirmPassword){
            $passwordError['confirm password'] = 'The passwords do not match'; # add key and value to passwordError array
        }
    }
    return $passwordError; #return password error - this gets displayed on the form on the add user page
}

/*-------------- FUNCTION TO WRITE USER DATA TO FILE  -----------------------------*/

/* This writes the validated data from add user form to the text file. */
function writeToFile($handle){
        $username = htmlentities(trim($_POST['username']));
        $password = htmlentities(trim($_POST['password']));
        $title = htmlentities(trim($_POST['title']));
        $firstname = htmlentities(trim($_POST['firstname']));
        $surname = htmlentities(trim($_POST['surname']));
        $email = htmlentities(trim($_POST['email']));
        /* The verification process ensured that none of the inputs can contain commas, so they are an effective delimiter */
        $text =  $username.','.$password.','. $title .','. $firstname.','. $surname.','. $email.PHP_EOL;
        fwrite( $handle , $text ) ;
}


/*-------------- Header, footer, navigation functions  -----------------------------*/
function refreshPageButton(){
    $self = htmlentities($_SERVER['PHP_SELF']);
    $output='
    <a href="'.$self.'"><button class="button button1">Add User</button></a>';
    return $output;

}

function makeMenu($menu){
    $output='';
    foreach ($menu as $key => $items) {
         $output.='<li> <a href ='.$key.'>'.$items.'</a></li>';
     }
     return $output;
}
?>
