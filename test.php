<?php

function validateAddUser($self, $errors, $duplicates){

    /* I'm adding both the errors and duplicate arrays as arguments here. To confirm the input is valid
    I  check the input has NOT been put in either the error or duplicate arrays. This reduces unneccesary code, otherwise
    we are validating the same data twice */
    $cleanData = array();

    if (isset($_POST['submit'])) { # form only runs if post is submitted
        $firstname = trim($_POST['firstname']);
        if (ctype_alpha($firstname) && (strlen($firstname) < 20) && (strlen($firstname) >= 2)) {
            $cleanData['firstname'] = $firstname;
        }
        $surname = trim($_POST['surname']);
        if (ctype_alpha($firstname) && (strlen($firstname) < 20) && (strlen($firstname) >= 2))  {
            $cleanData['surname'] = $surname;
        }
        $email = trim($_POST['email']); # check email is valid and not a duplicate
        if ((filter_var($email, FILTER_VALIDATE_EMAIL) == true) &&  (!isset($duplicates['email'])))  {
            $cleanData['email'] = $email;
        }
        $title = trim($_POST['title']);
        if (($title == 'Mr') || ($title == 'Mrs') || ($title == 'Ms') || ($title == 'Miss')) { # still check the correct value is sent to form for security
            $cleanData['title'] = $title;
        }
        // $username = trim($_POST['username']); # check username is valid and not a duplicate
        // if (ctype_alnum($username) || (strlen($username) < 20) || (strlen($username) >= 5) && ) ) {
        //     $cleanData['username'] = $username;
        // }
        $password = trim($_POST['password']);
        if (!isset($errors['password']))  {
            $cleanData['password'] = $password;
        }
        $confirmPassword = trim($_POST['confirm-password']);
        if ($confirmPassword == $password ) { # i'm checking the password is the same as confirm password here
            $cleanData['confirm password'] = $confirmPassword;
        }
    }
    return $cleanData;
}
?>
