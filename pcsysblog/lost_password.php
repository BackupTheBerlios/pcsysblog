<?php
include ("./includes/dbconnect.php");
include ("./includes/common.inc");
switch($_POST['recover']){
	default:
	include ("$site_url/index.php?url=lostpassword");
	break;
	
	case "recover":
	recover_pw($_POST['email_address']);
	break;
}
function recover_pw($email_address){
	if(!$email_address){
		include './includes/common.inc';
		include 'includes/header.inc';
		echo "<p><strong>You forgot to enter your Email address</strong></p>";
		include 'lostpassword.html';
		include 'includes/footer.inc';
		exit();
	}
	// quick check to see if record exists	
	$sql_check = mysql_query("SELECT * FROM users WHERE email_address='$email_address'");
	$sql_check_num = mysql_num_rows($sql_check);
	if($sql_check_num == 0){
		include './includes/common.inc';
		include 'includes/header.inc';
		echo "<p><strong>No records found matching your email address</strong></p>";
		include 'lostpassword.html';
		include 'includes/footer.inc';
		exit();
	}
	// Everything looks ok, generate password, update it and send it!
	
	function makeRandomPassword() {
  		$salt = "abchefghjkmnpqrstuvwxyz0123456789";
  		srand((double)microtime()*1000000); 
	  	$i = 0;
	  	while ($i <= 7) {
	    		$num = rand() % 33;
	    		$tmp = substr($salt, $num, 1);
	    		$pass = $pass . $tmp;
	    		$i++;
	  	}
	  	return $pass;
	}

	$random_password = makeRandomPassword();

	$db_password = md5($random_password);
	
	$sql = mysql_query("UPDATE users SET password='$db_password' WHERE email_address='$email_address'");
	include ("./includes/common.inc");
	$subject = "Your Password at $site_name !";
	$message = "Your password has been reset.
	
	New Password: $random_password
	
	$site_url/login.html
	
	Thanks!
	$site_name
	
	This is an automated response, please do not reply!";
	
	mail($email_address, $subject, $message, "From: $site_name<$admin_email>\nX-Mailer: PHP/" . phpversion());
	include 'includes/header.inc';
	echo "<p><strong>Your password has been sent! Please check your email!</strong></p>";
	include 'login.html';
	include 'includes/footer.inc';
}
?>
