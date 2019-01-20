<?php require_once('includes/init.php');
if (!isset($_SESSION['admin'])) {  # check that the user is an admin else redirect
    header("Location: admin-login.php?message2=Please log in as an admin");
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add user</title>
        <link rel="stylesheet" href="css/styles.css">
        <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab');
        </style>
    </head>
    <body>
        <div class ="header-container">
             <?php include('includes/header.php')?>
        </div>
        <div class="grey">
            <div class="main-container">
                <?php include('includes/navigation.php'); ?>
                 <main class = "container">
                      <section class="col-1">
                          <h2>Add a user</h2>
                          <?php
                          /* Here I am initially presenting the form. When the user submits, I check the valididation functions  return values after the form is submitted.
                          If there are no errors the form is hidden and the user is added, a confirmation message is presnted to user.
                          If there are errors, I add error messages above the form and display prompts by the form fields.   */
                          $self = $_SERVER['PHP_SELF'];
                          $errors = array();
                          $cleanData = array();
                          $duplicates  = array();
                          $confirmPassword = array();
                         #clean data checked against the other arrays it takes as parameters
                          $displayForm = true;
                          /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                          or adds another user and hides form if no errors are detected.  */
                          if (isset($_POST['submit'])) {
                              include('includes/connection.php');
                              if($connection == true){


                                  $loggeddata = getData($handle); # the data from the txt file in an array
                                  $duplicates = checkDuplicates($self, $loggeddata); # duplicates array
                                  $errors = addUserErrors($self); #errors array
                                  $confirmPassword = confirmPassword($self, $errors); # cofirm password array
                                  $cleanData = validateAddUser($self, $errors, $duplicates, $confirmPassword);

                                  if ((count($errors) == 0) && (count($duplicates) == 0)  &&  (count($confirmPassword) == 0)) {
                                      $displayForm = false;
                                      echo '<p class="newuser">New user successfully added</p>'; #message to confirm the user has been added
                                      echo displayResults($cleanData); #display the correct data to confirm the new user details
                                      writeToFile($handle ,$cleanData); # write to the text file
                                      echo refreshPageButton(); # add a button which allows the user to refresh page and add another user.
                                      closeHandle($handle); # close handle
                                      closeDirectory($handleDir); # close directory
                                  }
                                   /* If there are errors show the errors.   */
                                   if ((count($errors) > 0) || (count($duplicates) > 0) || (count($confirmPassword) > 0)) {
                                       echo displayErrors($errors, $duplicates, $confirmPassword);
                                       closeHandle($handle);
                                       closeDirectory($handleDir);
                                   }
                               }

                          }
                          ?>
                          <!--  This code runs to make the form display. The data and errors array
                          are used as to preserve correct data and dispay an error message above the relevant form field if
                          needed. If the displayform variable is true the form is shown. I'm putting the html form directly into the add-user template here as I feel it is more practical
                          to do so, rather than returning a very long concatenated string. In addition it allows me to write if statements in the form itself, rather than in a very long list
                          in a function.
                          -->
                          <?php if ($displayForm == true): ?>
                              <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                  <fieldset>
                                      <div class="field">
                                          <label for="title">Title</label>
                                          <select name="title" id="title">
                                              <!-- Save title value using cleanData -->
                                              <option value="Mr" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Mr" )) {echo 'selected ="selected"' ;} ?>>Mr</option>
                                              <option value="Mrs" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Mrs" )) {echo 'selected ="selected"' ;} ?>>Mrs</option>
                                              <option value="Ms" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Ms" )) {echo 'selected ="selected"' ;} ?>>Ms</option>
                                              <option value="Miss" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Miss" )) {echo 'selected ="selected"' ;} ?>>Miss</option>
                                          </select>
                                      </div>
                                      <div class="field">
                                          <div class="adduserforminput">
                                              <label for="first-name">First name</label>
                                              <input type="text" value="<?php if (isset($cleanData['firstname'])) {echo htmlentities($cleanData['firstname']);} ?>" name="firstname" id="first-name" />
                                          </div>
                                          <!--echo error message if firstname error is set  -->
                                          <?php if (isset($errors['firstname'])) {echo '<p> Please enter your first name </p>';} ?>
                                      </div>
                                      <div class="field">
                                          <div class="adduserforminput">
                                              <label for="surname">Surname</label>
                                              <input type="text" value="<?php if (isset($cleanData['surname'])) {echo htmlentities($cleanData['surname']);} ?>" name="surname" id="surname" />
                                          </div>
                                          <?php if (isset($errors['surname'])) {echo '<p> Please enter your Surname </p>';} ?>

                                      </div>
                                      <div class="field">
                                          <div class="adduserforminput">
                                              <label for="email">Email</label>
                                              <input type="text" value="<?php if (isset($cleanData['email'])) {echo htmlentities($cleanData['email']);} ?>" name="email" id="email" />
                                          </div>
                                          <?php if (isset($duplicates['email'])) {echo '<p> This email has already been used</p>';} ?>
                                          <?php if (isset($errors['email'])) {echo '<p> Please enter a valid email </p>';} ?>
                                      </div>
                                      <div class="field">
                                          <div class="adduserforminput">
                                              <label for="username">Username</label>
                                              <input type="text" value="<?php if (isset($cleanData['username'])) {echo htmlentities($cleanData['username']);} ?>" name="username" id="username" />
                                          </div>
                                          <?php if (isset($duplicates['username'])) {echo '<p> This username has already been used</p>';} ?>
                                          <?php if (isset($errors['username'])) {echo '<p> Please enter a valid username</p>';} ?>
                                      </div>
                                      <div class="field">
                                          <div class="adduserforminput">
                                              <label for="password">Password</label>
                                              <input type="password" value="<?php if (isset($cleanData['password'])) {echo htmlentities($cleanData['password']);} ?>" name="password" id="password" />
                                          </div>
                                          <?php if (isset($errors['password'])) {echo '<p> Please enter a valid password </p>';} ?>
                                      </div>
                                      <div class="field">
                                          <div class="adduserforminput">
                                              <label for="confirm-password">Confirm password</label>
                                              <!--only have confirm password comment if the initial password is correct  -->
                                              <input type="password" value="<?php if (isset($cleanData['confirm password'])) {echo htmlentities($cleanData['confirm password']);} ?>" name="confirm-password" id="confirm-password" />
                                          </div>
                                          <?php if (isset($confirmPassword['confirm password']) && (!isset($errors['password']))) {echo '<p> The passwords do not match</p>';} ?>
                                      </div>
                                      <div class="field">
                                          <input type="submit" name="submit" value="Submit" />
                                      </div>
                                  </fieldset>
                              </form>
                          <?php endif; ?>
                      </section>
                  </main>
              </div>
          </div>
          <div class ="footer-container">
               <?php include('includes/footer.php')?>
          </div>
      </body>
</html>
<!--Joseph Ketterer
Jkette01
Web Programming with PHP
Tobi Brodie -->
