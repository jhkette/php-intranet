<?php
require_once('inlcudes/init.php');

include('inlcudes/menu.php');

if (isset($_SESSION['admin'])) {
    echo 'welcome' . $_SESSION['admin'];
}

 else {
    // Redirect them to the login page
    header("Location: admin-login.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Admin login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto+Slab');
    </style>
</head>
     <body>
         <div class ="container">
             <header class="col-md-6">
                 <h1>Admin login</h1>
             </header>
             <header class="col-md-6">
              </header>
          </div>
          <main class = "container">
              <section class="col-md-12">
                  <?php
                  echo makeMenu($menu);
                  ?>
              </section>
              <section class="col-md-12">
                  <?php

                  $self = htmlentities($_SERVER['PHP_SELF']);
                  $loggeddata = getData(openDirectory());
                  $duplicates = checkDuplicates($self, $loggeddata);
                  $errors = addUserErrors($self);
                  $confirmPassword = confirmPassword($self);
                  $data = validateAddUser($self, $errors, $duplicates);
                  $displayForm = true;


                  /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                  or redirects the user to welcome.php if no errors were detected */
                  if (isset($_POST['submit'])) {

                       #declare $self varaible as $_POST for use in validation
                       if ((sizeof($errors) == 0) && (sizeof($duplicates) == 0)  &&  (sizeof($confirmPassword) == 0)) {
                            $displayForm = false;
                         echo displayResults($data);
                         writeToFile(openDirectory());
                         refreshPageButton();
                     }

                       if ((sizeof($errors) > 0) || (sizeof($duplicates) > 0) || (sizeof($confirmPassword) > 0)) {


                          echo displayErrors($errors, $duplicates, $confirmPassword);

                       }

                   }

                   /* This code runs to make the form display. The data and errors array
                   are used as arguments to preserve correct data and dispay an error message above form if
                   needed   */
                   ?>
                   <?php if ($displayForm == true): ?>
                   <!--post to the same page  -->
                   <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  method="post">
                        <fieldset>
                            <legend>Add a user</legend>
                                       <div>
                                           <label for="">Title</label>
                                           <select name="title" id="title">
                                               <option value="Mr"  <?php if (isset($data['title']) &&  ($data['title']=="Mr")) {echo 'selected ="selected"';} ?>>Mr</option>
                                               <option value="Mrs" <?php if (isset($data['title']) &&  ($data['title']=="Mrs")) {echo 'selected ="selected"';} ?>>Mrs</option>
                                               <option value="Ms" <?php if (isset($data['title']) &&  ($data['title']=="Ms")) {echo 'selected ="selected"';} ?>>Ms</option>
                                           </select>
                                       </div>
                                       <div>
                                           <label for="">First name</label>
                                                  <?php if (htmlentities(isset($errors['firstname']))) {echo '<p> Please enter your name </p>';} ?>
                                                  <input type="text"  value= "<?php if (isset($data['firstname'])) {echo htmlentities($data['firstname']);} ?>" name="firstname" id="name" />
                                              </div>
                                              <div>
                                                  <label for="">Surname</label>
                                                  <?php if (htmlentities(isset($errors['surname']))) {echo '<p> Please enter your name </p>';} ?>
                                                  <input type="text"  value= "<?php if (isset($data['surname'])) {echo htmlentities($data['surname']);} ?>" name="surname" id="name" />
                                              </div>
                                              <div>
                                                  <label for="">Email</label>
                                                  <?php if (htmlentities(isset($duplicates['email']))) {echo '<p> This email has already been used</p>';} ?>
                                                  <?php if (htmlentities(isset($errors['email']))) {echo '<p> Please enter email </p>';} ?>
                                                 <input type="text"  value= "<?php if (isset($data['email'])) {echo htmlentities($data['email']);} ?>"  name="email" id="email"/>
                                              </div>
                                              <div>
                                                  <label for="">Username</label>
                                                  <?php if (htmlentities(isset($duplicates['username']))) {echo '<p> This username has already been used</p>';} ?>
                                                  <?php if (htmlentities(isset($errors['username']))) {echo '<p> Please enter your name </p>';} ?>
                                                  <input type="text"  value= "<?php if (isset($data['username'])) {echo htmlentities($data['username']);} ?>" name="username" id="name" />
                                              </div>
                                              <div>
                                                  <label for="">Password</label>
                                                   <?php if (isset($errors['password'])) {echo '<p> Please enter password </p>';} ?>
                                                   <input type="text"  value= "<?php if (isset($data['password'])) {echo htmlentities($data['password']);} ?>"  name="password" id="password"/>
                                              </div>
                                              <div>
                                                  <label for="">Confirm Password</label>
                                                  <?php if (htmlentities(isset($passwordError['confirm password']))) {echo '<p> The passwords do not match</p>';} ?>
                                                   <input type="text"  value= "<?php if (isset($data['confirm password'])) {echo htmlentities($data['confirm password']);} ?>"  name="confirm-password" id="confirm-password"/>
                                              </div>
                                              <div>
                                                  <input type="submit" name="submit" value="submitbutton" />
                                              </div>
                                          </fieldset>
                                      </form>
                            <?php endif; ?>

          </section>
      </main>
    </body>
 </html>
