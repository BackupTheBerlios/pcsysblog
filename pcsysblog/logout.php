<?php
// session_start has to occur first
session_start();
include ("./includes/dbconnect.php");
include ("./includes/common.inc");
if(!isset($_REQUEST['logmeout'])){
include 'includes/header.inc';
	echo "<p>Are you sure you want to logout?</p>";
	echo "<p><a href='logout.php?logmeout'>Yes</a> | <a href='javascript:history.back()'>No</a></p>";
	include 'includes/footer.inc';
} else {
	session_destroy();
	if(!session_is_registered('first_name')){
		include 'includes/header.inc';
		echo "<p><strong>You are now logged out!</strong></p>";
		include 'login.html';
		include 'includes/footer.inc';
	}
}
?>
