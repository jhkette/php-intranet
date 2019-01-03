<?php
require_once('inlcudes/init.php');




if (isset( $_SESSION['admin'])|| (isset( $_SESSION['user']))) {

     echo 'You are logged in as ' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user']));
}


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<head>
    <title>Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="./css/style.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
</head>
     <body>
         <div class ="container">
             <header class="col-md-6">

             </header>
             <nav class="col-md-6">
                 <?php
                 echo makeMenu($menu);
                 ?>
                 <?php
                 if (isset($_GET['message'])) {
                    echo $_GET['message'];
                }
                ?>
            </nav>
          </div>
          <main class = "container">
               <h1>Home</h1>
              <section class="col-md-12">

              </section>
              <section class="col-md-12">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at ipsum lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dapibus facilisis tortor, eu suscipit dolor cursus eu. Fusce vitae tortor est. Aenean volutpat dui eu ex iaculis vestibulum. Maecenas semper imperdiet nibh. Donec at volutpat lectus, quis faucibus nulla. Vivamus eros sapien, ultricies vitae dignissim sed, posuere eget erat. Donec bibendum nunc quis leo mattis, nec suscipit velit tincidunt. Donec a sapien id leo interdum mollis ut vel lectus. In non luctus orci. In tempor id eros eget rutrum.</p>
                  <p>Nam nisl eros, pharetra nec vehicula efficitur, elementum in tortor. Pellentesque non convallis lectus. Sed nisi lorem, tristique sit amet
                  est ut, viverra varius diam. Morbi sodales lobortis blandit. Phasellus et rhoncus neque. Morbi feugiat, ipsum non posuere</p>
                  <p>Aliquam sit amet aliquam magna. Vivamus ac sapien interdum, dapibus urna sed, pellentesque ante. Nulla ultrices finibus nisi,
                  eget efficitur felis sodales non. Quisque eu dui ut felis euismod venenatis. Praesent at ante vitae nunc pharetra fringilla. Etiam
                  lacus justo, congue et justo vel, elementum malesuada odio. Quisque bibendum, augue nec placerat vestibulum, arcu purus pretium ligula,
                  sed molestie ligula eros vitae nibh. </p>
              </section>
          </main>
      </body>
</html>
