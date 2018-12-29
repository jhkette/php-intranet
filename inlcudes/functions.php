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


function displayForm( $data = array(), $errors=array())
{
    ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
                           <fieldset>
                        <legend>Please log in</legend>
                               <div>
                                   <label for="">Username</label>
                                   <?php if (isset($errors['username'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['username'])) {echo htmlspecialchars($data['username']);} ?>" name="username" id="name" />
                               </div>
                               <div>
                                   <label for="">Password</label>
                                   <?php if (isset($errors['password'])) {echo '<p> Please enter password </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['password'])) {echo htmlspecialchars($data['password']);} ?>"  name="password" id="password"/>
                               </div>

                               <div>
                                   <input type="submit" name="submit" value="submitbutton" />
                               </div>
                           </fieldset>
                       </form>

    <?php
}



function validateInputs($self)
{
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';


    $data = array();

    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        if ($username == $adminusername) {
            $data['username'] = $username;
            $_SESSION['admin'] = $username;
        }
    }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        if ($password == $adminpassword ) {
            $data['password'] = $password;
            $_SESSION['password'] = $password;
        }
    }
    return $data;
}

function validateErrors($self)
{
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';
    $errors = array();

    $errors_detected;
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        if ($username !== $adminusername) {
            $errors['username'] = 'Full name is not valid';

        }
    }

    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        if ($password !== $adminpassword) {
            $errors['password'] = 'password name is not valid';

        }
    }
    return $errors;
}

function validateLoginInputs($self, $loggeddata){
    $errors = array();
    $data = array();
    $errors_detected;
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
         foreach ($loggeddata as $key => $value) {
            $loggedUsername = explode(',', $value);
            $loggedUsername = $loggedUsername[0];
            if ($username == $loggedUsername ) {
                $data['username'] = $username;
                $_SESSION['admin'] = $username;
             }
         }
     }
     /*I'm not saving and representing the password data. Passwords are not like other form data. They can only be correct in relation to
     a correct username. It would not be appropriate (or secure) to save correct passwords independant of usernames. Of course if they
     are correct in relation to a username they will be logged in and the data will not need to be represented anyway */
    return $data;
}


function validateLoginErrors($self, $loggeddata)
{

    $correctdata = array();
    $correctPassword = array();

    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
         foreach ($loggeddata as $key  => $value) {
            $loggedUsername = explode(',', $value);
            $loggedUsername = $loggedUsername[0];
            if($username == $loggedUsername){
            array_push($correctdata, $loggedUsername);
         }
     }
 }
     if(count($correctdata)== 0){
         $errors['username'] = 'Full name is not valid';
     }
    if (isset($_POST['password'])) {
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
return $errors;
}


function bothFieldsValid($self, $loggeddata){
    $valid = false;
    if (isset($_POST['username']) && (isset($_POST['password']))) {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        foreach ($loggeddata as $key => $value) {
            $loggeddata = explode('|', $value);
            $userPassword  =  $loggeddata[0];
            $userPassword = explode(',', $value);
            $userPassword[0] = trim($userPassword[0]);
            $userPassword[1] = trim($userPassword[1]);


            if(($userPassword[0]==  $username) && ($userPassword[1] == $password)){

                $valid = true;
            }

        }
}
return $valid;
}


function displayResults($data)
{
    ?>

       <?php foreach ($data as $key => $value): ?>
                <li class = "list-group-item">
                    <strong><?php echo $key; ?>: </strong>
                    <?php echo $value; ?>
                </li>
        <?php endforeach; ?>

<?php
}


function displayErrors($errors)
{
    ?>
    <?php foreach ($errors as $key => $value): ?>
        <li class = "list-group-item">
            <span class="red-text">  <strong><?php echo ucfirst($key); ?>: </strong></span>
            <span class="red-text">    <?php echo $value; ?> </span>
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
                // ensure $line is HTML chars
                $line = htmlentities(trim($line));
                if  (!empty($line))  { # check it is not an empty line
                    $line = explode('|', $line);
                    array_push($dataArray,  $line[0]);
                }
            }
            return $dataArray;
        }

