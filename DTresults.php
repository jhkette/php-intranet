<!--Joseph Ketterer
Jkette01
Web Programming with PHP
Tobi Brodie -->

<?php
require_once('inlcudes/init.php');

$loggedState = false;
if (isset( $_SESSION['admin']) || (isset( $_SESSION['user']))) {

    $loggedState = true;
}

 else {
    // Redirect them to the login page
    header("Location: login.php?message=please log in");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head><link rel="stylesheet" href="/css/style.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
    <meta charset="utf-8">
	<title>Introduction to Database Technology - DT Results</title>
</head>
    <body>
        <div class ="header-container">
            <header class="col-md-6">
                <?php include 'inlcudes/header.php';?>
            </header>
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
                        if ($loggedState == true) {
                            echo '<p>You are logged in as ' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user'] .PHP_EOL));
                        }
                        ?>
                    </div>
                </div>
                <main class = "container">
                     <section class="col-1">
                         <div class ="flex-container">
                             <nav class="side-menu">
                                 <?php
                                 echo makeMenu($menu2);
                                 ?>
                             </nav>
                             <div class= "main-body">
                                 <h3>Introduction to Database Technology - DT Results</h3>
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
                         			<td>60</td>
                         			<td>40</td>
                         			<td>7</td>
                         			<td>3</td>
                         			<td>10</td>
                         		  </tr>
                         		  <tr>
                         			<td>2013/14</td>
                         			<td>45</td>
                         			<td>25</td>
                         			<td>5</td>
                         			<td>15</td>
                         			<td>0</td>
                         		  </tr>
                         		  <tr>
                         			<td>2014/15</td>
                         			<td>50</td>
                         			<td>35</td>
                         			<td>3</td>
                         			<td>7</td>
                         			<td>5</td>
                         		  </tr>
                         		  <tr>
                         			<td>2015/16</td>
                         			<td>48</td>
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
	</body>
</html>
