<?php

/*This block of code calls open directory and readirectory functions, if there are problems with filer/folder connection will be 'false' and
a message will be printed out. Othwerise connection will be 'true'. I check for a 'true' connection before I run validation code */
$connection = false;
$handleDir = openDirectory();
if($handleDir == false){
    echo '<p>The user data folder cannot be found</p>'.PHP_EOL;
}
else{
    $handle = readDirectory($handleDir);
    if ($handle == false){
        echo '<p>The user data file cannot be processed</p>'.PHP_EOL;
        closeDirectory($handleDir); # close directory
    }
    else{
        $connection = true;
    }
}
?>
