<?php
if (!isset( $_SESSION['admin']) && (!isset( $_SESSION['user']))) {
    header("Location: login.php?message2=Please log in");
}
/* I include this short piece of code on all the files that needs to be secure (except the add user file which is a special case) */
?>
