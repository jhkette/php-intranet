<?php



function bothFieldsValid($self, $loggeddata){
    $valid = false;
    if (isset($_POST['username']) && (isset($_POST['password']))) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        foreach ($loggeddata as $key => $value) {
            $loggeddata = explode(',', $value);
            if(($loggeddata[0] ==  $username) && ($loggeddata[1] == $password)){
                $valid = true;
            }



        }



}
return $valid;
}

function validateLoginInputs($self, $loggeddata)
{


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
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        foreach ($loggeddata as $key => $value) {
           $loggedPassword = explode(',', $value);
           $loggedPassword = trim($loggedPassword[1]);
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
    $correctdata = array();
    $correctdata2 = array();
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
     if(count($correctdata)== 0){
         $errors['username'] = 'Full name is not valid';
     }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        foreach ($loggeddata as $key => $value) {
           $loggedPassword = explode(',', $value);
           $loggedPassword = trim($loggedPassword[1]);
           if ($password == $loggedPassword ) {
             array_push($correctdata2, $password);
            }
        }
        if(count($correctdata2)== 0){
            $errors['password'] = 'password name is not valid';
        }
    }
    return $errors;
}
}


 ?>
