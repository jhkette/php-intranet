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
	<title>Problem Solving for Programming – PfP Results</title>
</head>
    <body>
        <div class ="header-container">
            <?php include('includes/header.php')?>
        </div>
        <div class="grey">
            <div class="main-container">
                <?php include('includes/navigation.php'); ?>
                <main class = "container">
                     <div class="col-1">
                         <div class ="flex-container">
                             <?php include('includes/sidemenu.php'); ?>
                             <section class= "main-body">
                                 <h3>Problem Solving for Programming – PfP Results</h3>
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
                                     <td>65</td>
                                     <td>45</td>
                                     <td>7</td>
                                     <td>3</td>
                                     <td>10</td>
                                   </tr>
                                   <tr>
                                     <td>2013/14</td>
                                     <td>55</td>
                                     <td>35</td>
                                     <td>5</td>
                                     <td>15</td>
                                     <td>0</td>
                                   </tr>
                                   <tr>
                                     <td>2014/15</td>
                                     <td>60</td>
                                     <td>45</td>
                                     <td>2</td>
                                     <td>10</td>
                                     <td>3</td>
                                   </tr>
                                   <tr>
                                     <td>2015/16</td>
                                     <td>38</td>
                                     <td>30</td>
                                     <td>8</td>
                                     <td>3</td>
                                     <td>7</td>
                                   </tr>
                                 </table>
                             </section>
                         </div>
                     </div>
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
