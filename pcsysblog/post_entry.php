<?php
include ("./includes/dbconnect.php");
// Define post fields into variables
$post_title = $HTTP_POST_VARS['post_title'];
$post_text = $HTTP_POST_VARS['post_text'];
// Add slashes in case the user entered any escaped characters.
// You may or may not need this depending on your apache php setup
// Do not use addslashes on strings that have already been escaped
// with magic_quotes_gpc
// $post_title = addslashes($post_title);
// $post_text = addslashes($post_text);
// Enter info into the Database.
// $post_text = htmlspecialchars($post_text);
$sql = mysql_query("INSERT INTO blog_post (post_title, post_text, post_date)
		VALUES('$post_title', '$post_text', now())") or die (mysql_error());
if(!$sql){
	echo 'There has been an error entering your post. Please contact the webmaster.';
} else {
	$userid = mysql_insert_id();
	// Let's thank the user and send them back to the blog
	// This is not a very elegant method and is not xhtml 1.0 strict compliant
	// but it works for now.
	// Fixing this needs to be in the TODO file
echo '<head>';
echo '<META HTTP-EQUIV="Refresh" CONTENT="5;URL=./index.php">';
echo '</head>';
include 'includes/common.inc';
include 'includes/header.inc';
echo "<br />Thank you for posting to '$site_name' !<br /><br />";
echo "Please wait while we return you to the '$site_name' Homepage.";
include 'includes/footer.inc';
}
?>
