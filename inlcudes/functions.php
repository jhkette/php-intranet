<?php

function displayForm($data = array(), $errors=array())
{
    ?>

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

        }
    }


    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if ($email == $password) {
            $data['email'] = $email;
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



function errordetection($self)

{
    $username = 'admin';
    $password = 'DCSadmin01';
    $errors = array();
    $data = array();
    $errors_detected = false;
    if (isset($_POST['fullname'])) {
        $fullname = trim($_POST['fullname']);
        if ($fullname !== $username) {
          $errors_detected = true;
        }
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if ($email !== $password) {

            $errors_detected = true;
        }
    }
    return
    $errors_detected;
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
?>
