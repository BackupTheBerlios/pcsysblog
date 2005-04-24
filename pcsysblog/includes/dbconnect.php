<?php
// Database information - Required
// Change the variables below to match your site setup
$dbhost = 'localhost';
$dbusername = '';
$dbpasswd = '';
$database_name = 'pcsysblog';

// Database connection, do not modify below this line

$connection = mysql_pconnect("$dbhost","$dbusername","$dbpasswd") 
	or die ("Couldn't connect to server.");
	
$db = mysql_select_db("$database_name", $connection)
	or die("Couldn't select database.");
?>
