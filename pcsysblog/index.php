<?php
include ("./includes/header.inc");
?>
<?php
if (!isset($_GET['url']))
{
include ("blog_display.php"); // main blog display page
}
elseif ($_GET['url'] == "post") // post page start
{
include ("post.html");
}
elseif ($_GET['url'] == "register") // registration page start
{
include ("register.html");
}
elseif ($_GET['url'] == "login") // login page start
{
include ("login.html");
}
elseif ($_GET['url'] == "lostpassword") // lost password page start
{
include ("lostpassword.html");
}
?>
<?php
include ("./includes/footer.inc");
?> 
