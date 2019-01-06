<?php require_once('inlcudes/init.php');

$adminState = false;
if (isset( $_SESSION['admin'])) {
    $adminState = true;
}
else{
    /* Redirect them to the admin login page. I am an adding an error message if not logged in as admin althought it
    is not accessible from the menu */
    header("Location: admin-login.php?message2=Only an admin can add a user. Please log in as an admin");
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
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
</head>
     <body>
         <div class ="header-container">
             <?php include('inlcudes/header.php')?>
         </div>
         <div class="grey">
             <div class="main-container">
                 <div class ="navcontainer">
                     <nav class="main-menu">
                         <?php
                         echo makeMenu($menu);
                         ?>
                     </nav>
                     <div class="status">
                         <?php
                          if ($adminState == true) {
                              echo '<p>You are logged in as ' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user'] .PHP_EOL));
                          }
                          ?>
                      </div>
                  </div>
                  <main class = "container">
                      <section class="col-1">


                          <h2>Admin login</h2>
                          <?php
                          /* Here I am initially presenting the form. When the user submits, I check the valididation functions on
                          the index page. If there are no errors the form is hidden and the user is added, a confirmation message is presnted to user.
                          If there are errors, I add error messages above the form and display prompts by the form fields. This data again comes from the validation functions.  */
                          $self = $_SERVER['PHP_SELF'];
                          $handleDir = openDirectory(); # directory
                          $handle = readDirectory($handleDir); # handle to file
                          $loggeddata = getData($handle); # the data from the txt file in an array
                          $duplicates = checkDuplicates($self, $loggeddata); # duplicates array
                          $errors = addUserErrors($self); #errors array
                          $confirmPassword = confirmPassword($self); # cofirm password array
                          $cleanData = validateAddUser($self, $errors, $duplicates, $confirmPassword); #clean data checked against the other arrays it takes as parameters
                          $displayForm = true;
                          /* This block of code ONLY runs if the form has been submitted. It shows the errors above the form
                          or add another user and hides form if no errors are detected.  */
                          if (isset($_POST['submit'])) {
                              #declare $self varaible as $_POST for use in validation
                              if ((count($errors) == 0) && (count($duplicates) == 0)  &&  (count($confirmPassword) == 0)) {
                                  $displayForm = false;
                                  echo '<h3>New user successfully added</h3>'; #message to confirm the user has been added
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
                                      <legend>Add a user</legend>
                                      <div>
                                          <label for="title">Title</label>
                                          <select name="title" id="title">
                                              <option value="Mr" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Mr" )) {echo 'selected ="selected"' ;} ?>>Mr</option>
                                              <option value="Mrs" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Mrs" )) {echo 'selected ="selected"' ;} ?>>Mrs</option>
                                              <option value="Ms" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Ms" )) {echo 'selected ="selected"' ;} ?>>Ms</option>
                                              <option value="Miss" <?php if (isset($cleanData['title']) && ($cleanData['title']=="Miss" )) {echo 'selected ="selected"' ;} ?>>Miss</option>
                                          </select>
                                      </div>
                                      <div>
                                          <label for="first-name">First name</label>
                                          <?php if (htmlentities(isset($errors['firstname']))) {echo '<p> Please enter your first name </p>';} ?>
                                          <input type="text" value="<?php if (isset($cleanData['firstname'])) {echo htmlentities($cleanData['firstname']);} ?>" name="firstname" id="first-name" />
                                      </div>
                                      <div>
                                          <label for="surname">Surname</label>
                                          <?php if (htmlentities(isset($errors['surname']))) {echo '<p> Please enter your Surname </p>';} ?>
                                          <input type="text" value="<?php if (isset($cleanData['surname'])) {echo htmlentities($cleanData['surname']);} ?>" name="surname" id="surname" />
                                      </div>
                                      <div>
                                          <label for="email">Email</label>
                                          <?php if (htmlentities(isset($duplicates['email']))) {echo '<p> This email has already been used</p>';} ?>
                                          <?php if (htmlentities(isset($errors['email']))) {echo '<p> Please enter a valid email </p>';} ?>
                                          <input type="text" value="<?php if (isset($cleanData['email'])) {echo htmlentities($cleanData['email']);} ?>" name="email" id="email" />
                                      </div>
                                      <div>
                                          <label for="username">Username</label>
                                          <?php if (htmlentities(isset($duplicates['username']))) {echo '<p> This username has already been used</p>';} ?>
                                          <?php if (htmlentities(isset($errors['username']))) {echo '<p> Please enter a valid username</p>';} ?>
                                          <input type="text" value="<?php if (isset($cleanData['username'])) {echo htmlentities($cleanData['username']);} ?>" name="username" id="username" />
                                      </div>
                                      <div>
                                          <label for="password">Password</label>
                                          <?php if (isset($errors['password'])) {echo '<p> Please enter a valid password </p>';} ?>
                                          <input type="password" value="<?php if (isset($cleanData['password'])) {echo htmlentities($cleanData['password']);} ?>" name="password" id="password" />
                                      </div>
                                      <div>
                                          <label for="confirm-password">Confirm password</label>
                                          <?php if (htmlentities(isset($confirmPassword['confirm password']))) {echo '<p> The passwords do not match</p>';} ?>
                                          <input type="password" value="<?php if (isset($cleanData['confirm password'])) {echo htmlentities($cleanData['confirm password']);} ?>" name="confirm-password" id="confirm-password" />
                                      </div>
                                      <div>
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
               <?php include('inlcudes/footer.php')?>
          </div>
      </body>
</html>
<!--Joseph Ketterer
Jkette01
Web Programming with PHP
Tobi Brodie -->
