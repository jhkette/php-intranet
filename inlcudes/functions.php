<?php

require_once('inlcudes/init.php');

/* ------------------------ FORM PRESENTATION AND FEEDBACK FUNCTIONS -------------------------------*/

function displayForm( $cleanData = array(), $errors=array()){
    $passwordErrors='';
    $userErrors = '';
    if(isset($cleanData['username'])) {
        $userName = htmlentities($cleanData['username']);
    }
    else{
        $userName = '';
    }
    if (isset($errors['username']))
      {$userErrors =  '<p> Please enter your username </p>';}
     else {
         $userErrors = '';
        }
    if (!isset($errors['username'])){
        if (isset($errors['password'])) {
            $passwordErrors =  '<p> Please enter your password </p>';}
         else {
             $passwordErrors = '';
            }
        }
    $self = htmlentities($_SERVER['PHP_SELF']);
    print_r($errors);

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


  function displayErrors($errors, $duplicates=array(), $passwordError=array()){
      $output='';
      foreach ($errors as $key => $value) {
          $output.='<li class = "list-group-item">
                   <strong>'. htmlentities($key). '</strong> '.htmlentities($value).'
                   </li>';
           }
       foreach ($duplicates as $key => $value) {
           $output.='<li class = "list-group-item">
                     <strong>'. htmlentities($key). '</strong> '.htmlentities($value).'
                     </li>';
                }
        foreach ($passwordError as $key => $value) {
            $output.='<li class = "list-group-item">
                      <strong>'. htmlentities($key). '</strong> '.htmlentities($value).'
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
                  $handle = fopen('data/' . htmlentities(trim($value)), 'a+') or die( 'Unable to open file!') ;
                  }
              }
          }
      }
      return $handle;
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

/*The admin login and and oridnary login function do need to be seperate. I could also check for the admin uaer/password
in the login functions and then call them on both pages. But the admin should ONLY be able to login on the admin page -
therfore we need a sperate function that deals ONLY with admin login. Similarly an admin cannot login via the normal login pages
 */


function validateErrors($self){
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';
    $errors = array();
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ($username !== $adminusername) {
            $errors['username'] = 'Username is not valid';
        }
        /*I'm only checking if the password is valid if the username doesn't contain any errors
        It doesn't make sense for a password to be correct independant of the username it is attached to */

        if ($password !== $adminpassword) {
                $errors['password'] = 'password name is not valid';
            }

    }
    return $errors;
}
/*Use admin as a parameter  */
function validateLoginInputs($self, $errors=array(), $admin){
    $cleanData = array();
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if(!isset($errors['username'])) {

            $cleanData['username'] = $username;

        }
        /* I'm not saving and representing the password data. Passwords are not like other form data. They can only be correct in relation to
        a correct username. It would not be appropriate (or secure) to save correct passwords independant of usernames. */
        if(!isset($errors['username']) && (!isset($errors['password']))) {
          if($admin == true){
              $_SESSION['admin'] = $username;
          }
          else{
               $_SESSION['user'] = $username;
           }
       }
   }

    return $cleanData;
}


function validateLoginErrors($self, $loggeddata){
    $errors  = array();
    $correctData = false;
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
            $errors['username'] = 'Username is not valid';
        }
        if($correctPassword == false){
            $errors['password'] = 'password is not valid';
        }
    }
    return $errors;
}

/* ------------------------ FUNCTIONS TO VALIDATE ADD USER FORM  -------------------------------*/

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
        if (($title == 'Mr') || ($title == 'Mrs') || ($title == 'Ms')){ # still check the correct value is sent to form for security
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
            $errors['firstname'] = 'Names can only contain letters. It needs to be at least two charecters';
        }
        $surname = trim($_POST['surname']);
        if (!ctype_alpha($surname) || (strlen($surname) > 25) || (strlen($surname) <= 2)) {
            $errors['surname'] = 'Surnames can only contain letters. It needs to be at least two charecters';
        }
        $email = trim($_POST['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $errors['email'] = 'Please enter a valid email address';
        }
        $username = trim($_POST['username']);
        if (!ctype_alnum($username) || (strlen($username) > 25) || (strlen($username) < 5)) {
            $errors['username'] = 'Usernames can only be numbers or letters. It needs to be five or more chrecters long';
        }
        $password = trim($_POST['password']);
        if (!ctype_alnum($password) || (strlen($password) > 25) || (strlen($password) < 5)) {
            $errors['password'] = 'This is not valid password. It should contain only letters and numbers and be five or more
            charecters long';
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
            /* Duplicate username checked - now check  if there are duplicate email
            by exploding the other index of $loggeddata  */
            if($loggeddata[5] == $email){ #email value will be at index [3]
                $emailMatch = true; # change emailmatch to true if match found
            }
        }
        if($emailMatch== true){
        $duplicates['email'] = 'This is a duplicate';
        }
        if($userMatch== true){
            $duplicates['username'] = 'This is a duplicate';
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
            $passwordError['confirm password'] = 'The passwords do not match'; # add key and value to password array
        }

    }
    return $passwordError; #return password error - this gets displayed on the form on the add user page
}

/*-------------- FUNCTION TO WRITE USER DATA TO TILE  -----------------------------*/

function writeToFile($handle){
        $username = htmlentities(trim($_POST['username']));
        $password = htmlentities(trim($_POST['password']));
        $title = htmlentities(trim($_POST['title']));
        $firstname = htmlentities(trim($_POST['firstname']));
        $surname = htmlentities(trim($_POST['surname']));
        $email = htmlentities(trim($_POST['email']));
        $text =  $username.','.$password.','. $title .','. $firstname.','. $surname.','. $email.PHP_EOL;
        fwrite( $handle , $text ) ;
}


/*-------------- Header, footer, navigation functions  -----------------------------*/
function refreshPageButton(){
    ?>
    <a href="<?php echo htmlentities($_SERVER['PHP_SELF']) ; ?>"><button class="button button1">Add User</button></a>
    <?php
}

function makeMenu($menu){
    $output='';
    foreach ($menu as $key => $items) {
         $output.='<li> <a href ='.$key.'>'.$items.'</a></li>';
     }
     return $output;
}
?>
