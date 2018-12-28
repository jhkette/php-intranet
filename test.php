<?php

function addUserForm($displayForm, $data = array(), $errors=array())
{
    ?>
    <?php if ($displayForm == true): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
                           <fieldset>
                        <legend>Add a user</legend>
                        <div>
                            <label for="">Mail format</label>
                            <select name="title" id="title">
                                <?php if (isset($errors['title'])) {echo '<p> No value selected </p>';} ?>
                                <option value="Mr"  <?php if (isset($data['title']) &&  ($data['title']=="html")) {echo 'selected ="selected"';} ?>> HTML</option>
                                <option value="Mrs" <?php  if (isset($data['title']) &&  ($data['title']=="plain")) {echo 'selected ="selected"';} ?>> Plain text</option>
                            </select>
                        </div>
                               <div>
                                   <label for="">First name</label>
                                   <?php if (isset($errors['firstname'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['firstname'])) {echo htmlspecialchars($data['firstname']);} ?>" name="firstname" id="name" />
                               </div>
                               <div>
                                   <label for="">Surname</label>
                                   <?php if (isset($errors['surname'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['surname'])) {echo htmlspecialchars($data['surname']);} ?>" name="surname" id="name" />
                               </div>
                               <div>
                                   <label for="">Email</label>
                                   <?php if (isset($errors['email'])) {echo '<p> Please enter email </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['email'])) {echo htmlspecialchars($data['email']);} ?>"  name="email" id="email"/>
                               </div>
                               <div>
                                   <label for="">Username</label>
                                   <?php if (isset($errors['username'])) {echo '<p> Please enter your name </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['username'])) {echo htmlspecialchars($data['username']);} ?>" name="username" id="name" />
                               </div>
                               <div>
                                   <label for="">Password</label>
                                   <?php if (isset($errors['password'])) {echo '<p> Please enter password </p>';} ?>
                                   <input type="text"  value= "<?php if (isset($data['password'])) {echo htmlspecialchars($data['password']);} ?>"  name="password" id="password"/>
                               </div>
                               <div>
                                   <input type="submit" name="submit" value="submitbutton" />
                               </div>
                           </fieldset>
                       </form>
             <?php endif; ?>
    <?php
}

?>
