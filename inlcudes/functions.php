<?php

function showFormErrors($displayForm, $data = array(), $errors=array())
{
    ?>
    <?php if ($displayForm == true): ?>
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
    $errors = array();
    $data = array();
    $errors_detected;
    if (isset($_POST['fullname'])) {
        $fullname = trim($_POST['fullname']);
        if ((strlen($fullname) < 150) && (preg_match('/\s/', $fullname))) {
            $data['fullname'] = $fullname;

        }
    }


    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $email;
        }
    }



    return $data;
}

function validateErrors($self)
{
    $errors = array();
    $data = array();
    $errors_detected;
    if (isset($_POST['fullname'])) {
        $fullname = trim($_POST['fullname']);
        if ((strlen($fullname) > 150) || (!preg_match('/\s/', $fullname))) {
            $errors['fullname'] = 'Full name is not valid';

        }
    } else {
        $errors['fullname'] = 'Full name is not valid';

    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'email name is not valid';

        }
    } else {
        $errors['email'] = 'email name is not valid';
    }


    return $errors;
}



function errordetection($self)

{
    $errors = array();
    $data = array();
    $errors_detected = false;
    if (isset($_POST['fullname'])) {
        $fullname = trim($_POST['fullname']);
        if ((strlen($fullname) > 150) || (!preg_match('/\s/', $fullname))) {
          $errors_detected = true;

        }

    }
    else{
        $errors_detected = true;
    }


    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errors_detected = true;
        }
    } else {
        $errors_detected = true;
    }


    return     $errors_detected;
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
?>
