<?php
// session_start has to occur first
session_start();  // Start Session
include ("./includes/dbconnect.php");
include ("./includes/common.inc");
// Convert to simple variables
$username = $_POST['username'];
$password = $_POST['password'];

if((!$username) || (!$password)){
	include 'includes/header.inc';
	echo "<p>Please enter ALL of the information!</p>";
	include 'login.html';
	include 'includes/footer.inc';
	exit();
}
// Convert password to md5 hash
$password = md5($password);
// check if the user info validates with the database
$sql = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password' AND activated='1'");
$login_check = mysql_num_rows($sql);
if($login_check > 0){
	while($row = mysql_fetch_array($sql)){
	foreach( $row AS $key => $val ){
		$$key = stripslashes( $val );
	}
		// Register some session variables!
		session_register('first_name');
		$_SESSION['first_name'] = $first_name;
		session_register('username');
		$_SESSION['username'] = $username;
		session_register('last_name');
		$_SESSION['last_name'] = $last_name;
		session_register('email_address');
		$_SESSION['email_address'] = $email_address;
		session_register('special_user');
		$_SESSION['user_level'] = $user_level;
		mysql_query("UPDATE users SET last_login=now() WHERE userid='$userid'");
		header("Location: login_success.php");
	}
} else {
	include './includes/common.inc';
	include 'includes/header.inc';
	echo "<p><strong>You could not be logged in! Either the username and password do not match or you have not validated your membership!</strong></p>
	<p><strong>Please try again!</strong></p>";
	include 'login.html';
	include 'includes/footer.inc';
}
?>
