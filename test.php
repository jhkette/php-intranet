<?php

function validateLoginInputs($self, $loggeddata)
{


    $errors = array();
    $data = array();
    $errors_detected;
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
         foreach ($loggedNames => $value) {
            $loggedUsername = explode(',', $value);
            $loggedUsername = $loggedUsername[0];
            if ($username == $loggedUsername ) {
                $data['username'] = $username;
                $_SESSION['admin'] = $username;
             }
         }
     }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        foreach ($loggedNames => $value) {
           $loggedPassword = explode(',', $value);
           $loggedPassword = $loggedPassword[1];
           if ($password == $loggedPassword ) {
               $data['password'] = $password;
               $_SESSION['password'] = $password;
            }
        }
    }
    return $data;
}


function validateLoginErrors($self, $loggeddata)
{
    $adminusername = 'admin';
    $adminpassword = 'DCSadmin01';
    $errors = array();
    $data = array();
    $data2 = array();
    $errors_detected;
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
         foreach ($loggedNames => $value) {
            $loggedUsername = explode(',', $value);
            $loggedUsername = $loggedUsername[0];
            if($username == $loggedUsername){
            array_push($data, $loggedUsername)
         }
     }
     if(count($data)== 0){
         $errors['username'] = 'Full name is not valid';
     }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        foreach ($loggedNames => $value) {
           $loggedPassword = explode(',', $value);
           $loggedPassword = $loggedPassword[1];
           if ($password == $loggedPassword ) {
             array_push($data2, $password)
            }
        }
        if(count($data)== 0){
            $errors['password'] = 'password name is not valid';
        }
    }
    return $errors;
}



 ?>
