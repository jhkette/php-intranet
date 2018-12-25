<?php

// sessions are stored in a key by the cookie on the client - rest is stored on the server

// so are far more contol - the user has no control.

// stored in a cookie or in a url - typically now not in the url. Too insecure
// needs to be at the top of the page - ON EVERY PAGE
session_start();

// use init.php require_once
// this would have all the main stuff needed on each page. ie session_start, $websitename

// session start looks for a cookie superglobal - initialises data, if not creates a new session ID.

//


if(isset $_session[name]){
    $loggedinstate = true;
}

else{
    $loggedinstate = false;
}

// make sure you delete data in array when you destroy session and change logginstate back to false
// FILTER EXTERNAL INFO
// assume the data is invalid unless you can proove otherwise
// don't call password file password
// php file to read and write data not a TEXT FILE.
// store it in a file that is not publically accesible - that IS NOT IN THE ROOT
// COULD USE ENCRYPTION METHODS for passwords
// add a file to make HTTPS as opposed to HTTP (mb not for FMA)



/* USERNAME AND PASSWORD ARE KEY

So maybe put them at th beggining
Think about how to seperate this data
THINK ABOUT HOW YOU SEPERATE DATA,



MAYBE DON"T ALLOW DELIMITERS,

WHAT HAPPENS IF TWO Tutors enter the same name.

NOTE DOWN ANY PROBLEMS YOU have

MAKE SURE TO SHOW ERRORS IN FORM DISPLAY - this is for when adding tutors

// make sure to show a logged in message + maybe add another tutor



// make sure the results are php files - they need session start
// you need header, menu, footer, login page in INCLUDE

// should also include login/logout links

results will be an if statement -if loggined in show results if not loginpage

if loggined include 'inlcude results';

else{
include - polite message

}
include footer.php

declare the title of the page as a variable then put that in the include
this could be in the header.php

create a file that is logoff.php that destroys sessions and returns user to index page.

admin should be the username,

can create a couple of users if you want. put them in documentation
// use relative PATHS OBVIOUSLY

index.php?message = logged out

this end up in GET array thats the key and thats the value.

if (isset ($get['message'])){
sanitize date ,

need to add a conditional to check it is the right message (ie - it is = to logged off)
$get =['message']

sometimes don't need to assign index to new variables
}

*/



 ?>
