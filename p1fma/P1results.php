<?php require_once('includes/init.php');?>
<?php include('includes/secure.php');?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab');
        </style>
        <title>Web Programming using PHP - P1 Results</title>
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
                             <div class= "main-body">
                                 <h3>Web Programming using PHP - P1 Results</h3>
                                 <table>
                                   <tr>
                                     <th>Year</th>
                                     <th>Students</th>
                                     <th>Pass</th>
                                     <th>Fail (no resit)</th>
                                     <th>Resit</th>
                                     <th>Withdrawn</th>
                                   </tr>
                                   <tr>
                                     <td>2012/13</td>
                                     <td>50</td>
                                     <td>30</td>
                                     <td>5</td>
                                     <td>5</td>
                                     <td>10</td>
                                   </tr>
                                   <tr>
                                     <td>2013/14</td>
                                     <td>60</td>
                                     <td>35</td>
                                     <td>5</td>
                                     <td>12</td>
                                     <td>8</td>
                                   </tr>
                                   <tr>
                                     <td>2014/15</td>
                                     <td>45</td>
                                     <td>20</td>
                                     <td>3</td>
                                     <td>7</td>
                                     <td>15</td>
                                   </tr>
                                   <tr>
                                     <td>2015/16</td>
                                     <td>40</td>
                                     <td>25</td>
                                     <td>3</td>
                                     <td>5</td>
                                     <td>7</td>
                                   </tr>
                                 </table>
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
