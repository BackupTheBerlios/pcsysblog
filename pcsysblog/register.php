<?php
include ("./includes/dbconnect.php");
include ("./includes/common.inc");
// Define post fields into simple variables
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$username = $_POST['username'];
$info = $_POST['info'];
/* Let's strip some slashes in case the user entered
any escaped characters. */
$first_name = stripslashes($first_name);
$last_name = stripslashes($last_name);
$email_address = stripslashes($email_address);
$username = stripslashes($username);
$info = stripslashes($info);
/* Do some error checking on the form posted fields */
include "includes/header.inc";
if((!$first_name) || (!$last_name) || (!$email_address) || (!$username)){
    echo '<p><strong>You did not submit the following required information!</strong></p>';
    if(!$first_name){
        echo "<p>First Name is a required field. Please enter it below.<br />";
    }
    if(!$last_name){
        echo "Last Name is a required field. Please enter it below.<br />";
    }
    if(!$email_address){
        echo "Email Address is a required field. Please enter it below.<br />";
    }
    if(!$username){
        echo "Desired Username is a required field. Please enter it below.</p>";
    }
    include "register.html"; // Show the form again!
    include "includes/footer.inc";
    /* End the error checking and if everything is ok, we'll move on to
     creating the user account */
    exit(); // if the error checking has failed, we'll exit the script!
}
/* Let's do some checking and ensure that the user's email address or username
does not exist in the database */
$sql_email_check = mysql_query("SELECT email_address FROM users
            WHERE email_address='$email_address'");
$sql_username_check = mysql_query("SELECT username FROM users
            WHERE username='$username'");
$email_check = mysql_num_rows($sql_email_check);
$username_check = mysql_num_rows($sql_username_check);
if(($email_check > 0) || ($username_check > 0)){
    echo "<p><strong>Please fix the following errors:</strong></p>";
    if($email_check > 0){
        echo "<p>Your email address has already been used by another member
        in our database. Please submit a different Email address!<br />";
        unset($email_address);
    }
    if($username_check > 0){
        echo "The username you have selected has already been used by another member
         in our database. Please choose a different Username!</p>";
        unset($username);
    }
	 include "register.html"; // Show the form again!
    include "includes/footer.inc";
    exit();  // exit the script so that we do not create this account!
}

/* Everything has passed both error checks that we have done.
It's time to create the account! */
/* Random Password generator.
http://www.phpfreaks.com/quickcode/Random_Password_Generator/56.php
We'll generate a random password for the
user and encrypt it, email it and then enter it into the db.
*/
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
// Enter info into the Database.
$info2 = htmlspecialchars($info);
$sql = mysql_query("INSERT INTO users (first_name, last_name,
        email_address, username, password, info, signup_date)
        VALUES('$first_name', '$last_name', '$email_address',
        '$username', '$db_password', '$info2', now())")
        or die (mysql_error());
if(!$sql){
    echo 'There has been an error creating your account. Please contact the webmaster.';
} else {
    $userid = mysql_insert_id();
    // Let's mail the user!
    $subject = "Your Membership at $site_name";
    $message = "Dear $first_name $last_name,
    Thank you for registering at $site_name, $site_url!
    
    You are two steps away from logging in and accessing $site_url.
    
    To activate your membership,
    please click here: $site_url/activate.php?id=$userid&code=$db_password
    
    Once you activate your memebership, you will be able to login
    with the following information:
    Username: $username
    Password: $random_password
    
    Thanks!
    $site_name
    
    This is an automated response, please do not reply!";
    
    mail($email_address, $subject, $message,
        "From: $site_name<$admin_email>\n
        X-Mailer: PHP/" . phpversion());
    echo "<p><strong>Thank you for registering with $site_name</strong></p>";
    echo '<p>Your membership information has been mailed to your email address!<br />
    Please check it and follow the directions!</p>';
    include "includes/footer.inc";
}
?>
