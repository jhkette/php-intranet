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

    $errors = array();
    $data = array();
    $errors_detected;
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
    $data = array();
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
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';
    $errors = array();
    $correctdata = array();
    $correctPassword = array();
    $errors_detected;
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
            $loggeddata = explode(',', $value);
            $loggeddata[0] = trim($loggeddata[0]);
            $loggeddata[1] = trim($loggeddata[1]);


            if(($loggeddata[0] ==  $username) && ($loggeddata[1] == $password)){

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

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $text = $username.','.$password.'|';
        fwrite( $handle , $text ) ;



    }

}

?>
