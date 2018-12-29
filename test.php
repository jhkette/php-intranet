<?php
function checkDuplicates($self, $loggeddata){
    $duplicates = array();
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        foreach ($loggeddata as $key => $value) {
            $loggeddata = explode('|', $value);
            $userPassword  =  $loggeddata[0];
            $userPassword = explode(',', $value);
            $userPassword[0] = trim($userPassword[0]);
            if ($userPassword[0] == $username){
                $userMatch = true;
            }
        }
        if ($userMatch == true){
         $duplicates['username'] = $username;
         }
         $emailMatch = array();
         $email = trim($_POST['email']);
         foreach ($loggeddata as $key => $value) {
             $loggeddata = explode('|', $value);
             $emailData  =  $loggeddata[1];
             $emailData = explode(',', $value);
             $emailData[3] = trim($email[3]);
             if ($emailData[3] == $email){
                 $emailMatch = true;
             }
         }
         $duplicates['email'] = $email;

}
?>