function writeToFile($handle){

    if (isset($_POST['username']) && (isset($_POST['password']))) {

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

// a. Title
// b. First name
// c. Surname
// d. Email
// e. Username
// f. Password

function addUserForm($displayForm, $data = array(), $errors=array())
{
    ?>
    <?php if ($displayForm == true): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
                           <fieldset>
                        <legend>Add a user</legend>
                        <div>
                            <label for="">Title</label>
                            <select name="title" id="title">
                                <?php if (isset($errors['title'])) {echo '<p> No value selected </p>';} ?>
                                <option value="Mr"  <?php if (isset($data['title']) &&  ($data['title']=="Mr")) {echo 'selected ="selected"';} ?>>Mr</option>
                                <option value="Mrs" <?php  if (isset($data['title']) &&  ($data['title']=="Mrs")) {echo 'selected ="selected"';} ?>>Mrs</option>
                                <option value="Ms" <?php  if (isset($data['title']) &&  ($data['title']=="Ms")) {echo 'selected ="selected"';} ?>>Ms</option>
                            </select>
                        </div>
                               <div>
                                   <label for="">First name</label>
                                   <?php if (isset($errors['firstname'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['firstname'])) {echo htmlspecialchars($data['firstname']);} ?>" name="firstname" id="name" />
                               </div>
                               <div>
                                   <label for="">Surname</label>
                                   <?php if (isset($errors['surname'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['surname'])) {echo htmlspecialchars($data['surname']);} ?>" name="surname" id="name" />
                               </div>
                               <div>
                                   <label for="">Email</label>
                                   <?php if (isset($errors['email'])) {echo '<p> Please enter email </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['email'])) {echo htmlspecialchars($data['email']);} ?>"  name="email" id="email"/>
                               </div>
                               <div>
                                   <label for="">Username</label>
                                   <?php if (isset($errors['username'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['username'])) {echo htmlspecialchars($data['username']);} ?>" name="username" id="name" />
                               </div>
                               <div>
                                   <label for="">Password</label>
                                   <?php if (isset($errors['password'])) {echo '<p> Please enter password </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['password'])) {echo htmlspecialchars($data['password']);} ?>"  name="password" id="password"/>
                               </div>
                               <div>
                                   <input type="submit" name="submit" value="submitbutton" />
                               </div>
                           </fieldset>
                       </form>
             <?php endif; ?>
    <?php
}

function validateAddUser($self){
    $data = array();

    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        if (ctype_alpha($username) && (strlen($username) < 75) && strlen($username) > 2) {
            $data['username'] = $username;

        }
    }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        if (ctype_alnum($password) && (strlen($password) < 75) && strlen($password) > 2) {
            $data['password'] = $password;
        }
    }

    if (isset($_POST['firstname'])) {
        $firstname = trim($_POST['firstname']);
        if (ctype_alpha($firstname) && (strlen($firstname) < 75) && strlen($firstname) > 2) {
            $data['firstname'] = $firstname;
        }
    }
    if (isset($_POST['surname'])) {
        $surname = trim($_POST['surname']);
        if (ctype_alpha($surname) && (strlen($surname) < 75) && strlen($surname) > 2) {
            $data['surname'] = $surname;
        }
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if ((strpos($email, '@')!== false) && (strlen($email) < 75) && strlen($email) > 2) {
            $data['email'] = $email;
        }
    }

    if (isset($_POST['title'])) {
        $mail = trim($_POST['title']);
        if (($mail == 'Mr') || ($mail == 'Mrs') || ($mail == 'Ms')) {
            $data['title'] = $mail;
        }
    }

return $data;
}

function addUserErrors($self){
    $errors = array();


    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        if (!ctype_alpha($username) || (strlen($username) > 75) || (strlen($username) < 2)) {
            $errors['username'] = $username;

        }
    }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        if (!ctype_alnum($password) || (strlen($password) > 75)|| (strlen($password) < 2)) {
            $errors['password'] = $password;
        }
    }

    if (isset($_POST['firstname'])) {
        $firstname = trim($_POST['firstname']);
        if (!ctype_alpha($firstname) || (strlen($firstname) > 75) || (strlen($firstname) < 2))  {
            $errors['firstname'] = $firstname;
        }
    }
    if (isset($_POST['surname'])) {
        $surname = trim($_POST['surname']);
        if (!ctype_alpha($surname) || (strlen($surname) > 75) || (strlen($surname) < 2)) {
            $errors['surname'] = $surname;
        }
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if ((strpos($email, '@') === false) || (strlen($email) > 75) || (strlen($email) < 4)) {

            $errors['email'] = $email;
        }
    }
    return $errors;
}


function refreshPageButton(){
    ?>

    <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button class="button button1">Add User</button></a>

    <?php
}


?>
