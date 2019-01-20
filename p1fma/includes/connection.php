<?php
$connection = false;
$handleDir = openDirectory();
if($handleDir == false){
    echo '<p>The user data folder cannot be found</p>';
}
else{
    $handle = readDirectory($handleDir);
    if ($handle == false){
        echo '<p>The user data file cannot be processed</p>';
        closeDirectory($handleDir); # close directory
    }
    else{
        $connection = true;
    }
}
?>
