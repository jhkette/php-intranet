<?php
// YOU NEED TO CLEAN ALL DATA!!!
require_once('inlcudes/init.php');



function makeMenu($menu){
 /* create variable  with empty string.*/
 $output='';
 //foreach looping through keys and items and adding them to html link
  foreach ($menu as $key => $items) {

    $output.='<li> <a href ='.$key.'>'.$items.'</a></li>' ;
  };
  return $output;
}


function displayForm( $cleanData = array(), $errors=array()){
    if(isset($cleanData['username'])) {
        $userName = htmlentities($cleanData['username']);
    }
    else{
        $userName = '';
    }
    ?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  method="post">
        <fieldset>
            <legend>Please log in</legend>
            <div>
                <label for="">Username</label>
                <?php if (htmlentities(isset($errors['username']))) {echo '<p> Please enter your username </p>';} ?>
                <input type="text"  value= "<?php echo $userName ?>" name="username" id="name" />
            </div>
            <div>
                 <label for="">Password</label>
                 <?php if (htmlentities(isset($errors['password']))) {echo '<p> Please enter password </p>';} ?>
                 <!--i'm not saving the password as a value. Password's can't be correct independant of the username  -->
                 <input type="password"  value= ""  name="password" id="password"/>
             </div>
              <div>
                  <input type="submit" name="submit" value="submitbutton" />
              </div>
          </fieldset>
      </form>
      <?php
}

/*The admin login and and oridnary login function do need to be seperate. I could also check for the admin uaer/password
in the login functions and then call them on both pages. But the admin should ONLY be able to login on the admin page -
therfore we need a sperate function that deals ONLY with admin login. Similarly an admin cannot login via the normal login pages
 */

function validateInputs($self){
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';
    $cleanData = array();
    if (isset($_POST['submit'])) {

        $username = trim($_POST['username']);
        if ($username == $adminusername) {
            $cleanData['username'] = $username;
            $_SESSION['admin'] = $username;
        }


        $password = trim($_POST['password']);
        if ($password == $adminpassword ) {
            $cleanData['password'] = $password;
            $_SESSION['password'] = $password;
        }

}
    return $cleanData;
}

function validateErrors($self)
{
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';
    $errors = array();

     if (isset($_POST['submit'])) {
         $username = trim($_POST['username']);
         if ($username !== $adminusername) {
            $errors['username'] = 'Username is not valid';
        }
        /*I'm only checking if the password is valid if the username doesn't contain any errors
        It doesn't make sense for a password to be correct independant of the username it is attached to */
        if (!isset($errors['username'])) {
            $password = trim($_POST['password']);
            if ($password !== $adminpassword) {
                $errors['password'] = 'password name is not valid';
            }
        }
    }
    return $errors;
}


function validateLoginInputs($self, $loggeddata){
    $errors = array();
    $cleanData = array();

     if (isset($_POST['submit'])) {

        $username = trim($_POST['username']);
         foreach ($loggeddata as $key => $value) {
            $loggedUsername = explode(',', $value);
            $loggedUsername = $loggedUsername[0];
            if ($username == $loggedUsername ) {
                $cleanData['username'] = $username;
                $_SESSION['admin'] = $username;
             }
         }
     }
     /*I'm not saving and representing the password data. Passwords are not like other form data. They can only be correct in relation to
     a correct username. It would not be appropriate (or secure) to save correct passwords independant of usernames. Of course if they
     are correct in relation to a username they will be logged in and the data will not need to be represented anyway */
    return $cleanData;
}


function validateLoginErrors($self, $loggeddata)
{
    $errors  = array();
    $correctData = array();
    $correctPassword = array();
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        foreach ($loggeddata as $key  => $value){
            $loggedUsername = explode(',', $value);
            $loggedUsername = $loggedUsername[0];
            if($username == $loggedUsername){
            array_push($correctData, $loggedUsername);
         }
     }

     if(count($correctData)== 0){
         $errors['username'] = 'Username is not valid';
     }
     else{
         $passwordValid = false;
        $password = trim($_POST['password']);
        foreach ($loggeddata as $key => $value) {
            $loggeddata = explode(',', $value);

            $loggeddata[0] = trim($loggeddata[0]);
            $loggeddata[1] = trim($loggeddata[1]);


            if(($loggeddata[0] ==  $username) && ($loggeddata[1] == $password)){

                array_push($correctPassword, $loggeddata[1]);
            }
        }
        if(count($correctPassword)== 0){
            $errors['password'] = 'Password is not valid';
        }
    }

}
return $errors;
}




function displayResults($data){
    ?>
    <?php foreach ($data as $key => $value): ?>
        <li class = "list-group-item">
            <strong><?php echo htmlentities($key); ?>: </strong>
            <?php echo htmlentities($value); ?>
        </li>
    <?php endforeach; ?>
    <?php
}


