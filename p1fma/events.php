<?php require_once('includes/init.php');?>
<?php include('includes/secure.php');?>
<!doctype html>
<html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Events</title>
         <link rel="stylesheet" type="text/css" href="css/styles.css" />
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
                          <div class ="flex-container">
                              <?php include('includes/sidemenu.php'); ?>
                              <div class="main-body">
                                  <h2>Events</h2>
                                  <div class="news"><?php include('includes/lorum.php');?></div>
                                  <div class="news"><?php include('includes/lorum.php');?></div>
                                  <div class="news"><?php include('includes/lorum.php');?></div>
                                  <div class="line"> </div>
                              </div>
                          </div>
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
