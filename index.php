<?php
require_once('inlcudes/init.php');

include('inlcudes/menu.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<head>
    <title>Home</title>
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
                 <h1>Home</h1>
             </header>
             <header class="col-md-6">
              </header>
          </div>
          <main class = "container">
              <section class="col-md-12">
                  <?php
                  print makeMenu($menu);
                  ?>
                  <?php
                 if(isset($_GET['message'])) {
                     echo $_GET['message'];
                 }
                  ?>
              </section>
              <section class="col-md-12">

              </section>

          </main>
        </body>
    </html>
