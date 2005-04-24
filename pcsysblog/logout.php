<?php
// session_start has to occur first
session_start();
if(!isset($_REQUEST['logmeout'])){
include_once './includes/header.inc';
	echo "<p>Are you sure you want to logout?</p>";
	echo "<p><a href='logout.php?logmeout'>Yes</a> | <a href='javascript:history.back()'>No</a></p>";
	include_once './includes/footer.inc';
} else {
	session_unset ();
	session_destroy();
	if(!session_is_registered('userid')){
// Let's thank the user and send them back to the blog
echo '<head>';
echo '<META HTTP-EQUIV="Refresh" CONTENT="5;URL=./index.php">';
echo '</head>';
include 'includes/common.inc';
include_once 'includes/header.inc';
echo "<p><strong>You are now logged out!</strong></p>";
echo "<p>Please wait while we return you to the '$site_name' Homepage.</p>";
include_once 'includes/footer.inc';
	}
}
?>
