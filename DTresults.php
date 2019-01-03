<?php
require_once('inlcudes/init.php');





if (isset( $_SESSION['admin'] )  || (isset( $_SESSION['user'] )   )) {

    // echo 'welcome' . $_SESSION['admin'];
}

 else {
    // Redirect them to the login page
    header("Location: login.php?message=please log in");
}
?>
<!doctype html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="./css/style.css">
<style>
@import url('https://fonts.googleapis.com/css?family=Roboto');
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Introduction to Database Technology - DT Results</title>
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
        <div class="main-container">
        <header class="col-md-6">

        </header>
        <nav class="col-md-12">
            <?php
           echo makeMenu($menu);
            ?>
            <?php
           if (isset($_GET['message'])) {
               echo $_GET['message'];
           }
            ?>
         </nav>


     <main class = "container">


         <section class="col-md-12">
		<h1>Introduction to Database Technology - DT Results</h1>
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
    </main>
</div>
	</body>
</html>
