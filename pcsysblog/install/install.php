<?php
// Modify $dbhost, $dbusername, $dbuserpass, $dbname to match your site
$db_host='localhost';
$db_username='';
$db_userpasswd='';
$db_name='pcsysblog';
//
// Do not edit below!!
//
?>
<html>
<head>
<meta content="text/html; charset=utf-8"
http-equiv="content-type" />
<meta content="blog system" name="description" />
<title>PCSysBlog Installation</title>
<link rel="stylesheet" type="text/css" href="../includes/pcsysblog.css" />
</head>
<body>
<a href="http://pcsysblog.berlios.de"><img src="../images/logo.png" title="PCSysBlog" alt="logo.png" style="border: 0px solid ;" /></a>
<hr size="4" color="#FFA500" align="center" />
<?php
// Begin the installation script
//
// Define post fields into simple variables
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$username = $_POST['username'];
$admin_passwd = $_POST['admin_passwd'];
// Let's strip slashes in case the user entered any escaped characters.
$first_name = stripslashes($first_name);
$last_name = stripslashes($last_name);
$email_address = stripslashes($email_address);
$username = stripslashes($username);
// Lets do some error checking
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
    include "index.php"; // Show the form again!
    exit(); // if the error checking has failed, we'll exit the script!
}
// Create the database
$link_id = mysql_connect ($db_host, $db_username, $db_userpasswd);
echo "<p><img src='../images/success.png' width='12' height='12' border='0' name='success.png' alt='Success'>&nbsp;&nbsp;Successfully connected to MySQL server.</p>";

if (!mysql_query("CREATE DATABASE $db_name")) die("<img src='../images/fail.png' width='12' height='12' border='0' name='fail.png' alt='Fail'>&nbsp;&nbsp;" . mysql_error());
echo "<p><img src='../images/success.png' width='12' height='12' border='0' name='success.png' alt='Success'>&nbsp;&nbsp;Successfully created $db_name database.</p>";
// End database creation
//Create the tables
mysql_select_db("$db_name") or die("<img src='../images/fail.png' width='12' height='12' border='0' name='fail.png' alt='Fail'>&nbsp;&nbsp;" . mysql_error());
$query1 = 'CREATE TABLE blog_post( '.
         'postid int(25) NOT NULL auto_increment, '.
         'post_title varchar(50) NOT NULL default "", '.
         'post_text text NOT NULL, '.
         'post_date datetime NOT NULL default "0000-00-00 00:00:00", '.
         'PRIMARY KEY  (postid))';
if (mysql_query($query1)){
echo "<p><img src='../images/success.png' width='12' height='12' border='0' name='success.png' alt='Success'>&nbsp;&nbsp;Successfully created blog_post table.</p>";
} else {
die("<img src='../images/fail.png' width='12' height='12' border='0' name='fail.png' alt='Fail'>&nbsp;&nbsp;" . mysql_error());
}     
$query2 = 'CREATE TABLE administrator( '.
          'userid int(25) NOT NULL auto_increment, '.
          'first_name varchar(25) NOT NULL default "", '.
          'last_name varchar(25) NOT NULL default "", '.
          'email_address varchar(25) NOT NULL default "", '.
          'username varchar(25) NOT NULL default "", '.
          'admin_passwd varchar(255) NOT NULL default "", '.
          'user_level enum("0","1","2","3") NOT NULL default "0", '.
          'install_date datetime NOT NULL default "0000-00-00 00:00:00", '.
          'last_login datetime NOT NULL default "0000-00-00 00:00:00", '.
          'activated enum("0","1") NOT NULL default "0", '.
          'PRIMARY KEY  (userid))';
if (mysql_query($query2)){
echo "<p><img src='../images/success.png' width='12' height='12' border='0' name='success.png' alt='Success'>&nbsp;&nbsp;Successfully created administrator table.</p>";
} else {
die("<img src='../images/fail.png' width='12' height='12' border='0' name='fail.png' alt='Fail'>&nbsp;&nbsp;" . mysql_error());
}
$query3 = 'CREATE TABLE blog_comment( '.
         'commentid int(25) NOT NULL auto_increment, '.
         'comment_title varchar(50) NOT NULL default "", '.
         'comment_text text NOT NULL, '.
				 'comment_name text NOT NULL, '.
         'comment_date datetime NOT NULL default "0000-00-00 00:00:00", '.
         'PRIMARY KEY  (commentid))';
if (mysql_query($query3)){
echo "<p><img src='../images/success.png' width='12' height='12' border='0' name='success.png' alt='Success'>&nbsp;&nbsp;Successfully created blog_comment table.</p>";
} else {
die("<img src='../images/fail.png' width='12' height='12' border='0' name='fail.png' alt='Fail'>&nbsp;&nbsp;" . mysql_error());
}
// End table creation
// Create the admin user
//
// Encrypt the admin password before entering it into the database.
$encrypted_admin_passwd = md5($admin_passwd);
$sql = mysql_query("INSERT INTO administrator (first_name, last_name,
       email_address, username, admin_passwd, install_date)
       VALUES('$first_name', '$last_name', '$email_address',
       '$username', '$encrypted_admin_passwd', now())")
       or die ("<img src='../images/fail.png' width='12' height='12' border='0' name='fail.png' alt='Fail'>&nbsp;&nbsp;" . mysql_error());
echo "<p><img src='../images/success.png' width='12' height='12' border='0' name='success.png' alt='Success'>&nbsp;&nbsp;Successfully created administrator account.</p>";      
// End admin user creation.

$userid = mysql_insert_id();
$code = md5($admin_passwd);
$sql = mysql_query("UPDATE administrator SET activated='1' WHERE userid='$userid' AND admin_passwd='$code'");
$sql_doublecheck = mysql_query("SELECT * FROM administrator WHERE userid='$userid' AND admin_passwd='$code' AND activated='1'");
$doublecheck = mysql_num_rows($sql_doublecheck);
if($doublecheck == 0){
	echo '<p><strong><font color=red>Your account could not be activated!</strong></p>';
} elseif ($doublecheck > 0) {
	echo "<p><strong>PCSysBlog installation Successful!</strong></p>";
	echo '<p>You may now visit your new blog <a href="../">here</a>!</p>';
// End the installation script
}
?>
<hr size="4" color="#FFA500" align="center" />
Powered by: <a href="http://pcsysblog.berlios.de">PCSysBlog-0.1.0b</a> &copy; 2004-2008 - All rights reserved.
<br />
PCSysBlog is Free Software released under the <a href="http://www.gnu.org/licenses/gpl.txt">GNU/GPL license</a>
</body>
</html>
