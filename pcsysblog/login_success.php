<?php
// session_start has to occur first
session_start();
include 'includes/dbconnect.php';
echo "<p><center><span style= 'font-weight: bold'>Welcome ". $_SESSION['username'] ." !</span></center></p>";
// Let's thank the user for logging in and send them to the blog front page
// This is not a very elegant method and is not xhtml 1.0 strict compliant
// but it works for now.
// Fixing this needs to be in the TODO file
echo '<head>';
echo '<META HTTP-EQUIV="Refresh" CONTENT="5;URL=./index.php">';
echo '</head>';
echo '<br /><center>Thank you for logging into PCSysBlog!<br /><br />';
echo 'Please wait while we direct you to the PCSysBlog Homepage.</center>';
include 'includes/footer.inc';
?>
