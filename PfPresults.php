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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="/css/style.css">
<style>
@import url('https://fonts.googleapis.com/css?family=Roboto');
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Problem Solving for Programming – PfP Results</title>
		<style>
			table {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 50%;
			}

			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 5px;
			}

			tr:nth-child(even) {
				background-color: #dddddd;
			}
		</style>
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
	</div>
</div>
    </section>
    </main>
</div>
</div>

	</body>
</html>
