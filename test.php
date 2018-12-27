<?php

function validateInputs($self)
{


    $errors = array();
    $data = array();
    $errors_detected;
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        if ($username == $username) {
            $data['username'] = $username;
            $_SESSION['admin'] = $username;
        }
    }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        if ($password == $password) {
            $data['password'] = $password;
            $_SESSION['password'] = $password;
        }
    }
    return $data;
}



 ?>
