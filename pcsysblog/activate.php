<?php
include 'includes/dbconnect.php';
include 'includes/common.inc';
// Create variables from URL.
$userid = $_REQUEST['id'];
$code = $_REQUEST['code'];
$sql = mysql_query("UPDATE users SET activated='1' WHERE userid='$userid' AND password='$code'");
$sql_doublecheck = mysql_query("SELECT * FROM users WHERE userid='$userid' AND password='$code' AND activated='1'");
$doublecheck = mysql_num_rows($sql_doublecheck);
if($doublecheck == 0){
include 'includes/header.inc';
	echo "<p><strong><font color=red>Your account could not be activated!</strong><br /> Please contact the webmaster</p>";
} elseif ($doublecheck > 0) {
include 'includes/header.inc';
	echo "<p><strong>Your account has been activated!</strong></p>";
	echo "<p>You may login below!</p>";
	include "login.html";
   include 'includes/footer.inc';
}
?>