function displayErrors($errors, $duplicates=array(), $passwordError=array())
{
    ?>
    <?php foreach ($errors as $key => $value): ?>
        <li class = "list-group-item">
            <span class="red-text">  <strong><?php echo ucfirst(htmlentities($key)); ?>: </strong></span>
            <span class="red-text">    <?php echo htmlentities($value); ?> </span>
        </li>
    <?php endforeach; ?>
    <?php foreach ($duplicates as $key => $value): ?>
        <li class = "list-group-item">
            <span class="red-text">  <strong><?php echo ucfirst(htmlentities($key)); ?>: </strong></span>
            <span class="red-text">    <?php echo htmlentities($value); ?> </span>
        </li>
    <?php endforeach; ?>
    <?php foreach ($passwordError as $key => $value): ?>
        <li class = "list-group-item">
            <span class="red-text">  <strong><?php echo ucfirst(htmlentities($key)); ?>: </strong></span>
            <span class="red-text">    <?php echo htmlentities($value); ?> </span>
        </li>
    <?php endforeach; ?>
    <?php
}


/*THIS FUNCTION NEEDS TO BE EDITED DOWN*/
 function openDirectory(){
         $handleDir = opendir('./data');
         if ($handleDir === false) {
                echo '<p> System error: Unable to open directory</p>';
            }
            else {
                while(false !== ($file = readdir($handleDir))) {
                    if ($file != "." && $file != "..") { # don't add dots which represent directories to array
                        $fileDir1 = array(); # create array
                        array_push($fileDir1, $file); # push into array
                        foreach ($fileDir1 as $key => $value) { # for each loop to loop through files

                            if ((pathinfo($value, PATHINFO_EXTENSION)) == 'txt'){ # check file is a text file. xml file will be ignored


                                    // open file or report error using string 'data/' and $value to create path to files
                                    $handle = fopen('data/' . htmlentities(trim($value)), 'a+');

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


function getUserPw($handle){
    rewind($handle); # pointer needs to be at start of file
    $dataArray = array(); # create data array
    while (!feof($handle)) { #while not at the end of file
        $line = fgets($handle);

        $line = trim($line);
        if  (!empty($line))  { # check it is not an empty line
            $line = explode('|',$line);
            /* the write function and validate form function is going to ensure
            the '|' is always in the data files. The function always adds '|' after the
            username and password */

            array_push($dataArray,  $line[0]);
        }
    }
return $dataArray; # an array of usernames & passwords (all on one line, to be seperated later)
}



function writeToFile($handle){

     if (isset($_POST['submit'])) { // YOU MAY NOT NEED THIS

        $username = htmlentities(trim($_POST['username']));
        $password = htmlentities(trim($_POST['password']));
        $title = htmlentities(trim($_POST['title']));
        $firstname = htmlentities(trim($_POST['firstname']));
        $surname = htmlentities(trim($_POST['surname']));
        $email = htmlentities(trim($_POST['email']));
        $text =  $username.','.$password.'|' . $title .',' . $firstname.',' . $surname.',' . $email . PHP_EOL;
        fwrite( $handle , $text ) ;

    }

}


function addUserForm($displayForm, $cleanData = array(), $errors=array(), $duplicates=array(), $passwordError=array())
{
    if(isset($cleanData['title'])) {
        $title = htmlentities($cleanData['title']);
    }
    else{
        $title = 'Mr'; #the title needs to default to a value as it a select box
    }

    if (isset($cleanData['firstname'])){
        $firstname = htmlentities($cleanData['firstname']);
    }
    else{
        $firstname = '';
    }

    if (isset($cleanData['surname'])){
        $surname = htmlentities($cleanData['surname']);
    }
    else{
        $surname = '';
    }

    if (isset($cleanData['email'])){
        $email = htmlentities($cleanData['email']);
    }
    else{
        $email ='';
    }
    if(isset($cleanData['username'])) {
        $userName = htmlentities($cleanData['username']);
    }
    else{
        $userName = '';
    }
    if(isset($cleanData['password'])) {
        $password = htmlentities($cleanData['password']);
    }
    else{
        $password = '';
    }

    if(isset($cleanData['confirm password'])) {
        $confirmPassword = htmlentities($cleanData['confirm password']);
    }
    else{
        $confirmPassword = '';
    }

    ?>
    <?php if ($displayForm == true): ?>
        <!--post to the same page  -->
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  method="post">
                           <fieldset>
                        <legend>Add a user</legend>
                        <div>
                            <label for="">Title</label>
                            <select name="title" id="title">

                                <option value="Mr"  <?php if (htmlentities($title) == 'Mr')  {echo 'selected ="selected"';} ?>>Mr</option>
                                <option value="Mrs" <?php  if (htmlentities($title) == 'Mrs') {echo 'selected ="selected"';} ?>>Mrs</option>
                                <option value="Ms" <?php  if (htmlentities($title) == 'Ms') {echo 'selected ="selected"';} ?>>Ms</option>
                            </select>
                        </div>
                        <div>
                            <label for="">First name</label>
                                   <?php if (htmlentities(isset($errors['firstname']))) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php echo htmlentities($firstname) ?>" name="firstname" id="name" />
                               </div>
                               <div>
                                   <label for="">Surname</label>
                                   <?php if (htmlentities(isset($errors['surname']))) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php echo htmlentities($surname) ?>" name="surname" id="surname" />
                               </div>
                               <div>
                                   <label for="">Email</label>
                                   <?php if (htmlentities(isset($duplicates['email']))) {echo '<p> This email has already been used</p>';} ?>
                                   <?php if (htmlentities(isset($errors['email']))) {echo '<p> Please enter email </p>';} ?>
                                   <input type="text"  value= "<?php echo htmlentities($email) ?>"  name="email" id="email"/>
                               </div>
                               <div>
                                   <label for="">Username</label>
                                   <?php if (htmlentities(isset($duplicates['username']))) {echo '<p> This username has already been used</p>';} ?>
                                   <?php if (htmlentities(isset($errors['username']))) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php echo htmlentities($userName) ?>" name="username" id="username" />
                               </div>
                               <div>
                                   <label for="">Password</label>
                                   <?php if (htmlentities(isset($errors['password']))) {echo '<p> Please enter password </p>';} ?>
                                   <input type="password"  value= "<?php echo htmlentities($password) ?>"  name="password" id="password"/>
                               </div>
                               <div>
                                   <label for="">Confirm Password</label>
                                   <?php if (htmlentities(isset($passwordError['confirm password']))) {echo '<p> The passwords do not match</p>';} ?>
                                   <input type="password"  value= "<?php echo $confirmPassword?>"  name="confirm-password" id="confirm-password"/>
                               </div>
                               <div>
                                   <input type="submit" name="submit" value="submitbutton" />
                               </div>
                           </fieldset>
                       </form>
             <?php endif; ?>
    <?php
}

function validateAddUser($self, $loggeddata){
    $cleanData = array();
    $userMatch = false;
    $emailMatch = false;

    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        foreach ($loggeddata as $key => $value) {

            $data = explode('|', $value);
            $userPassword  =  $data[0];
            $userPassword = explode(',', $userPassword);
            $userPassword[0] = trim($userPassword[0]);
            if ($userPassword[0] == $username){
                $userMatch = true;
            }

            $emailList = $data[1];
            $emailList = explode(',', $emailList);
            if($emailList[3]== $email){
                $emailMatch = true;
            };
        }

        /* username already declared*/
        if (ctype_alpha($username) && (strlen($username) < 75) && (strlen($username) > 2) && ($userMatch == false)) {


            $cleanData['username'] = $username;

    }

        $firstname = trim($_POST['firstname']);
        if (ctype_alpha($firstname) && (strlen($firstname) < 75) && (strlen($firstname) > 2)) {
            $cleanData['firstname'] = $firstname;
        }
        $surname = trim($_POST['surname']);
        if (ctype_alpha($surname) && (strlen($surname) < 75) && (strlen($surname) > 2)) {
            $cleanData['surname'] = $surname;
        }
       /* email already declared*/
        $email = trim($_POST['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($emailMatch == false){
            $cleanData['email'] = $email;
            }
        }
        $title = trim($_POST['title']);
        if (($title == 'Mr') || ($title == 'Mrs') || ($title == 'Ms')) {
            $cleanData['title'] = $title;
        }
        $password = trim($_POST['password']);
        if (ctype_alnum($password) && (strlen($password) < 75) && (strlen($password) > 2)) {
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


        $username = trim($_POST['username']);
        /* Explain ranges - why <= is needed for two. */
        if (!ctype_alpha($username) || (strlen($username) > 75) || (strlen($username) <= 2)) {
            $errors['username'] = $username;}
        $password = trim($_POST['password']);
        if (!ctype_alnum($password) || (strlen($password) > 75)|| (strlen($password) <= 2)) {
            $errors['password'] = $password;
        }

        $firstname = trim($_POST['firstname']);
        if (!ctype_alpha($firstname) || (strlen($firstname) > 75) || (strlen($firstname) <= 2))  {
            $errors['firstname'] = $firstname;
        }
        $surname = trim($_POST['surname']);
        if (!ctype_alpha($surname) || (strlen($surname) > 75) || (strlen($surname) <= 2)) {
            $errors['surname'] = $surname;
        }
        $email = trim($_POST['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {

            $errors['email'] = $email;
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
            $loggeddata = explode('|', $value);
            $userPassword  =  $loggeddata[0];
            $userPassword = explode(',', $userPassword);
            $userPassword[0] = trim($userPassword[0]);
            if ($userPassword[0] == $username){
                $userMatch = true;
            }
            if($userMatch== true){
                $duplicates['username'] = 'This is a duplicate';
            }
            /*duplicate username checked - now check  if there are duplicate email
            by exploding the other index of $loggeddata  */
            $emailList = $loggeddata[1];
            $emailList = explode(',', $emailList);
            if($emailList[3]== $email){
                $emailMatch = true;
            }
        }
        if($emailMatch== true){
        $duplicates['email'] = 'This is a duplicate';
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
            $passwordError['confirm password'] = 'The passwords do not match';
        }

    }
    return $passwordError;
}


function refreshPageButton(){
    ?>

    <a href="<?php echo htmlentities($_SERVER['PHP_SELF']) ; ?>"><button class="button button1">Add User</button></a>

    <?php
}


?>
