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


function displayForm($showForm, $data = array(), $errors=array())
{
    ?>
        <?php if ($showForm == true): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
                           <fieldset>
                        <legend>Sign Up</legend>
                               <div>
                                   <label for="">Full Name</label>
                                   <?php if (isset($errors['fullname'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['fullname'])) {echo htmlspecialchars($data['fullname']);} ?>" name="fullname" id="name" />
                               </div>
                               <div>
                                   <label for="">Email</label>
                                   <?php if (isset($errors['email'])) {echo '<p> Please enter email </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['email'])) {echo htmlspecialchars($data['email']);} ?>"  name="email" id="email"/>
                               </div>

                               <div>
                                   <input type="submit" name="submit" value="submitbutton" />
                               </div>
                           </fieldset>
                       </form>
        <?php endif; ?>
    <?php
}



function validateInputs($self)
{
    $username = 'admin';
    $password = 'DCSadmin01';

    $errors = array();
    $data = array();
    $errors_detected;
    if (isset($_POST['fullname'])) {
        $fullname = trim($_POST['fullname']);
        if ($fullname == $username) {
            $data['fullname'] = $fullname;
            $_SESSION['fullname'] = $fullname;
        }
    }
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if ($email == $password) {
            $data['email'] = $email;
            $_SESSION['email'] = $email;
        }
    }
    return $data;
}

function validateErrors($self)
{
    $username = 'admin';
    $password = 'DCSadmin01';
    $errors = array();
    $data = array();
    $errors_detected;
    if (isset($_POST['fullname'])) {
        $fullname = trim($_POST['fullname']);
        if ($fullname !== $username) {
            $errors['fullname'] = 'Full name is not valid';

        }
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if ($email !== $password) {
            $errors['email'] = 'email name is not valid';

        }
    }
    return $errors;
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
                            /* I'm checking the file for whitespace as per the specifications provided. The only way to do this without
                            opening the file is to use file_get_contents. This takes up more memory than opening/closing but allows validation
                            before opening. I'm only checking the first 50 charecters */
                            $checkWhiteSpace = (file_get_contents('data/' . $value, FALSE, NULL, 0, 50)); # only check first 50 charecters
                            if ((pathinfo($value, PATHINFO_EXTENSION)) == 'txt'){ # check file is a text file. xml file will be ignored
                                if ((filesize(('data/' . $value)) == 0) || ((ctype_space($checkWhiteSpace)))) { # check file isn't empty & isn't whitespace
                                    echo '<p> File name : '. $value . '</p>'. PHP_EOL; # useful to know which file is empty
                                    echo '<p> This is an empty file and has not been opened </p>'. PHP_EOL;

                                }
                                else{
                                    echo '<p> File name : '. $value . '</p>' . PHP_EOL;
                                    // open file or report error using string 'data/' and $value to create path to files
                                    $handle = fopen('data/' . htmlentities(trim($value)), 'r');

                                    return $handle;
                                }
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
                    array_push($dataArray,  $line);
                }
            }
            return $dataArray;
        }


?>
