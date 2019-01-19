<?php session_start();
/* nb I'm refreshing the page each time the page loads. I was having problems with cached pages displaying old
session data on the BBK titan server. If it were deployed it would probably be best just to reconfigure server settings */
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
require_once('functions.php');
include('includes/menu.php');

 ?>
