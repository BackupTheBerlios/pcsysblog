<?php
// session_start has to occur first
session_start();
include './includes/dbconnect.php';
include './includes/common.inc';
// Convert to simple variables
$username = $_POST['username'];
$admin_passwd = $_POST['admin_passwd'];

if((!$username) || (!$admin_passwd)){
	include_once './includes/header.inc';
	echo "<p>Please enter ALL of the information!</p>";
	include_once './login.php';
	include_once './includes/footer.inc';
	exit();
}
// Convert password to md5 hash
$admin_passwd = md5($admin_passwd);
// check if the user info validates with the database
$sql = mysql_query("SELECT * FROM administrator WHERE username='$username' AND admin_passwd='$admin_passwd' AND activated='1'");
$login_check = mysql_num_rows($sql);
if($login_check > 0){
	while($row = mysql_fetch_array($sql)){
	foreach( $row AS $key => $val ){
		$$key = stripslashes( $val );
	}
		// Register some session variables!
		session_register('userid');
		$_SESSION['userid'] = $user_level;
		mysql_query("UPDATE administrators SET last_login=now() WHERE userid='$userid'");
      $url = "Location: post.php";
		header($url);
	}
} else {
	include_once './includes/common.inc';
	include_once './includes/header.inc';
	echo "<p><strong>You could not be logged in! Either the username and password do not match or you have not validated your account!</strong></p>
	<p><strong>Please try again!</strong></p>";
	include_once './login.php';
	include_once './includes/footer.inc';
}
?>
