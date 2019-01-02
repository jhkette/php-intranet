<?php
require_once('inlcudes/init.php');

include('inlcudes/menu.php');


if (isset( $_SESSION['admin'])|| (isset( $_SESSION['user']))) {

     echo 'You are logged in as' . (isset( $_SESSION['admin']) ? htmlentities($_SESSION['admin']) :  htmlentities($_SESSION['user']));
}

 else {
    // Redirect them to the login page
    header("Location: login.php?message=please log in");
}

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Web Programming using PHP - P1 Results</title>
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
        <section class="col-md-12">

            <?php
            print makeMenu($menu);
            ?>
        </section>
		<h1>Web Programming using PHP - P1 Results</h1>
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
	</body>
</html>
